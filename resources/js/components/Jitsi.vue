<template>
    <JitsiMeeting
      v-if="jwtToken"
      :jwt="jwtToken"
      :domain="'mczr-tmk.ru'"
      :room-name="props.room.room_name"
      lang="ru"
      :width="'100%'"
      :height="'60vh'"
      :configOverwrite="config"
      :interfaceConfigOverwrite="interfaceConfig"
      @get-iframe-ref-on-api-ready="(parentNode) => { parentNode.style.height  =  '40vh';  parentNode.style.width = '100%' }"
    />
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { JitsiMeeting } from '@jitsi/vue-sdk';
  import { SignJWT } from 'jose';
  
  const props = defineProps({
    user: {
      type: Object,
      required: true
    },
    room: {
      type: Object,
      required: true
    },
    isModer: {
      type: Boolean,
      required: true
    }
  });
  
  const jwtToken = ref(null);
  
  // Настройки configOverwrite
  const config = {
    startWithAudioMuted: true,
    disableModeratorIndicator: false,
    startScreenSharing: true,
    enableEmailInStats: false,
    resolution: 720,
    prejoinPageEnabled: false,
  };
  
  // Настройки interfaceConfigOverwrite
  const interfaceConfig = {
    DISABLE_JOIN_LEAVE_NOTIFICATIONS: true,
    SHOW_JITSI_WATERMARK: false,
    SHOW_WATERMARK_FOR_GUESTS: false,
    SHOW_CHROME_EXTENSION_BANNER: false,
    TOOLBAR_BUTTONS: [
      'microphone', 'camera', 'desktop', 'fullscreen', 'settings',
      'fodeviceselection', 'recording', 'hangup', 'chat', 'sharedvideo', 'shareaudio', 'toggle-camera', 'embedmeeting',
      'videoquality', 'filmstrip', 
      'tileview', 'videobackgroundblur', 'download', 'participants-pane', 'pip', 'speakerstats',
      'mute-everyone'
    ],
    HIDE_KICK_BUTTON_FOR_GUESTS: true,
    JITSI_WATERMARK_LINK: null,
    MOBILE_APP_PROMO: false,
  };
  
  const generateToken = async () => {
    const secret = new TextEncoder().encode('8c12413eaab70caa6062aab5acc882ec86a92030c2d6c9d14b3cc9bd1e8b16b9'); // Секретный ключ для подписи
    const now = Math.floor(Date.now() / 1000); // Текущее время в секундах
  
    const payload = {
      aud: props.room.room_name,
      iss: "b3265ae35a1b34d1a360738caf8d0f963ee29fb09c0f52f079345c7cc24579d3",
      sub: "mczr-tmk.ru",
      room: props.room.room_name,
      nbf: now - 36000,
      exp: now + 72000,
      moderator: props.user.isModer,
      context: {
        user: {
          id: props.user.id,
          name: `${props.user.secondName} ${props.user.name}`,
          email: props.user.email,
        }
      }
    };
  
    const jwt = await new SignJWT(payload)
      .setProtectedHeader({ alg: 'HS256', typ: 'JWT' })
      .setIssuedAt(now - 36001)
      .setExpirationTime(now + 72000)
      .setNotBefore(now - 36000)
      .sign(secret);
  
    return jwt;
  };
  
  onMounted(async () => {
    jwtToken.value = await generateToken();
  });
  </script>
  
  <style>
  /* Ваши стили */
  </style>
  