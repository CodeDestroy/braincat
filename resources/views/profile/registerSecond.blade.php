@extends('layouts.app')

@section('content')
<div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
    {{-- <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div> --}}
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Введите ваши данные</h2>
        <p class="mt-2 text-lg/8 text-gray-600">Введите дополнительные данные, мы проверим, можете ли вы получить скидку.</p>
    </div>
    <form action="{{ route('profile.registerSecond') }}" method="POST" enctype="multipart/form-data" class="mx-auto mt-16 max-w-xl sm:mt-20">
        @csrf
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="snils" class="block text-sm/6 font-semibold text-gray-900">СНИЛС</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->SNILS }}" required type="text" name="snils" id="snils" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="000-000-000 00">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm/6 font-semibold text-gray-900">Место проживания</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->address }}" required type="text" name="address" id="address" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="г. Москва, ул. Космонавтов...">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label  for="postIndex" class="block text-sm/6 font-semibold text-gray-900">Почтовый индекс</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->postIndex }}" minlength="6" maxlength="6" required type="text" name="postIndex" id="postIndex" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="000000">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="phone" class="block text-sm/6 font-semibold text-gray-900">Телефон (через +7)</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->phone }}" required type="text" name="phone" id="phone" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="+7 (000)-00 00 000">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="email" class="block text-sm/6 font-semibold text-gray-900">Подтвердите почту</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->email }}" required type="text" name="email" id="email" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="почта@mail.ru">
                </div>
            </div>
            
            <div class="sm:col-span-2">
                <label for="birthDay" class="block text-sm/6 font-semibold text-gray-900">Дата рождения</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->birthday }}" required type="date" name="birthDay" id="birthDay" class="px-3.5 block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="01.01.1901">
                </div>
            </div>
            <div id="isHealthyChildFranchDiv" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input value="true" onchange="showHealthyChildFranch(this)" name="isHealthyChildFranch" id="isHealthyChildFranch" type="checkbox" class="h-4 w-4 rounded accent-purple-800 border-gray-300 text-purple-800 focus:ring-purple-800" {{ old('remember') ? 'checked' : '' }}>
                    <label for="isHealthyChildFranch" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Сотрудник франчайзи ГК "Здоровый ребёнок"</label>
                </div>
            </div>
            <script defer>
                //Для франчайзинга
                function showHealthyChildFranch(event) {
                    const isHealthyChildGk = document.getElementById('isHealthyChildGk')
                    /* const isHealthyChildGKDiv = document.getElementById('isHealthyChildGKDiv') */
                    const isLegalHealthyChildGKDiv = document.getElementById('isLegalHealthyChildGKDiv')
                    const oplataUrLicoDiv = document.getElementById('oplataUrLicoDiv')
                    /* const isHealthyChildDiv = document.getElementById('isHealthyChildDiv') */
                    const isStudent = document.getElementById('isStudent')
                    const workPlace = document.getElementById('workPlaceDiv')
                    if (event.checked) {
                        isHealthyChildGk.disabled = true
                        
                        // Удаляем для ГК
                        isLegalHealthyChildGKDiv.addEventListener('animationend', function handleAnimationEnd() {
                            isLegalHealthyChildGKDiv.classList.remove('hiding');
                            oplataUrLicoDiv.classList.add('hide');
                            isLegalHealthyChildGKDiv.removeEventListener('animationend', handleAnimationEnd);
                        });

                        document.getElementById('isLegalHealthyChildGK').checked = false
                        
                        //Проявляем чекбокс и лист работ
                        oplataUrLicoDiv.classList.remove('hide');
                        oplataUrLicoDiv.classList.add('visible');
                        oplataUrLicoDiv.classList.remove('hiding');

                        workPlaceDiv.classList.remove('hide');
                        workPlaceDiv.classList.add('visible');
                        workPlaceDiv.classList.remove('hiding');


                        isStudent.disabled = true
                        document.getElementById('isStudent').checked = false
                        workPlace.required = true
                    }
                    else {
                        isHealthyChildGk.disabled = false
                        oplataUrLicoDiv.checked = false

                        oplataUrLicoDiv.classList.add('hiding');
                        oplataUrLicoDiv.classList.remove('visible');
                        
                        // Убираем класс `hiding` после завершения анимации
                        oplataUrLicoDiv.addEventListener('animationend', function handleAnimationEnd() {
                            oplataUrLicoDiv.classList.remove('hiding');
                            oplataUrLicoDiv.classList.add('hide');
                            oplataUrLicoDiv.removeEventListener('animationend', handleAnimationEnd);
                        });

                        workPlaceDiv.classList.add('hiding');
                        workPlaceDiv.classList.remove('visible');
                        
                        // Убираем класс `hiding` после завершения анимации
                        workPlaceDiv.addEventListener('animationend', function handleAnimationEnd() {
                            workPlaceDiv.classList.remove('hiding');
                            workPlaceDiv.classList.add('hide');
                            workPlaceDiv.removeEventListener('animationend', handleAnimationEnd);
                        });
                        //Удаляем галку с оплаты орг
                        document.getElementById('isLegal').checked = false
                        
                        isStudent.disabled = false
                        document.getElementById('workPlace').value = ''
                        workPlace.required = false
                    }
                }
            </script>
            <div class="sm:col-span-2">
                <div id="isHealthyChildGKDiv" class="relative mt-2 rounded-md shadow-sm items-center flex text-black-900 dark:text-black-300">
                    <input value="true" onchange="showHealthyChildGk(this)" name="isHealthyChildGk" id="isHealthyChildGk" type="checkbox" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="isHealthyChildGK" class="my-2 ms-2.5 text-md font-medium">Сотрудник ГК "Здоровый ребенок"</label>
                </div>
            </div>
            <script defer>
                function showHealthyChildGk(event) {
                    const isLegalHealthyChildGKDiv = document.getElementById('isLegalHealthyChildGKDiv')
                    const isHealthyChildFranch = document.getElementById('isHealthyChildFranch')
                    
                    /* const isHealthyChild = document.getElementById('isHealthyChild') */
                    const isStudent = document.getElementById('isStudent')
                    const workPlace = document.getElementById('workPlace')
                    /*  */
                    if (event.checked) {

                        //Проявляем оплата юр лицом
                        /* isLegalHealthyChildGKDiv.classList.remove('hidden'); */
                        isLegalHealthyChildGKDiv.classList.remove('hide');
                        isLegalHealthyChildGKDiv.classList.add('visible');
                        isLegalHealthyChildGKDiv.classList.remove('hiding');
                        /* setTimeout(() => {
                            isLegalHealthyChildGKDiv.classList.add('visible');
                        }, 200); */

                        //Не может быть студентом
                        isStudent.disabled = true
                        isStudent.checked = false
                        //Не может быть работником франшизы, он уже в ГК
                        isHealthyChildFranch.disabled = true
                        isHealthyChildFranch.checked = false

                        //Место работы ГК здоров ребенок
                        workPlace.value = 'ГК "Здоровый ребенок"'
                        workPlace.disabled = true
                    }
                    else {

                        //Убираем галку оплата орг ДЛЯ ГК
                        document.getElementById('isLegalHealthyChildGK').checked = false

                        //Удаляем оплата юр лицом
                        isLegalHealthyChildGKDiv.classList.add('hiding');
                        isLegalHealthyChildGKDiv.classList.remove('visible');
                        
                        isLegalHealthyChildGKDiv.addEventListener('animationend', function handleAnimationEnd() {
                            isLegalHealthyChildGKDiv.classList.remove('hiding');
                            isLegalHealthyChildGKDiv.classList.add('hide');
                            isLegalHealthyChildGKDiv.removeEventListener('animationend', handleAnimationEnd);
                        });

                        //Включаем галку оплата юр лицом
                        isHealthyChildFranch.disabled = false

                        //Включаем студента
                        isStudent.disabled = false

                        /* isHealthyChild.checked = false */
                        workPlace.value = ''
                    }
                }
            
            </script> 
            
            {{-- Для Франчайзи здоровый ребенок --}}
            <div id="oplataUrLicoDiv" class="sm:col-span-2 animated hide">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input value="true" name="isLegalHealthyChildFranch" id="isLegal" type="checkbox" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="isLegal" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Обучение оплачивает организация</label>
                </div>
            </div>  

            {{-- Для ГК --}}
            <div id="isLegalHealthyChildGKDiv" class="sm:col-span-2 animated hide">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input value="true" name="isLegalHealthyChildGK" id="isLegalHealthyChildGK" type="checkbox" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="isLegalHealthyChildGK" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Оплата осуществляется юридическим лицом</label>
                </div>
            </div>         
            
            <div id="workPlaceDiv" class="sm:col-span-2 animated hide">
                <label for="workPlaceSelect" class="block text-sm font-medium leading-6 text-gray-900">Выберите юридическое лицо</label>
                <select onchange="setWorkPlace(this.options[this.selectedIndex])" id="workPlaceSelect" name="workPlaceSelect" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" selected>Выберите юридическое лицо</option>
                    <option value="340734888697">г. Видное, ИП Побирская ЕА, ИНН 340734888697</option>
                    <option value="9728064920">г. Москва,	ООО «Виктория», ИНН 9728064920</option>
                    <option value="8904093268">г. Новый Уренгой, ООО «Успех», ИНН	8904093268</option>
                    <option value="5031154257">г. Электросталь,	ООО «Разумный подход», ИНН 5031154257</option>
                    <option value="682964375908">г. Тамбов ИП, Сапожкова АА, ИНН 682964375908</option>
                    <option value="5027330414">г. Котельники, ООО «Арисоль», ИНН 5027330414</option>
                    <option value="772918160206">г. Коммунарка,	ИП Логинова ТИ, ИНН 772918160206</option>
                    <option value="440128766451">г. Фрязино, ИП Ксантиниди АИ, ИНН 440128766451</option>
                    <option value="344103869185">г. Волгоград,	ИП Егоров ВЕ, ИНН 344103869185</option>
                    <option value="40247969">г. Ереван, Армения, ИП Багдасарян ДА, ИНН 40247969</option>
                    <option value="366312647810">ИП Арнаутова Олеся Сергеевна, ИНН 366312647810</option>
                </select>
            </div>
            <script>
                function setWorkPlace(event) {
                    document.getElementById('workPlace').value = event.text
                }
            </script>
            <div id="isStudentDiv" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input id="isStudent" onchange="setStudent(this)" value="true" type="checkbox" name="isStudent" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded  dark:bg-gray-700 dark:border-gray-600">
                    <label for="isStudent" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Студент профильного ВУЗа</label>
                </div>
            </div> 
            <script defer>
                function setStudent(event) {
                    const studPhotoDiv = document.getElementById('studPhotoDiv')
                    const isHealthyChildGk = document.getElementById('isHealthyChildGk')
                    const isHealthyChildFranch = document.getElementById('isHealthyChildFranch')

                    const isAPPCPDiv = document.getElementById('isAPPCPDiv')
                    const isAPPCP = document.getElementById('isAPPCP')

                    const isLegal = document.getElementById('isLegal')
                    const isLegalHealthyChildGK = document.getElementById('isLegalHealthyChildGK')

                    if (event.checked) {
                        
                        //Дизейблим кнопки я сотрудник и убираем галочки
                        isHealthyChildGk.checked = false
                        isHealthyChildGk.disabled = true
                        isHealthyChildFranch.checked = false
                        isHealthyChildFranch.disabled = true
                        
                        //На всякий убираем галки с оплат юр лицом
                        isLegal.checked = false
                        isLegalHealthyChildGK.checked = false


                        //Показываем блок загрузки студака
                        studPhotoDiv.classList.remove('hide');
                        studPhotoDiv.classList.add('visible');
                        studPhotoDiv.classList.remove('hiding');
                    }
                    else {

                        //Возвращаем активность кнопкам я сотрудник
                        isHealthyChildGk.disabled = false
                        isHealthyChildFranch.disabled = false
                        
                        //Убираем блок загрузки студака
                        studPhotoDiv.classList.add('hiding');
                        studPhotoDiv.classList.remove('visible');
                        
                        studPhotoDiv.addEventListener('animationend', function handleAnimationEnd() {
                            studPhotoDiv.classList.remove('hiding');
                            studPhotoDiv.classList.add('hide');
                            studPhotoDiv.removeEventListener('animationend', handleAnimationEnd);
                        });
                        /* isAPPCPDiv.style.display = '' */
                    }
                }
            </script>
            <div id="isAPPCPDiv" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input id="isAPPCP" value="true" type="checkbox" name="isAPPCP" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="isAPPCP" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Являюсь членом Ассоциации педагогов, психологов, психотерапевтов</label>
                </div>
            </div> 
            <div>
                <label for="workPlace" class="block text-sm/6 font-semibold text-gray-900">Место работы</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->workPlace }}" id="workPlace" type="text" name="workPlace" id="workPlace" autocomplete="workPlace" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="workPost" class="block text-sm/6 font-semibold text-gray-900">Должность</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->workPost }}" type="text" name="workPost" id="workPost" autocomplete="workPost" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="spetiality" class="block text-sm/6 font-semibold text-gray-900">Специальность</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->spetiality }}" type="text" name="spetiality" id="spetiality" autocomplete="spetiality" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="tgNickname" class="block text-sm/6 font-semibold text-gray-900">Профиль Телеграм (@user)</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->tgNickname }}" type="text" name="tgNickname" id="tgNickname" autocomplete="tgNickname" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>  
            <div class="sm:col-span-2  mt-2">
                <label for="phone-number" class="block text-sm/6 font-semibold text-gray-900">Паспортные данные</label>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 mt-2">
                        <label for="passportSeria" class="block text-sm/6 font-medium text-gray-900">Серия</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <input value="{{ Auth::user()->passportSeria }}" minlength="4" maxlength="4" type="text" name="passportSeria" id="passportSeria" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0000">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4 mt-2">
                        <label for="passpoortNumber" class="block text-sm/6 font-medium text-gray-900">Номер</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <input value="{{ Auth::user()->passpoortNumber }}" minlength="6" maxlength="6" type="text" name="passpoortNumber" id="passpoortNumber" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="000000">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="sm:col-span-full animated hide" id='studPhotoDiv'>
                <label for="studPhotoDiv" class="block text-sm/6 font-medium text-gray-900">Фотография или скан сутденческого билета</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm/6 text-gray-600">
                            <label for="studPhoto" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>Загрузите изображение</span>
                                <input onchange="selectFile(this)" id="studPhoto" name="studPhoto" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">или переместите файл в это окно</p>
                        </div>
                        <p class="text-xs/5 text-gray-600">PNG, JPG до 10MB</p>
                    </div>
                </div>
                
            </div>

            <div id="selected" class="animated hide sm:col-span-2">
                <label for="file-selected" class="block text-sm/6 font-medium text-gray-900">Выбранный файл:</label> 
                <div id="file-selected" class="text-lg/8 text-gray-600"></div>
            </div>
            
            <script defer>
                function selectFile(file) {
                    const selected = document.getElementById('selected')
                    selected.classList.remove('hide');
                    selected.classList.add('visible');
                    selected.classList.remove('hiding');
                    document.getElementById('file-selected').innerHTML = file.files[0].name
                }
            </script>

            <div class="flex gap-x-4 sm:col-span-2">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <input required type="checkbox" value="agree" class="sr-only peer">
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-grey-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Я согласен с условиями пользовательского соглашения</span>
                </label>
            </div>
            <div id="isAgreeWithPersonalDataProc" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input id="agreeWithPersonalDataProc" required type="checkbox" class="accent-purple-800 w-4 h-4 text-indigo-800 bg-gray-100 border-gray-300 rounded  dark:bg-gray-700 dark:border-gray-600">
                    <label for="agreeWithPersonalDataProc" class="my-2 ms-2.5 text-md font-medium text-grey-900 dark:text-grey-300">Согласен с <a target="_blank" href="{{ route('documents.agreement') }}" class="text-indigo-600">политикой обработки персональных данных</a></label>
                </div>
            </div> 
        </div>
        <div class="mt-8">
            <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Подтвердить</button>
        </div>
    </form>
</div>
@endsection