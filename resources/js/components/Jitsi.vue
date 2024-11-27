<template>

<JitsiMeeting
v-if="jwtToken"
:jwt="jwtToken"

:domain="'mczr-tmk.ru/'"

:room-name="props.room.room_name"

lang="ru"
/>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import { JitsiMeeting } from '@jitsi/vue-sdk';
import { jwtVerify, SignJWT } from 'jose';
import jwt from 'jwt-simple';
const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  room: {
    type: Object,
    required: true
  }
})
console.log(props)
const jwtToken = ref(null);

const generateToken = async () => {
     // Секретный ключ приложения Jitsi
     const secret = new TextEncoder().encode('8c12413eaab70caa6062aab5acc882ec86a92030c2d6c9d14b3cc9bd1e8b16b9'); // Секретный ключ для подписи
    const now = Math.floor(Date.now() / 1000); // Текущее время в секундах

    const payload = {
        aud: props.room.room_name, // аудитория (аудитория приложения, например jitsi)
        iss: "b3265ae35a1b34d1a360738caf8d0f963ee29fb09c0f52f079345c7cc24579d3", // издатель токена
        sub: "mczr-tmk.ru", // цель токена (обычно URL сервера)
        room: props.room.room_name, // комната, к которой предоставляется доступ, используйте '*' для доступа ко всем комнатам
        nbf: now - 36000,
        exp: now + 72000, // время истечения срока действия токена (например, через час)
        moderator: true, // установить true, если пользователь является модератором
        context: {
            user: {
                id: props.user.id,
                name: `${props.user.secondName} ${props.user.name}`, // имя пользователя
                email: props.user.email, // email пользователя
                /* avatar: doctor.User.avatar, */ // URL аватара пользователя (необязательно)
            }
        }
    };
    console.log(payload)
    // Генерация токена
    const jwt = await new SignJWT(payload)
        .setProtectedHeader({ alg: 'HS256', typ: 'JWT' })
        .setIssuedAt(now-36001)
        .setExpirationTime(now + 72000)
        .setNotBefore(now-36000)
        .sign(secret); // Подписываем с помощью секрета

    console.log(jwt)
    return jwt;
/*     const token = jwt.encode(payload, '8c12413eaab70caa6062aab5acc882ec86a92030c2d6c9d14b3cc9bd1e8b16b9', 'HS256');
    
    return token;
 */
    /* 
    
    return jwt.sign(payload, secret, { algorithm: 'HS256' }); */
};

onMounted(async () => {
    jwtToken.value = await generateToken(); // Создание токена при загрузке компонента
    console.log(jwtToken.value)
});
</script>