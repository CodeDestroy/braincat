<template>
  <div class="bg-slate-100 pt-12 sm:pt-24">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-4xl">События</p>
  </div>
  <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 px-8 pt-8 sm:pt-12">
    <li v-for="person in people" :key="person.email" class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
      <a :href="person.href" class="flex flex-1 flex-col p-8 focus:outline-none">
        <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" :src="person.imageUrl" alt="" />
        <h3 class="mt-6 text-sm font-medium text-salt-700">{{ person.name }}</h3>
        <dl class="mt-1 flex flex-grow flex-col justify-between">
          <dt class="sr-only">Title</dt>
          <dd class="text-sm text-gray-500">{{ person.title }}</dd>
          <dt class="sr-only">Event Caprion</dt>
          <dd class="text-base font-medium text-salt-700 mt-5">{{ person.eventCaption }}</dd>
          <dt class="sr-only">Event Date</dt>
          <dd class="text-sm text-gray-500 mt-1">{{ person.eventDate }}</dd>
          <dt class="sr-only">Role</dt>
          <dd class="mt-5">
            <span :class="[person.passed ? 'text-mona-lisa-500 ring-mona-lisa-500/20 bg-mona-lisa-50' :  'text-green-900 ring-green-900/20 bg-green-50', 'inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset']">{{ person.role }}</span>
          </dd>
        </dl>
      </a>
    </li>
  </ul>
  </div>
</template>

<script setup>
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'

const people = [
  {
    name: 'Елена Ивановна Николаева',
    title: 'доктор биологических наук, профессор',
    eventCaption: 'Раненый целитель',
    role: 'Вебинар. Онлайн',
    eventDate: '19.07.2025',
    imageUrl: 'img/nikolaeva_list.jpg',
    href: '/nikolaeva_19072025',
    passed: false
  },
  {
    name: 'Александра Артуровна Кудряшова',
    title: 'доктор филологических наук',
    eventCaption: 'Решение детско-родительских конфликтов в арт-терапии',
    role: 'Видеозапись вебинара',
    eventDate: '15.05.2025',
    imageUrl: 'img/kudryashova_list.jpg',
    href: '/kudryashova_15052025',
    passed: true
  },
  {
    name: 'Галина Анатольевна Третьякова',
    title: 'медицинский психолог',
    eventCaption: 'Интеллектуальные диагностические тесты Векслера для детей: WISC, WРРSI',
    role: 'Видеозапись вебинара',
    eventDate: '17.05.2025',
    imageUrl: 'img/tretyakova_list.jpg',
    href: '/tretyakova_17052025',
    passed: true
  },
  {
    name: 'Савченко Евгения Александровна',
    title: 'детский ЛОР-врач, сурдолог',
    eventCaption: 'Аденоиды. Просто о сложном',
    role: 'Видеозапись вебинара',
    eventDate: '21.05.2025',
    imageUrl: 'img/savchenko_list.jpg',
    href: '/savchenko_21052025',
    passed: true
  },
  {
    name: 'Богутенко Анна Фёдоровна',
    title: 'нейропсихолог, клинический психолог, нутрициолог',
    eventCaption: 'Интегративный подход в нейропсихологии. Понятие и значимость',
    role: 'Видеозапись вебинара',
    eventDate: '22.05.2025',
    imageUrl: 'img/bogutenko_list.jpg',
    href: '/bogutenko_22052025',
    passed: true
  },
  /*
  {
    name: 'Оксана Юрьевна Сотникова',
    title: 'аналитический психолог',
    eventCaption: 'От искажённого мышления к ясности: формирование психологических защит в процессе терапии',
    role: 'Видеозапись вебинара',
    eventDate: '24.05.2025',
    imageUrl: 'img/sotnikova_list.jpg',
    href: '/sotnikova_24052025' ,
    passed: true
  },
  */
  {
    name: 'Лисавенко Марина Евгеньевна',
    title: 'педагог, психолог',
    eventCaption: 'Три чемодана или путешествие длиною в жизнь: авторская диагностико-ресурсная техника',
    role: 'Видеозапись вебинара',
    eventDate: '26.05.2025',
    imageUrl: 'img/lisavenko_list.jpg',
    href: '/lisavenko_26052025',
    passed: true 
  },
  {
    name: 'Елена Ивановна Николаева',
    title: 'доктор биологических наук, профессор',
    eventCaption: 'Что нужно знать о леворукости',
    role: 'Видеозапись вебинара',
    eventDate: '31.05.2025',
    imageUrl: 'img/nikolaeva_list.jpg',
    href: '/nikolaeva_18052025',
    passed: true
  },
  { 
    name: 'Анна Аркадьевна Норова',
    title: 'врач, руководитель',
    eventCaption: 'Организация внутреннего контроля для руководителей частных медицинских организаций',
    role: 'Видеозапись вебинара.',
    eventDate: '24.04.2025',
    imageUrl: 'img/norova_list.jpg',
    href: '/norova_24042025',
    passed: true 
  },
  {
    name: 'Елена Туркенич и Наталия Наконечная',
    title: 'психологи, специалисты по детско-родительским отношениям',
    eventCaption: 'Нейростимуляция когнитивной  сферы и эмоционально - коммуникативного поведения детей с особенностями развития',
    role: 'Видеозапись вебинара.',
    eventDate: '17.04.2025, 24.04.2025',
    imageUrl: 'img/turkenich_nakonechnaya_list.jpg',
    href: '/turkenich_nakonechnaya_17042025',
    passed: true 
  },
  {
    name: 'Елена Ивановна Николаева',
    title: 'доктор биологических наук, профессор',
    eventCaption: 'Что такое созревание мозга и какие условия его обеспечивают',
    role: 'Видеозапись вебинара',
    eventDate: '19.01.2025',
    imageUrl: 'img/nikolaeva_list.jpg',
    href: 'https://psy4pro.ru/nikolaeva',
    passed: true
  },
  {
    name: 'Александра Артуровна Кудряшова',
    title: 'доктор филологических наук',
    eventCaption: 'Современные направления арт-терапии: стратегии и ресурсы',
    role: 'Видеозапись вебинара',
    eventDate: '17.02.2025',
    imageUrl: 'img/kudryashova_list.jpg',
    href: '/kudryashova_17022025',
    passed: true
  },
  {
    name: 'Александра Артуровна Кудряшова',
    title: 'доктор филологических наук',
    eventCaption: 'Арт-терапия в работе с детьми: направления, преимущества, специфика используемых методик',
    role: 'Видеозапись вебинара',
    eventDate: '25.02.2025',
    imageUrl: 'img/kudryashova_list.jpg',
    href: '/kudryashova_25022025',
    passed: true
  },
  {
  name: 'Галина Анатольевна Третьякова',
    title: 'медицинский психолог',
    eventCaption: 'Детско-родительские отношения. Методы диагностики и коррекции',
    role: 'Видеозапись вебинара',
    eventDate: '02.03.2025',
    imageUrl: 'img/tretyakova_list.jpg',
    href: '/tretyakova_02032025',
    passed: true
  },
  {
    name: 'Галина Анатольевна Третьякова',
    title: 'медицинский психолог',
    eventCaption: 'Методы психологической диагностики в клинике детской психиатрии и неврологии',
    role: 'Видеозапись вебинара',
    eventDate: '15-16.03.2025',
    imageUrl: 'img/tretyakova_list.jpg',
    href: '/tretyakova_15032025',
    passed: true
  },
  /*
  {
    name: 'Сергей Александрович Курбатов',
    title: 'кандидат медицинских наук, врач',
    eventCaption: 'Генетика в неврологии для начинающих специалистов',
    role: 'Курс. Онлайн',
    eventDate: 'скоро',
    imageUrl: 'img/kurbatov_list.jpg',
    href: '/kurbatov',
    passed: true
  },
  {
    name: 'Светлана Васильевна Кочеткова',
    title: 'аналитический психолог, супервизор',
    eventCaption: 'Особенности работы с переносом и контрпереносом в психотерапии',
    role: 'Семинар. Резюме',
    eventDate: '02.02.2025',
    imageUrl: 'img/kochetkova_list.jpg',
    href: 'https://psy4pro.ru/kochetkova' 
  }
  */  
]
</script>