<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
      <div class="mx-auto max-w-4xl text-center">
        <p class="text-4xl font-bold tracking-tight text-mona-lisa-600 sm:text-5xl">План вебинара</p>
      </div>
      <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
        <ul role="list" class="space-y-3">
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Понятие детско-родительских конфликтов.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Типы межличностных отношений в семье.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Ресурс классической литературы в решении детско-родительских конфликтов: "вечные конфликты", универсальные мотивы, архетипы и образы-символы.
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>От одиночества к преодолению распри: анализ рассказа В.Г. Короленко "В дурном обществе".
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>"Кругосветное путешествие" отца и дочери: прощение обиды и воссоединение семьи: анализ рассказа А.П. Гайдара "Голубая чашка".
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Мультфильм как психолого-педагогический тренинг: семейный конфликт пяти поколений семьи Ривера в мультфильме "Тайна Коко".
            </p>
          </li>
          <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
            <p>Истории, которые лечат: чтение и арт-терапия для детско-родительских отношений.
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