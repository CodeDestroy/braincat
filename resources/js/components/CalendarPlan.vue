<template>
    <div class="bg-slate-100 py-24 sm:py-32" id="content-to-convert">
        <div class="mx-auto max-w-4xl text-center">
            <p class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Календарный план</p>
        </div>
        <!-- <template v-if="course.id == 1"> -->
        <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
            <ul role="list" class="space-y-3">
                <template  v-for="chapter in chapters" :key="chapter.id" >
                <li class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold" :style="{color: chapter.color}">
                    <p>{{ chapter.name }}</p>
                </li>
                <li v-for="(theme, index) in chapter.themes" :key="theme.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <a
                        
                        href="#calendarView"
                        @click="handleDateClick({date: theme.start_date, isCurrentMonth: true})"
                        class="py-4"
                    >
                        <p class="text-slate-400">{{ formatDateToRu(theme.start_date) }} {{ formatTime(theme.start_time) }} по МСК</p>
                        <p v-bind:class="{
                            'text-green-500': isActive(theme.start_date),
                            'text-violet-500': isPast(theme.start_date),
                            'text-black-500' : isFuture(theme.start_date)
                            /* 'cursor-not-allowed': isPast(theme.start_date) */
                        }">{{ theme.name }}</p> <!-- Предположим, у вас есть title для темы -->
                    </a>
                </li>
                </template>
            </ul>
            <!-- <ul role="list" class="space-y-3">
                <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
                    <p>Раздел 1. Строение и функции головного мозга человека</p>
                </li>
                
                <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <a class=" py-4" href="#calendarView" @click="handleDateClick({date: '2024-11-29', isCurrentMonth: true})">
                        <p class="text-slate-400">29.11.2024</p>
                        <p class="text-violet-500">Тема 1.1: Из истории изучения головного мозга человека. Головной мозг человека и его отделы. Поля коры мозга. Проводящие пути мозга</p>
                    </a>
                </li>

                <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <a class=" py-4" href="#calendarView" @click="handleDateClick({date: '2024-12-07', isCurrentMonth: true})">
                        <p class="text-slate-400">07.12.2024 19:00 по МСК</p>
                        <p class="text-green-500">Тема 1.2: Высшие психические функции человека. Гнозис и его виды. Праксис и его виды</p>
                    </a>
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
            </ul> -->
        </div>
        <!-- </template> -->
        <!-- <template v-else>
        <div class="mx-auto max-w-7xl mt-12  px-6 lg:px-8">
            <ul role="list" class="space-y-3">
                <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6 text-purple-800 text-xl font-bold">
                    <p>Круглый стол: Гарнитура Forbrain. Особенности работы</p>
                </li>
                
                <li v-for="item in items" :key="item.id" class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <a class=" py-4" href="#calendarView" @click="handleDateClick({date: '2024-12-15', isCurrentMonth: true})">
                        <p class="text-slate-400">15.12.2024</p>
                        <p class="text-green-500">"Круглый стол: Гарнитура Forbrain. Особенности работы", автор: Космачева Любовь Расуловна, ведущий логопед-дефектолог, педагог высшей категории</p>
                    </a>
                </li>
            </ul>
        </div>   
        </template> -->
    </div>
    <div id="calendarView">
        <h2 class="font-semibold leading-6 text-gray-900 mt-10 text-3xl">События</h2>
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-16">
            <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">
                <div class="flex items-center text-gray-900">            
                    <button
                        type="button"
                        @click="changeMonth(-1)"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Предыдущий месяц</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <div class="flex-auto text-sm font-semibold">{{ formattedMonth }}</div>
                    <button
                        type="button"
                        @click="changeMonth(1)"
                        class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Следующий месяц</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
                    <div>Пн</div>
                    <div>Вт</div>
                    <div>Ср</div>
                    <div>Чт</div>
                    <div>Пт</div>
                    <div>Сб</div>
                    <div>Вс</div>
                </div>
                <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                    <button
                        v-for="(day, dayIdx) in days"
                        :key="day.date"
                        type="button"
                        :class="[ day.hasEvents && 'underline-purple', 'py-1.5 hover:bg-gray-100 focus:z-10', day.isCurrentMonth ? 'bg-white' : 'bg-gray-50', (day.isSelected || day.isToday) && 'font-semibold', day.isSelected && 'text-white', !day.isSelected && day.isCurrentMonth && !day.isToday && 'text-gray-900', !day.isSelected && !day.isCurrentMonth && !day.isToday && 'text-gray-400', day.isToday && !day.isSelected && 'text-indigo-600', dayIdx === 0 && 'rounded-tl-lg', dayIdx === 6 && 'rounded-tr-lg', dayIdx === days.length - 7 && 'rounded-bl-lg', dayIdx === days.length - 1 && 'rounded-br-lg']"
                        @click="handleDateClick(day)"
                    >
                        <time
                            :datetime="day.date"
                            :class="['mx-auto flex h-7 w-7 items-center justify-center rounded-full', day.isSelected && day.isToday && 'bg-indigo-600', day.isSelected && !day.isToday && 'bg-gray-900']"
                        >
                            {{ day.date.split('-').pop().replace(/^0/, '') }}
                        </time>
                    </button>
                </div>
            </div>
            <ol class="mt-4 divide-y divide-gray-100 text-sm leading-6 lg:col-span-7 xl:col-span-8">
                <li v-for="meeting in meetings" :key="meeting.id" class="relative flex space-x-6 py-6 xl:static">
                    <a :href="meeting.course_id + '/event/' + meeting.id">
                        <img :src="meeting.image" alt="" class="h-14 w-14 flex-none rounded-full" />
                        <div class="flex-auto">
                            <h3 :class="[meeting.color, 'pr-10 font-semibold xl:pr-0']">{{ meeting.name }}</h3>
                            <dl class="mt-2 flex flex-col text-gray-500 xl:flex-row">
                                <div class="flex items-start space-x-3">
                                    <template v-if="meeting.type == 'vebinar'">
                                        <dt class="mt-0.5">
                                            <span class="sr-only">Дата</span>
                                            <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </dt>
                                    </template>
                                    <dd>
                                        <time :datetime="meeting.datetime">
                                            <template v-if="meeting.type == 'vebinar'">{{ formatTime(meeting.start_time) }} - {{ formatTime(meeting.end_time) }}<br></template>
                                            
                                            <span style="font-weight: 500; color: black">{{ meeting.description }}</span>
                                        </time>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </a>
                </li>
            </ol>
        </div>
    </div>
</template>
  
<script setup>
    import axios from 'axios';
    import { ref, computed, onMounted } from 'vue';
    import {
      CalendarIcon,
      ChevronLeftIcon,
      ChevronRightIcon,
    } from '@heroicons/vue/20/solid';
  
    const props = defineProps({
        course: {
            type: Object,
            required: true
        },
        themes: {
            type: Array,
            required: true
        },
        chapters: {
            type: Array,
            required: true
        }
    });

    console.log(props.chapters)
  // Массив для названий месяцев
    const monthNames = [
      'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
      'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь',
    ];
    const isActive = (startDate) => {
        const dateToCheck = new Date(startDate);
        const today = new Date();

        // Сравниваем только год, месяц и день
        return dateToCheck.getFullYear() === today.getFullYear() &&
            dateToCheck.getMonth() === today.getMonth() &&
            dateToCheck.getDate() === today.getDate();
    }

    const isPast = (startDate) => {
        const dateToCheck = new Date(startDate);
        const today = new Date();

        // Сравниваем только год, месяц и день
        return dateToCheck.getFullYear() < today.getFullYear() ||
            (dateToCheck.getFullYear() === today.getFullYear() && dateToCheck.getMonth() < today.getMonth()) ||
            (dateToCheck.getFullYear() === today.getFullYear() && dateToCheck.getMonth() === today.getMonth() && dateToCheck.getDate() < today.getDate());
    }

    const isFuture = (startDate) => {
        const dateToCheck = new Date(startDate);
        const today = new Date();

        // Сравниваем только год, месяц и день
        return dateToCheck.getFullYear() > today.getFullYear() ||
            (dateToCheck.getFullYear() === today.getFullYear() && dateToCheck.getMonth() > today.getMonth()) ||
            (dateToCheck.getFullYear() === today.getFullYear() && dateToCheck.getMonth() === today.getMonth() && dateToCheck.getDate() > today.getDate());
    }
    const formatDateToRu = (date) => {
        const d = new Date(date);
        return d.toLocaleDateString('ru-RU'); // Форматирует дату в формате dd-mm-yyyy
    }

    const formattedMonth = computed(() => {
      const [year, month] = currentMonth.value.split('-');
      return `${monthNames[parseInt(month, 10) - 1]} ${year}`;
    });

    
    const items = ref([
      { id: 1 },
      // Дополнительные элементы...
    ]);
    
    const meetings = ref([]);
    const busyDays = ref([]);
    const days = ref([]);
    const today = new Date();
    const selectedDate = ref(null);
    const currentMonth = ref(today.getFullYear() + '-' + today.getMonth());
    var course_id = null;

      const loadBusyDays = async (date) => {
        try {
            const last = lastDigit(window.location.pathname)
            if (last) {
                course_id = last;
                const response = await axios.get(`/api/course/${last}/days`, { params: { date } });
                busyDays.value = response.data;
            }
            else {
                const response = await axios.get('/api/days', { params: { date } });
                busyDays.value = response.data;
            }
            
        } catch (error) {
            console.error('Error loading events:', error);
        }
      }

    const lastDigit = (path) => {
    // Извлекаем последнюю цифру из pathname
        const matches = path.match(/\/(\d+)$/);
        return matches ? matches[1] : null; // Возвращаем цифру или null, если ничего не найдено
    }
    

    // Функция для загрузки встреч с сервера
    const loadMeetings = async (date) => {
        try {
            const last = lastDigit(window.location.pathname)
            if (last) {
                course_id = last;
                const response = await axios.get(`/api/course/${course_id}/events`, { params: { date } });
                meetings.value = response.data;
            }
            else {
                const response = await axios.get('/api/events', { params: { date } });
                meetings.value = response.data;
            }
            
        } catch (error) {
            console.error('Error loading events:', error);
        }
    };

    // Обработчик клика по дате
    const handleDateClick = (day) => {
        console.log(day)
        if (day.isCurrentMonth) {
            selectedDate.value = day.date;
            days.value.forEach((day, index) => {

                if (day.date == selectedDate.value) {
                    days.value[index].isSelected = true;
                }
                else {
                    days.value[index].isSelected = false;
                }
            })
            loadMeetings(day.date);
        }
    };

    // Функции для переключения месяца
    const changeMonth = (direction) => {
        const current = new Date(`${currentMonth.value}-01`);
        current.setMonth(current.getMonth() + direction);

        const year = current.getFullYear();
        const month = String(current.getMonth() + 1).padStart(2, '0');
        currentMonth.value = `${year}-${month}`;
        generateDays(year, month);
    };
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Месяцы: 0-11
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };
    const formatTime = (time) => {
    // Предполагаем, что время передается в формате "hh:mm:ss"
        if (!time) return '';
        return time.split(':').slice(0, 2).join(':'); // Оставляем только часы и минуты
    }
    // Генерация дней для текущего месяца
    const generateDays = (year, month) => {
        const date = new Date(year, month - 1, 1); // Первый день месяца
        const daysArray = [];

        // День недели, с учетом сдвига на понедельник
        const startDay = (date.getDay() === 0 ? 6 : date.getDay() - 1); // Пн = 0, Вс = 6
            
        // Генерация дней предыдущего месяца
        if (startDay > 0) {
            for (let i = startDay; i > 0; i--) {
                const prevDate = new Date(year, month - 1, -i + 1); // Дни предыдущего месяца
                daysArray.push({
                    date: formatDate(prevDate),
                    isCurrentMonth: false,
                    hasEvents: busyDays.value.includes(formatDate(prevDate)),
                });
            }
        }

        // Генерация дней текущего месяца
        while (date.getMonth() === month - 1) {

            daysArray.push({
                date: formatDate(date),
                isCurrentMonth: true,
                isToday: formatDate(date) === formatDate(new Date()),
                isSelected: formatDate(date) === formatDate(new Date()),
                hasEvents: busyDays.value.includes(formatDate(date)),
            });
            console.log(busyDays.value.includes(formatDate(date)))
            date.setDate(date.getDate() + 1); // Следующий день
        }

        // Генерация дней следующего месяца до конца недели
        const endDay = 7 - (daysArray.length % 7);
        if (endDay < 7) {
            for (let i = 0; i < endDay; i++) {
            const nextDate = new Date(year, month, i + 1);
            daysArray.push({
                date: formatDate(nextDate),
                isCurrentMonth: false,
                hasEvents: busyDays.value.includes(formatDate(nextDate)),
            });
            }
        }

        days.value = daysArray;
    };


    // Инициализация календаря

    loadBusyDays(formatDate(today)).then(() => generateDays(today.getFullYear(), today.getMonth()))


    loadMeetings(formatDate(today))
  </script>
  
  <style scoped>
  /* Добавьте здесь свои стили, если это необходимо */
  </style>
  