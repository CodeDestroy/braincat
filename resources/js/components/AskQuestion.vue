<template>
    <div class="bg-white shadow sm:rounded-lg mb-5" v-if="props.course.canAskQuestion == 1">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Задать вопрос</h3>
            <div class="mt-5">
                <div class="rounded-md bg-gray-50 px-6 py-5 sm:flex sm:items-start sm:justify-between">
                    <div class="sm:flex sm:items-start">
                        <img class="h-6 w-auto" :src="props.course.image"/>
                        <div class="mt-3 sm:ml-4 sm:mt-0">
                            <div class="mt-1 text-sm text-gray-600 sm:flex sm:items-center">
                                <div class="mt-1 sm:mt-0">Задать вопрос преподавателю курса</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 sm:ml-6 sm:mt-0 sm:flex-shrink-0">
                      <a :href="'/education/course/' + course.id + '/askQuestion'" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" style="cursor: pointer;">Спросить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue';
    
    const props = defineProps({
        course: {
            type: Object,
            required: true
        },
        themes: {
            type: Array,
            required: true
        }
      
    });

</script>