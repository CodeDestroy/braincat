<template>
  <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
    <div class="mx-auto max-w-4xl text-center">
      <p class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Календарный план</p>
    </div>
    <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
      <ul role="list" class="space-y-3">
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
          <p>Раздел 1. Строение и функции головного мозга человека</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">29.11.2024</p>
          <p>Тема 1.1: Из истории изучения головного мозга человека. Головной мозг человека и его отделы. Поля коры мозга. Проводящие пути мозга</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">07.12.2024</p>
          <p>Тема 1.2: Высшие психические функции человека. Гнозис и его виды. Праксис и его виды</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">14.12.2024</p>
          <p>Тема 1.3: Символические функции: мышление, память, внимание, речь, эмоции, воля</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">21.12.2024</p>
          <p>Тема 1.4: Речевая функция: нейропсихологический и нейролингвистический аспекты</p>
        </li>

        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
          <p>Раздел 2. Закономерности психоречевого развития детей в онтогенезе и его нарушения</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">27.12.2024</p>
          <p>Тема 2.1: Закономерности психического и речевого онтогенеза</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">10.01.2025</p>
          <p>Тема 2.2: Особенности развития у детей речи и других когнитивных функций</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">15.01.2025</p>
          <p>Тема 2.3: Нарушение речи и других когнитивных функций гностико-праксического уровня</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">24.01.2025</p>
          <p>Тема 2.4: Нарушение речи и других когнитивных функций символического уровня</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
          <p>Раздел 3. Диагностика и коррекция нарушений психоречевого развития детей</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">30.01.2025</p>
          <p>Тема 3.1: Специфика и основные методы нейропсихологической диагностики</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">07.02.2025</p>
          <p>Тема 3.2: Основные направления и методы работы по коррекции нарушений нейромоторной и когнитивной сфер у детей</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">14.02.2025</p>
          <p>Тема 3.3: Основные направления и методы коррекционной работы при нарушениях речи у детей: алалии</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">21.02.2025</p>
          <p>Тема 3.4: Дифференциальная диагностика нарушений развития детей. Анализ результатов диагностики и алгоритм составления заключений</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">27.02.2025</p>
          <p>Тема 3.5: Основные направления и методы  коррекционной работы при  нарушениях речи у детей: заикание, дизартрии</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">07.03.2025</p>
          <p>Тема 3.6: Основные направления и методы  коррекционной работы при  нарушениях речи у детей: дисграфии, дислексии</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
          <p>Раздел 4. Патология речи у взрослых. Основные направления восстановительного обучения</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">14.03.2025</p>
          <p>Тема 4.1: Нейропсихологические синдромы у взрослых: афазии, деменции</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
          <p class="text-slate-400">21.03.2025</p>
          <p>Тема 4.2: Основные направления и методы восстановительного обучения</p>
        </li>
        <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-green-900 text-xl font-bold">
          <p>Итоговое занятие</p>
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