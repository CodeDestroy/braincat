import './bootstrap';
import resolveConfig from 'tailwindcss/resolveConfig'
import tailwindConfig from '../../tailwind.config.js'
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const fullConfig = resolveConfig(tailwindConfig)

import { createApp } from 'vue';
/* import ThreeTiersWithEmphasizedTier from './components/ThreeTiersWithEmphasizedTier.vue';
import Calendar from './components/Calendar.vue';
 

createApp({
  components: {
    ThreeTiersWithEmphasizedTier,
  }
}).mount('#calendar');
createApp({
  components: {
    Calendar,
  }
}).mount('#price');
createApp({
  components: {
    Plan,
  }
}).mount('#plan'); */
/* createApp({})
  .component('ThreeTiersWithEmphasizedTier', ThreeTiersWithEmphasizedTier)
  .mount('#price') */

/*   createApp({})
  .component('Calendar', Calendar)
  .mount('#calendar')  */ 

 import ThreeTiersWithEmphasizedTier from './components/ThreeTiersWithEmphasizedTier.vue';
import Calendar from './components/Calendar.vue';
import Plan from './components/Plan.vue';
import SectionHeadingsWithTabs from './components/sectionHeadingsWithTabs.vue';
import { jsPDF } from "jspdf";
import html2canvas from "html2canvas";

createApp({})
.component('ThreeTiersWithEmphasizedTier', ThreeTiersWithEmphasizedTier)
.mount('#price')

createApp({})
.component('Calendar', Calendar)
.mount('#calendar')

createApp({})
.component('Plan', Plan)
.mount('#plan')  

createApp({})
.component('SectionHeadingsWithTabs', SectionHeadingsWithTabs)
.mount('#docs-heading')  


document.getElementById('generate-pdf')?.addEventListener('click', function () {
/*   const { jsPDF } = window.jspdf; */

  // Создаем экземпляр jsPDF
  const pdf = new jsPDF();
  const pathname = window.location.pathname;
  let name = ''
  switch (pathname) {
    case '/docs/agreement':
      name = 'Соглашение на обработку персональных данных.pdf'
      break;
    case '/docs/contract':
      name = 'Договор.pdf'
      break;
    case '/docs/offer':
      name = 'Оферта.pdf'
      break;
    default:
      name = 'document.pdf'
  }
  // Элемент, который мы хотим преобразовать
  const element = document.getElementById('content-to-convert');

  // Рендерим элемент в canvas с помощью html2canvas
  html2canvas(element, { useCORS: true }).then(canvas => {
      const imgData = canvas.toDataURL('image/png'); // Конвертируем canvas в изображение
      const imgWidth = 190; // Ширина изображения в PDF (в мм)
      const pageHeight = 295; // Высота страницы PDF (в мм)
      const imgHeight = (canvas.height * imgWidth) / canvas.width; // Пропорциональная высота изображения
      let heightLeft = imgHeight; // Оставшаяся высота изображения
      let position = 0; // Текущая вертикальная позиция

      // Добавляем первую часть изображения
      pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;

      // Добавляем дополнительные страницы, если высота превышает одну страницу
      while (heightLeft > 0) {
          position -= pageHeight; // Смещаемся на высоту страницы
          pdf.addPage();
          pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
          heightLeft -= pageHeight;
      }

      // Сохраняем PDF
      pdf.save(name);
  });
});

