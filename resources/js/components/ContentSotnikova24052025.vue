<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Психологический защитный механизм: определение и раскрытие понятия</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Низшие (незрелые) защитные механизмы: определение понятия. Их влияние на развитие личности</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Отличия низших (незрелых) защитных механизмов от высших (зрелых)</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Отрицание: определение защиты, пример её проявления в психике, иллюстрация действия</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Всемогущий контроль: определение защиты, пример её проявления в психике, иллюстрация действия</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Расщепление: определение защиты, пример её проявления в психике, иллюстрация действия</p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Практическая отработка распознавания низших механизмов защиты и формирования переходов на зрелые</p>
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