<template>

    <div>
      <h2 class="font-semibold leading-6 text-gray-900 mt-10 text-3xl">Предстоящие события</h2>
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
            <!-- <button type="button" class="mt-8 w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add event</button> -->
        </div>
        <ol class="mt-4 divide-y divide-gray-100 text-sm leading-6 lg:col-span-7 xl:col-span-8">
          <li v-for="meeting in meetings" :key="meeting.id" class="relative flex space-x-6 py-6 xl:static">
            <a :href="meeting.course_id + '/event/' + meeting.id" 
              :class="{/*  'pointer-events-none': meeting.status !== 'inProgress', 'text-gray-500': meeting.status !== 'inProgress' */ }">
            <img :src="meeting.image" alt="" class="h-14 w-14 flex-none rounded-full" />
            <div class="flex-auto">
              <h3 class="pr-10 font-semibold text-gray-900 xl:pr-0">{{ meeting.name }}</h3>
              <dl class="mt-2 flex flex-col text-gray-500 xl:flex-row">
                <div class="flex items-start space-x-3">
                  <dt class="mt-0.5">
                    <span class="sr-only">Дата</span>
                    <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </dt>
                  
                    <dd>
                      <time :datetime="meeting.datetime">
                        <span style="font-weight: 500; color: black">{{ meeting.description }}</span> <template v-if="meeting.type == 'vebinar'">{{ formatTime(meeting.start_time) }} - {{ formatTime(meeting.end_time) }} </template>
                      </time>
                    </dd>
                  
                </div>
                <!-- <div class="mt-2 flex items-start space-x-3 xl:ml-3.5 xl:mt-0 xl:border-l xl:border-gray-400 xl:border-opacity-50 xl:pl-3.5">
                  <dt class="mt-0.5">
                    <span class="sr-only">Location</span>
                    <MapPinIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </dt>
                  <dd>{{ meeting.location }}</dd>
                </div> -->
              </dl>
            </div>
            <!-- <Menu as="div" class="absolute right-0 top-6 xl:relative xl:right-auto xl:top-auto xl:self-center">
              <div>
                <MenuButton class="-m-2 flex items-center rounded-full p-2 text-gray-500 hover:text-gray-600">
                  <span class="sr-only">Open options</span>
                  <EllipsisHorizontalIcon class="h-5 w-5" aria-hidden="true" />
                </MenuButton>
              </div>
  
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <div class="py-1">
                    <MenuItem v-slot="{ active }">
                      <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit</a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Cancel</a>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu> -->
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
  EllipsisHorizontalIcon,
  MapPinIcon,
} from '@heroicons/vue/20/solid';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';

// Массив для названий месяцев
const monthNames = [
  'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
  'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь',
];
// Вычисляемое значение для названия месяца
const formattedMonth = computed(() => {
  const [year, month] = currentMonth.value.split('-');
  return `${monthNames[parseInt(month, 10) - 1]} ${year}`;
});
const meetings = ref([]);
const busyDays = ref([]);
const days = ref([
  // Начальные данные (можно обновить позже)
 /*  { date: '2021-12-27' },
  { date: '2021-12-28' }, */
  // ...
]);

var today = new Date();
const selectedDate = ref(null);
const currentMonth = ref('2024-11'); // Начальный месяц для рендера календаря
var course_id = null;

const loadBusyDays = async (date) => {
  try {
    const last = lastDigit(window.location.pathname)
    if (last) {
      course_id = last;
      const response = await axios.get(`/api/course/${course_id}/days`, { params: { date } });
      busyDays.value = response.data;
      console.log(response.data)
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

loadBusyDays(formatDate(today)).then(() =>generateDays(2024, 11))


loadMeetings(formatDate(today))
</script>
