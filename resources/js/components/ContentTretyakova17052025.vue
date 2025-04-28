<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Тест Векслера: диагностика интеллектуального развития ребенка c 4 до 16 лет. Специфика использования теста при работе с детьми с задержкой темпов психического развития, умственной отсталостью, расстройствами аутистического спектра.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Особенности работы с детским и взрослым вариантами теста Векслера.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Психологическая интерпретация результатов психодиагностических исследований.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Варианты составления психологических заключений для родителей, ПМПК, МСЭ, других специалистов. Примеры диагностических заключений и психологических рекомендаций.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Диагностический практикум: демонстрация тестирования с применением теста Векслера
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