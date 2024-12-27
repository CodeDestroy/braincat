<template>
    <div class="relative border-b border-gray-200 pb-5 sm:pb-0">
        <div class="md:flex md:items-center md:justify-between">
            <div class="mt-3 flex md:absolute md:right-0 md:top-3 md:mt-0">
                <button  id="generate-pdf" type="button" class="ml-3 inline-flex items-center rounded-md bg-purple-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-800">Скачать в PDF</button>
            </div>
        </div>
        <div class="mt-4">
            <div class="px-2 sm:hidden">
                <label for="current-tab" class="sr-only"></label>
                <select id="current-tab" name="current-tab" onchange="window.location.href = this.options[this.selectedIndex].value"  class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-purple-300 outline-none">
                    <option v-for="tab in tabs" :key="tab.name" :value="tab.href" :selected="tab.current">{{ tab.name }}</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="-mb-px flex space-x-8">
                    <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-purple-700 text-purple-800' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</a>
                </nav>
            </div>
        </div>
    </div>
</template>
  
<script setup>

const pathname = window.location.pathname

const tabs = [
    { name: 'Оферта', href: '/docs/offer', current: pathname === '/docs/offer' ? true : false },
    { name: 'Договор', href: '/docs/contract', current: pathname === '/docs/contract' ? true : false },
    { name: 'Конфиденциальность', href: '/docs/privacy', current: pathname === '/docs/privacy' ? true : false },
    { name: 'Политика', href: '/docs/policy', current: pathname === '/docs/policy' ? true : false },
    { name: 'Согласие', href: '/docs/agreement', current: pathname === '/docs/agreement' ? true : false },
]
</script>