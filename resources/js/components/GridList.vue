<template>
  <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid lg:grid-cols-3 sm:grid-cols-2 sm:gap-px sm:divide-y-0">
    <div v-for="(action, actionIdx) in actions" :key="action.title" :class="[action.blockBackground, actionIdx === 0 ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', actionIdx === 1 ? 'sm:rounded-tr-lg' : '', actionIdx === actions.length - 2 ? 'sm:rounded-bl-lg' : '', actionIdx === actions.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '', 'group relative p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-900']">
      <div>
        <span :class="[action.iconBackground, action.iconForeground, 'inline-flex rounded-lg py-2']">
          <component :is="action.icon" class="h-10 w-10" aria-hidden="true" />
        </span>
      </div>
      <div class="mt-8">
        <h3 class="text-base font-medium leading-6 text-gray-900">
          <a :href="action.href" class="focus:outline-none">
            <!-- Extend touch target to entire panel -->
            <span class="absolute inset-0" aria-hidden="true"/>
            {{ action.title }}
          </a>
        </h3>
      </div>
      <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
        </svg>
      </span>
    </div>
  </div>
</template>

<script setup>
import {
  AcademicCapIcon,
  UsersIcon,
  UserIcon,
  HeartIcon,
  PuzzlePieceIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const actions = [
  {
    title: 'Медицина',
    href: '#',
    icon: HeartIcon,
    iconForeground: 'text-black',
    iconBackground: 'bg-white',
    blockBackground: 'bg-white'
  },
  {
    title: 'Психология',
    href: 'https:/psy4pro.ru',
    icon: PuzzlePieceIcon,
    iconForeground: 'text-black',
    iconBackground: '',
    blockBackground: 'bg-white'
  },
  {
    title: 'Для специалистов',
    href: '#',
    icon: UserIcon,
    iconForeground: 'text-black',
    iconBackground: '',
    blockBackground: 'bg-rose-50'
  },
  {
    title: 'Логопедия',
    href: '#',
    icon: BookOpenIcon,
    iconForeground: 'text-black',
    iconBackground: '',
    blockBackground: 'bg-white'
  },
  {
    title: 'Для родителей',
    href: '#',
    icon: UsersIcon,
    iconForeground: 'text-black',
    iconBackground: '',
    blockBackground: 'bg-emerald-50',
  },
  {
    title: 'Педагогика',
    href: '#',
    icon: AcademicCapIcon,
    iconForeground: 'text-black',
    iconBackground: '',
    blockBackground: 'bg-white'
  },
]
</script>