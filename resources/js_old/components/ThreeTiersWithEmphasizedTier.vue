<template>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">
        <p class="mt-2 text-4xl font-bold tracking-tight text-purple-800 sm:text-5xl">Стоимость курса</p>
      </div>
      <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600"><b>Старт</b> 29 ноября 2024 года.</p>
      <div class="mt-16 flex justify-center">
        <fieldset aria-label="Payment frequency">
          <RadioGroup v-model="frequency" class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200">
            <RadioGroupOption as="template" v-for="option in frequencies" :key="option.value" :value="option" v-slot="{ checked }">
              <div :class="[checked ? 'bg-purple-800 text-white' : 'text-gray-500', 'cursor-pointer rounded-full px-2.5 py-1']">{{ option.label }}</div>
            </RadioGroupOption>
          </RadioGroup>
        </fieldset>
      </div>
      <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        <div v-for="tier in tiers" :key="tier.id" :class="[tier.featured ? 'bg-green-950 ring-green-950' : 'ring-gray-200', 'rounded-3xl p-8 ring-1 xl:p-10']">
          <h3 :id="tier.id" :class="[tier.featured ? 'text-white' : 'text-gray-900', 'text-lg font-semibold leading-8']">{{ tier.name }}</h3>
          <p :class="[tier.featured ? 'text-gray-300' : 'text-gray-600', 'mt-4 text-sm leading-6']">{{ tier.description }}</p>
          <p class="mt-6 flex items-baseline gap-x-1">
            <span :class="[tier.featured ? 'text-white' : 'text-gray-900', 'text-4xl font-bold tracking-tight']">{{ typeof tier.price === 'string' ? tier.price : tier.price[frequency.value] }}</span>
            <span v-if="typeof tier.price !== 'string'" :class="[tier.featured ? 'text-gray-300' : 'text-gray-600', 'text-sm font-semibold leading-6']">{{ frequency.priceSuffix }}</span>
          </p>
          <a :href="tier.href + '/' + frequency.value + '/' + tier.price[frequency.value]" :aria-describedby="tier.id" :class="[tier.featured ? 'bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white' : 'bg-purple-800 text-white shadow-sm hover:bg-purple-700 focus-visible:outline-purple-800', 'mt-6 block rounded-md px-3 py-2 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2']">{{ tier.cta }}</a>
          <ul role="list" :class="[tier.featured ? 'text-gray-300' : 'text-gray-600', 'mt-8 space-y-3 text-sm leading-6 xl:mt-10']">
            <li v-for="feature in tier.features" :key="feature" class="flex gap-x-3">
              <CheckIcon :class="[tier.featured ? 'text-white' : 'text-purple-800', 'h-6 w-5 flex-none']" aria-hidden="true" />
              {{ feature }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RadioGroup, RadioGroupOption } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/20/solid'

const frequencies = [
  { value: '100', label: '100%', priceSuffix: ' 100%' },
  { value: '50', label: '50% + 50%', priceSuffix: ' 50% + 50%' },
]
const tiers = [
  {
    name: 'Базовый',
    id: 'tier-base',
    href: '/payment/tier-base',
    price: { 100: '30000', 50: '32000' },
    description: 'дополнительное профессиональное образование',
    features: [
      '144 часа', 
      '17 вебинаров', 
      '16 тем', 
      'доступ к материалам в течение года', 
      'подходит врачам, педагогам, дефектологам'
    ],
    featured: false,
    cta: 'Оплатить',
  },
  {
    name: 'Льготный',
    id: 'tier-privilege',
    href: '/payment/tier-privilege',
    price: { 100: '22000', 50: '25000' },
    description: 'дополнительное профессиональное образование',
    features: [
      '144 часа', 
      '17 вебинаров', 
      '16 тем', 
      'доступ к материалам в течение года', 
      'подходит врачам, педагогам, дефектологам',
      'для членов "Ассоциации педагогов, психологов, психотерапветов Центрального Черноземья"',
/*       'для сотрудников ГК "Здоровый ребенок',
      'для сотрудников фирм-франчайзи ГК "Здоровый ребенок"', */
      'для студентов профильных образовательных учреждений'
    ],
    featured: false,
    cta: 'Оплатить',
  },
  {
    name: 'Организации',
    id: 'tier-enterprise',
    href: '/payment/tier-enterprise',
    price: 'Индивидуально',
    description: 'дополнительное профессиональное образование',
    features: [
      '144 часа', 
      '17 вебинаров', 
      '16 тем', 
      'доступ к материалам в течение года', 
      'подходит врачам, педагогам, дефектологам',
      'для группы',
      'при оплате обучения работодателем',
    ],
    featured: true,
    cta: 'Запросить',
  },
]

const frequency = ref(frequencies[0])
</script>