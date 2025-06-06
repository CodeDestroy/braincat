<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto-condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="img/favicon_io/site.webmanifest">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-captcha@1.3.0/dist/js/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();
    for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(102230766, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
    });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/102230766" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <header class="bg-white sticky top-0 z-10 shadow-[rgba(0,0,15,0.1)_0px_8px_2px_-2px]">
            <nav class="mx-auto flex max-w-7xl items-center justify-between p-3 lg:px-8" aria-label="Global">
                {{-- Логотип --}}
                <a href="{{ url('/') }}" class="m-1.5 p-1.5 border-transparent focus:border-transparent focus:ring-0">
                    <span class="sr-only">Ученый кот</span>
                    <img class="h-12 sm:h-14 w-auto" src="{{ asset('img/braincat_logo.svg') }}" alt="">
                </a>
                <div class="flex">
                    <a href="https://vk.com/brain_cat" class="hidden sm:block px-1 pt-2.5 border-transparent focus:border-transparent focus:ring-0">
                    <span class="[&>svg]:h-7 [&>svg]:w-7">
                        <svg
                            class="fill-salt-700 hover:fill-salt-900"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path
                            d="M31.5 63.5C0 95 0 145.7 0 247V265C0 366.3 0 417 31.5 448.5C63 480 113.7 480 215 480H233C334.3 480 385 480 416.5 448.5C448 417 448 366.3 448 265V247C448 145.7 448 95 416.5 63.5C385 32 334.3 32 233 32H215C113.7 32 63 32 31.5 63.5zM75.6 168.3H126.7C128.4 253.8 166.1 290 196 297.4V168.3H244.2V242C273.7 238.8 304.6 205.2 315.1 168.3H363.3C359.3 187.4 351.5 205.6 340.2 221.6C328.9 237.6 314.5 251.1 297.7 261.2C316.4 270.5 332.9 283.6 346.1 299.8C359.4 315.9 369 334.6 374.5 354.7H321.4C316.6 337.3 306.6 321.6 292.9 309.8C279.1 297.9 262.2 290.4 244.2 288.1V354.7H238.4C136.3 354.7 78 284.7 75.6 168.3z" />
                        </svg>
                        </span>
                    </a>
                    <a href="https://t.me/+Rvqt2hkAZKMwZDFi" class="hidden sm:block px-1 pt-2.5 border-transparent focus:border-transparent focus:ring-0">
                    <span class="[&>svg]:h-7 [&>svg]:w-7">
                        <svg
                            class="fill-salt-700 hover:fill-salt-900"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 496 512">
                            <path
                            d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z" />
                        </svg>
                        </span>
                    </a>
                    <a href="https://chat.whatsapp.com/KeVp4ukYJCN564y8Z1fsOg" class="hidden sm:block px-1 pt-2.5 border-transparent focus:border-transparent focus:ring-0">
                    <span class="[&>svg]:h-7 [&>svg]:w-7">
                        <svg
                            class="fill-salt-700 hover:fill-salt-900"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path
                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                        </svg>
                        </span>
                    </a>
                </div>        
                {{-- Кнопка открытия моб меню --}}
                <div class="flex lg:hidden">
                    <button {{-- x-on:click="expanded = !expanded" --}} onclick="document.getElementById('mobileMenu').style.display = 'block'" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Открыть</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                {{-- Десктоп меню --}}
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="{{ url('/') }}" class="text-sm font-semibold leading-6 text-gray-900">Главная</a>
                    {{-- <a href="{{ url('/about') }}" class="text-sm font-semibold leading-6 text-gray-900">О нас</a> --}}
                    <a href="{{ route('education.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Обучение</a>
                    <a href="{{ url('/contacts') }}" class="text-sm font-semibold leading-6 text-gray-900">Контакты</a>
                    <a href="{{ route('documents') }}" class="text-sm font-semibold leading-6 text-gray-900">Документы</a>
                    {{-- <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                        </svg>
                    </button> --}}
                    @guest
                        <div class="relative" x-data="{ expanded: false }" >
                            <button 
                                x-on:click="expanded = !expanded" 
                                type="button" 
                                class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900" 
                                aria-expanded="false"
                                
                            >
                                Войти
                                <span aria-hidden="true">→</span>
                            </button>
                            <div 
                                x-show="expanded" 
                                x-on:click.outside="expanded = false" 
                                class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                                style="display: none; left: -22rem"
                            >
                                <div class="p-4">
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                        <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-mona-lisa-600" fill="none" stroke="currentColor" stroke-width="1.5"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-auto">
                                            @if (Route::has('login'))
                                                
                                                <a href="{{ route('login') }}" class="block font-semibold text-gray-900">
                                                    {{ __('Войти') }}
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                        <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-mona-lisa-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-auto">
                                            @if (Route::has('register'))
                                                
                                                <a href="{{ route('register') }}" class="block font-semibold text-gray-900">
                                                    {{ __('Зарегистрироваться') }}
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                    @else
                        <div class="relative" x-data="{ expanded: false }" >
                            <button x-on:click="expanded = !expanded"  type="button" class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900" aria-expanded="false">
                                {{ Auth::user()->name }}
                            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                            </button>
                            <div 
                                x-show="expanded" 
                                x-on:click.outside="expanded = false"  
                                style="left: -22rem"
                                class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                            >
                                <div class="p-4">
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                        <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-mona-lisa-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg>
                                        </div>
                                        <div class="flex-auto">
                                            <a href="{{ route('settings.general') }}" class="block font-semibold text-gray-900">
                                                Мой профиль
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="mt-1 text-gray-600">Просмотреть информацию о моём профиле</p>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->hasAnyAccess(['platform.*'])) 
                                    <div class="p-4">
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                            <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <svg class="h-6 w-6 text-gray-600 group-hover:text-mona-lisa-600" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-auto">
                                                <a href={{route('platform.index')}} class="block font-semibold text-gray-900">
                                                    Админка
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">Зайти в админ панель</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="grid grid-cols-1 divide-x divide-gray-900/5 bg-gray-50">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                        class="flex items-center justify-center gap-x-2.5 p-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-100">
                                        <svg class="h-5 w-5 flex-none text-gray-400" data-slot="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z"></path>
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z"></path>
                                        </svg>
                                        Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    @endguest
                    
                </div>
            </nav>
            <!-- Мобильое меню -->
            <div class="lg:hidden" role="dialog" aria-modal="true" x-data="{ expanded: false }">
                <div class="relative" class="fixed inset-0 z-10"></div>
                <div 
                    id='mobileMenu'
                    class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                    style="display: none"
                >
                    <div class="flex items-center justify-between">
                    <a href="/" class="-m-1.5 p-1.5">
                        <span class="sr-only">Учёный кот</span>
                        <img class="h-20 w-auto" src="{{ asset('img/braincat_logo.jpg') }}" alt="">
                    </a>
                    <button onclick="document.getElementById('mobileMenu').style.display = 'none'" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Закрыть</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="{{ url('/') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Главная</a>
                                {{-- <a href="{{ url('/about') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">О нас</a>--}}
                                <a href="{{ route('education.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Обучение</a>
                                <a href="{{ url('/contacts') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Контакты</a>
                                <a href="{{ route('documents') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Документы</a>
                                <a href="https://vk.com/brain_cat" class="-mx-3 block sm:hidden rounded-lg px-3 py-2 text-base font-normal leading-7 text-gray-900 hover:bg-gray-50">ВКонтакте</a>
                                <a href="https://t.me/+Rvqt2hkAZKMwZDFi" class="-mx-3 block sm:hidden rounded-lg px-3 py-2 text-base font-normal leading-7 text-gray-900 hover:bg-gray-50">Telegram</a> 
                                <a href="https://chat.whatsapp.com/KeVp4ukYJCN564y8Z1fsOg" class="-mx-3 block sm:hidden rounded-lg px-3 py-2 text-base font-normal leading-7 text-gray-900 hover:bg-gray-50">WhatsApp</a>   
                            </div>
                            @guest
                                @if (Route::has('login'))
                                    <div class="py-6">
                                        <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('Войти') }}</a>
                                    </div>
                                @endif
                            @else
                                
                                <a href="{{ route('settings.general') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ Auth::user()->name }}</a>
                                
                                @if (Auth::user()->hasAnyAccess(['platform.*'])) 
                                    <a href="{{ route('platform.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Админка</a>
                                @endif
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                            Выйти
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="py-0">
            @yield('content')
        </main>
        <footer class="bg-slate-100">
            <div class="bg-white">
            <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
                <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
                    <div class="pb-6">
                        <a href="{{ url('/') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Главная</a>
                    </div>
                   {{--  <div class="pb-6">
                        <a href="{{ url('/about') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">О нас</a>
                    </div> --}}
                    <div class="pb-6">
                        <a href="{{ route('education.index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Обучение</a>
                    </div>
                    
                    <div class="pb-6">
                        <a href="{{ url('/contacts') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Контакты</a>
                    </div>
                    <div class="pb-6">
                        <a href="{{ route('documents') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Документы</a>
                    </div>
                </nav>
                <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; 2025 АНО ДПО "ФОРУМ". Учёный кот. Все права защищены.</p>
            </div>
            </div>
        </footer> 
    </div>
</body>
</html>
