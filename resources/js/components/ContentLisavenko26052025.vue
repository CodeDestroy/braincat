<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Арт-терапии и нарративная терапия, сравнительный анализ</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Метафора, как соединение двух направлений для проведения диагностики и поиска ресурсов</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Кризис: тупик или выход?</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Техника "Три чемодана или путешествие длиною в жизнь": знакомство и применение</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Демонстрация практических случаев</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Практическое задание для слушателей</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Разбор практического задания</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Ответы на вопросы</p>
          </li>
        </ul>
      </div>
    </div>
  </template>


  <script setup>
  const items = [
    { id: 1 },
    // More items...
  ]
  </script>