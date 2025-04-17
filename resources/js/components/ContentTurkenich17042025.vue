<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-salt-700 text-xl font-bold">
                <p>Часть 1: 17.04.2025 (четверг) 19:00 - 21:15</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Влияние сенсорно-моторного развития ребенка на его нервную систему. Пирамида развития, иллюстрирующая основные аспекты, необходимые для полноценного развития ребенка</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Организация нейрокоррекционной работы в соответствии с концепцией трех функциональных блоков мозга А.Р.Лурия </p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Нейропсихологическая диагностика детей с задержками развития</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Включение родителей в процесс психокоррекции детей</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-salt-700 text-xl font-bold">
                <p>Часть 2: 24.04.2025 (четверг) 19:00 - 21:15</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Комплекс нейропсихологических методик и техник, направленных на развитие неполноценно функционирующих двигательных и когнитивных  функций - нейрокоррекционные упражнения 
                </p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Нейрокоррекционные упражнения: повышение энергетического потенциала ЦНС (I блок мозга по Лурия)</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Нейрокоррекционные упражнения: развитие основных когнитивных функций: речь, память, внимание (II блок мозга по Лурия)</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Нейрокоррекционные упражнения: включение функций программирования, регуляции и контроля (III блок мозга по Лурия)</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Демонстрация примеров  выполнения нейрокоррекционных упражнений</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Индивидуальные и групповые занятия: задачи и  решения</p>
            </li>
            <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                <p>Психологический аспект работы по налаживанию коммуникации в диаде "ребенок-мама"</p>
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