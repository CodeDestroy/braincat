@extends('layouts.app')

@section('content')


<div class="mx-auto max-w-7xl pt-16 lg:flex lg:gap-x-16 lg:px-8">
    <h1 class="sr-only">Документы</h1>
  
    <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
        <nav class="flex-none px-4 sm:px-6 lg:px-0">
            <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
                <li>
                    <a href="{{ route('settings.general') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold" x-state:on="Current" x-state:off="Default" x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Основные
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('settings.security') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33"></path>
                        </svg>
                        Безопасность
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.education') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                        </svg>
                        Обучение
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('settings.documents') }}" class="bg-gray-50 text-indigo-600 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold"  x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <svg class="h-6 w-6 shrink-0 text-indigo-600" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
                        </svg>  
                        Документы
                    </a>
                </li>
                {{-- <li>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"></path>
                        </svg>
                        Платежи
                    </a>
                </li> --}}
            </ul>
        </nav>
    </aside>
  
    <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
        <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
            <!-- Паспортные данные -->
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Паспортные данные</h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">Заполните серию и номер паспорта.</p>

                <form id="passportSeriaForm" action="{{ route('settings.general.setPassportSeria') }}" method="POST">
                    @csrf
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Серия</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-900">
                                <input 
                                    minlength="4"
                                    maxlength="4"
                                    id='passportSeriaInp' 
                                    disabled 
                                    name='passportSeria' 
                                    value="{{ Auth::user()->passportSeria }}" 
                                    class="bg-white"
                                >
                            </div>
                            <button type="button" onclick="updatePassportSeria(event)" class="font-semibold text-indigo-600 hover:text-indigo-500">Изменить</button>
                            <button type="submit" id='passportSeriaSub' class="font-semibold text-indigo-600 hover:text-indigo-500" style="display: none">Сохранить</button>
                        </dd>
                    </div>
                </form>
                <script>
                    function updatePassportSeria(event) {
                        console.log()
                        event.srcElement.style.display = 'none'
                        document.getElementById('passportSeriaInp').disabled = false; 
                        document.getElementById('passportSeriaInp').className = 'block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
                        document.getElementById('passportSeriaSub').style.display = '';
                    }
                    
                </script>
                <form id="passpoortNumberForm" action="{{ route('settings.general.setPasspoortNumber') }}" method="POST">
                    @csrf
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Номер</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-900">
                                <input 
                                    minlength="6"
                                    maxlength="6"
                                    id='passpoortNumberInp' 
                                    disabled 
                                    name='passpoortNumber' 
                                    value="{{ Auth::user()->passpoortNumber }}" 
                                    class="bg-white"
                                >
                            </div>
                            <button type="button" onclick="updatePasspoortNumber(event)" class="font-semibold text-indigo-600 hover:text-indigo-500">Изменить</button>
                            <button type="submit" id='passpoortNumberSub' class="font-semibold text-indigo-600 hover:text-indigo-500" style="display: none">Сохранить</button>
                        </dd>
                    </div>
                </form>
                <script>
                    function updatePasspoortNumber(event) {
                        event.srcElement.style.display = 'none'
                        document.getElementById('passpoortNumberInp').disabled = false; 
                        document.getElementById('passpoortNumberInp').className = 'block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
                        document.getElementById('passpoortNumberSub').style.display = '';
                    }
                    
                </script>
            </div>
            <div class="space-y-6">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Сканы паспорта</h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">Загрузите страницы паспорта</p>
                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Скан 2 страницы паспорта</h2>
                    @if ($userPassport2Page !== 1)
                    <div id="passportPage2ImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="passportPage2Img" src="" alt="Скан 2 страницы паспорта" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/passport_2_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('passportPage2Img').src = data.path;
                                    document.getElementById('passportPage2Img').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('passportPage2ImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadPassport2PageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        {{-- <label for="passportPage2" class="block text-sm font-medium text-gray-900">Скан 2 страницы паспорта</label> --}}
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="passportPage2" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="passportPage2" name="passportPage2" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Скан 3 страницы паспорта</h2>
                    @if ($userPassport3Page !== 1)
                    <div id="passportPage3ImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="passportPage3Img" src="" alt="Скан 3 страницы паспорта" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/passport_3_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('passportPage3Img').src = data.path;
                                    document.getElementById('passportPage3Img').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('passportPage3ImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadPassport3PageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        {{-- <label for="passportPage3" class="block text-sm font-medium text-gray-900">Скан 3 страницы паспорта</label> --}}
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="passportPage3" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="passportPage3" name="passportPage3" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Скан 5 страницы паспорта</h2>
                    @if ($userPassport5Page !== 1)
                    <div id="passportPage5ImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="passportPage5Img" src="" alt="Скан 5 страницы паспорта" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/passport_5_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('passportPage5Img').src = data.path;
                                    document.getElementById('passportPage5Img').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('passportPage5ImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadPassport5PageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        {{-- <label for="passportPage5" class="block text-sm font-medium text-gray-900">Скан 5 страницы паспорта</label> --}}
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="passportPage5" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="passportPage5" name="passportPage5" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            
            <!-- СНИЛС -->
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">СНИЛС</h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">Укажите ваш СНИЛС.</p>

                <form id="snilsForm" action="{{ route('settings.general.setSNILS') }}" method="POST">
                    @csrf
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">СНИЛС</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-900">
                                <input 
                                    id='snilsInp' 
                                    disabled 
                                    name='snils' 
                                    value="{{ Auth::user()->SNILS }}" 
                                    class="bg-white"
                                >
                            </div>
                            <button type="button" onclick="updateSnils(event)" class="font-semibold text-indigo-600 hover:text-indigo-500">Изменить</button>
                            <button type="submit" id='snilsSub' class="font-semibold text-indigo-600 hover:text-indigo-500" style="display: none">Сохранить</button>
                        </dd>
                    </div>
                </form>
                <script>
                    function updateSnils(event) {
                        console.log()
                        event.srcElement.style.display = 'none'
                        document.getElementById('snilsInp').disabled = false; 
                        document.getElementById('snilsInp').className = 'block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
                        document.getElementById('snilsSub').style.display = '';
                    }
                    
                </script>
            </div>

            <!-- Загрузка сканов -->
            <div class="space-y-6">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Скан СНИЛС</h2>
                @if ($userSnils)
                <div id="snilsImageContainer" class="mt-4">
                    <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                    <img id="snilsPhotoContainerImg" src="" alt="Скан СНИЛС" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                </div>
                @endif
                <script>
                    // Получаем путь к загруженному изображению
                    fetch('/user/{{ Auth::user()->id }}/document/snils')
                        .then(response => response.json())
                        .then(data => {
                            if (data.path) {
                                document.getElementById('snilsPhotoContainerImg').src = data.path;
                                document.getElementById('snilsPhotoContainerImg').style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Ошибка загрузки изображения:', error)
                            document.getElementById('snilsImageContainer').style.display = 'none';
                        });
                </script>
                <p class="mt-1 text-sm leading-6 text-gray-500">Загрузите отсканированный СНИЛС</p>
                <!-- Скан СНИЛС -->
                <form action="{{ route('settings.general.uploadSnilsScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                    @csrf
                    {{-- <label for="snilsPhoto" class="block text-sm font-medium text-gray-900">Скан СНИЛС</label> --}}
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="mt-4 flex text-sm text-gray-600">
                                <label for="snilsPhoto" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                    <span>Загрузите файл</span>
                                    <input id="snilsPhoto" name="snilsPhoto" type="file" class="sr-only" onchange="this.form.submit();">
                                </label>
                                <p class="pl-1">или переместите файл сюда</p>
                            </div>
                            <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Сканы диплома</h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">Загрузите страницы диплома</p>
                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Диплом (разворот)</h2>
                    @if ($userDiplomMainPage !== 1)
                    <div id="diplomPageImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="diplomPageImg" src="" alt="Диплом (разворот)" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/diplom_main_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('diplomPageImg').src = data.path;
                                    document.getElementById('diplomPageImg').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('diplomPageImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadDiplomMainPageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        {{-- <label for="passportPage2" class="block text-sm font-medium text-gray-900">Скан 2 страницы паспорта</label> --}}
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="diplomMainPage" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="diplomMainPage" name="diplomMainPage" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Вкладыш (сторона 1)</h2>
                    @if ($userDiplomSupplementFirstPage !== 1)
                    <div id="diplomFirstPageImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="diplomFirstPageImg" src="" alt="Вкладыш (сторона 1)" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/diplom_supplement_1_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('diplomFirstPageImg').src = data.path;
                                    document.getElementById('diplomFirstPageImg').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('diplomFirstPageImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadDiplomFirstPageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="diplomSupplementFirstPage" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="diplomSupplementFirstPage" name="diplomSupplementFirstPage" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="space-y-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Вкладыш (сторона 2)</h2>
                    @if ($userPassport5Page !== 1)
                    <div id="diplomSecondPageImageContainer" class="mt-4">
                        <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                        <img id="diplomSecondPageImg" src="" alt="Вкладыш (сторона 2)" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                    </div>
                    @endif
                    <script>
                        // Получаем путь к загруженному изображению
                        fetch('/user/{{ Auth::user()->id }}/document/diplom_supplement_2_page')
                            .then(response => response.json())
                            .then(data => {
                                if (data.path) {
                                    console.log(data)
                                    document.getElementById('diplomSecondPageImg').src = data.path;
                                    document.getElementById('diplomSecondPageImg').style.display = 'block';
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error)
                                document.getElementById('diplomSecondPageImageContainer').style.display = 'none';
                            });
                    </script>
                    <form action="{{ route('settings.general.uploadDiplomSecondPageScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                        @csrf
                        {{-- <label for="passportPage5" class="block text-sm font-medium text-gray-900">Скан 5 страницы паспорта</label> --}}
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600">
                                    <label for="diplomSupplementSecondPage" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                        <span>Загрузите файл</span>
                                        <input id="diplomSupplementSecondPage" name="diplomSupplementSecondPage" type="file" class="sr-only" onchange="this.form.submit();">
                                    </label>
                                    <p class="pl-1">или переместите файл сюда</p>
                                </div>
                                <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            
            @if ($userIsStudent) 
            {{-- Студак --}}
            <div class="space-y-6">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Скан студенческого билета</h2>
                @if ($userStud)
                <div id="studImageContainer" class="mt-4">
                    <label class="block text-sm font-medium text-gray-900">Загруженное изображение:</label>
                    <img id="studImg" src="" alt="Скан студенческого билета" style="width: 50%" class="h-auto mt-2 rounded-lg" style="display: none;">
                </div>
                @endif
                <script>
                    // Получаем путь к загруженному изображению
                    fetch('/user/{{ Auth::user()->id }}/document/stud')
                        .then(response => response.json())
                        .then(data => {
                            if (data.path) {
                                console.log(data)
                                document.getElementById('studImg').src = data.path;
                                document.getElementById('studImg').style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Ошибка загрузки изображения:', error)
                            document.getElementById('studImageContainer').style.display = 'none';
                        });
                </script>
                <form action="{{ route('settings.general.uploadStudScan') }}" method="POST" enctype="multipart/form-data" class="sm:col-span-full" onsubmit="this.submit();">
                    @csrf
                    {{-- <label for="passportPage2" class="block text-sm font-medium text-gray-900">Скан студенческого</label> --}}
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="mt-4 flex text-sm text-gray-600">
                                <label for="studPhoto" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                                    <span>Загрузите файл</span>
                                    <input id="studPhoto" name="studPhoto" type="file" class="sr-only" onchange="this.form.submit();">
                                </label>
                                <p class="pl-1">или переместите файл сюда</p>
                            </div>
                            <p class="text-xs text-gray-600">PNG, JPG до 10MB</p>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </main>
</div>
  


@endsection