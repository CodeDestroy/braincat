<template>
  <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 px-8 py-8 sm:py-24">
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
            <span class="inline-flex items-center rounded-full bg-mona-lisa-50 px-2 py-1 text-xs font-medium text-mona-lisa-500 ring-1 ring-inset ring-mona-lisa-500/20">{{ person.role }}</span>
          </dd>
        </dl>
      </a>
    </li>
  </ul>
</template>

<script setup>
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'

const people = [
  {
    name: 'Елена Ивановна Николаева',
    title: 'доктор биологических наук, профессор',
    eventCaption: 'Что такое созревание мозга и какие условия его обеспечивают',
    role: 'Вебинар, Запись',
    eventDate: '19.01.2025',
    imageUrl: 'img/nikolaeva_list.jpg',
    href: 'https://psy4pro.ru/nikolaeva'
  },
  {
    name: 'Александра Артуровна Кудряшова',
    title: 'доктор филологических наук',
    eventCaption: 'Современные направления арт-терапии: стратегии и ресурсы',
    role: 'Вебинар. Онлайн',
    eventDate: '17.02.2025',
    imageUrl: 'img/kudryashova_list.jpg',
    href: '/kudryashova_17022025'
  },
  {
    name: 'Александра Артуровна Кудряшова',
    title: 'доктор филологических наук',
    eventCaption: 'Арт-терапия в работе с детьми: направления, преимущества, специфика используемых методик',
    role: 'Вебинар. Онлайн',
    eventDate: '25.02.2025',
    imageUrl: 'img/kudryashova_list.jpg',
    href: '/kudryashova_25022025'
  },
  {
  name: 'Галина Анатольевна Третьякова',
    title: 'медицинский психолог',
    eventCaption: 'Детско-родительские отношения. Методы диагностики и коррекции',
    role: 'Вебинар. Онлайн',
    eventDate: '02.03.2025',
    imageUrl: 'img/tretyakova_list.jpg',
    href: '/tretyakova_02032025'
  },
  {
    name: 'Галина Анатольевна Третьякова',
    title: 'медицинский психолог',
    eventCaption: 'Методы психологической диагностики в клинике детской психиатрии и неврологии',
    role: 'Двухдневный вебинар. Онлайн',
    eventDate: '15-16.03.2025',
    imageUrl: 'img/tretyakova_list.jpg',
    href: '/tretyakova_15032025'
  },
  {
    name: 'Сергей Александрович Курбатов',
    title: 'кандидат медицинских наук, врач',
    eventCaption: 'Генетика в неврологии для начинающих специалистов',
    role: 'Курс. Онлайн',
    eventDate: 'скоро',
    imageUrl: 'img/kurbatov_list.jpg',
    href: '/kurbatov'
  },
  {
    name: 'Елена Туркенич и Наталия Наконечная',
    title: 'психологи, специалисты по детско-родительским отношениям',
    eventCaption: 'Нейростимуляция когнитивной  сферы и эмоционально - коммуникативного поведения детей с особенностями развития',
    role: 'Двухдневный вебинар. Онлайн',
    eventDate: '17.04.2025, 24.04.2025',
    imageUrl: 'img/turkenich_nakonechnaya_list.jpg',
    href: '/turkenich_nakonechnaya_17042025' 
  },
  {
    name: 'Оксана Юрьевна Сотникова',
    title: 'аналитический психолог',
    eventCaption: 'От искажённого мышления к ясности: формирование психологических защит в процессе терапии',
    role: 'Вебинар. Онлайн',
    eventDate: '24.05.2025',
    imageUrl: 'img/sotnikova_list.jpg',
    href: '/sotnikova_24052025' 
  },
  /*
  {
    name: 'Светлана Васильевна Кочеткова',
    title: 'аналитический психолог, супервизор',
    eventCaption: 'Особенности работы с переносом и контрпереносом в психотерапии',
    role: 'Семинар. Резюме',
    eventDate: '02.02.2025',
    imageUrl: 'img/kochetkova_list.jpg',
    href: 'https://psy4pro.ru/kochetkova' 
  }*/
]
</script>