<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Понятие психической нормы и патологии. Причины и нейропсихологические механизмы развитии различных форм нарушений.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Общая характеристика различных нарушений при умственной отсталости, пограничных формах интеллектуальной недостаточности, школьной дезадаптации, синдроме дефицита внимания с гиперактивностью и других патологиях.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Психодиагностическое исследование с показом некоторых методик.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Психологическая интерпретация результатов психодиагностических исследований. 
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Варианты составления психологического заключения для специалистов, родителей и запроса в ПМПК, МСЭ.
            </p>
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