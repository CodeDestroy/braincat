@extends('layouts.app')

@section('content')
<div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
    {{-- <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div> --}}
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Регистрация на курс </h2>
        <p class="mt-2 text-lg/8 text-gray-600">«{{$course['name']}}»</p>
    </div>
    <form action="{{ route('profile.registerSecond') }}" method="POST" enctype="multipart/form-data" class="mx-auto mt-16 max-w-xl sm:mt-20">
        @csrf
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            {{-- <div class="sm:col-span-2">
                <label for="snils" class="block text-sm/6 font-semibold text-gray-900">СНИЛС</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->SNILS }}" required type="text" name="snils" id="snils" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="000-000-000 00">
                </div>
            </div> --}}
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm/6 font-semibold text-gray-900">Место проживания</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->address }}" type="text" name="address" id="address" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="г. Москва, ул. Космонавтов...">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label  for="postIndex" class="block text-sm/6 font-semibold text-gray-900">Почтовый индекс</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->postIndex }}" minlength="6" maxlength="6" type="text" name="postIndex" id="postIndex" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="000000">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="phone" class="block text-sm/6 font-semibold text-gray-900">Телефон (через +7)</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->phone }}" required type="text" name="phone" id="phone" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="+7 (000)-00 00 000">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="email" class="block text-sm/6 font-semibold text-gray-900">Подтвердите почту</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->email }}" required type="text" name="email" id="email" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="почта@mail.ru">
                </div>
            </div>
            
            <div class="sm:col-span-2">
                <label for="birthDay" class="block text-sm/6 font-semibold text-gray-900">Дата рождения</label>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <input value="{{ Auth::user()->birthday }}" type="date" name="birthDay" id="birthDay" class="px-3.5 block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="01.01.1901">
                </div>
            </div>
            <input type="hidden" name="course_id" x-bind:value="id" value="{{$course_id}}" required>
            <input type="hidden" name="url" x-bind:value="url" value="{{$course['url']}}" required>

            {{-- Чекбоксы --}}
            <div id="isStudentDiv" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input id="isStudent" onchange="setStudent(this)" value="true" type="checkbox" name="isStudent" class="accent-mona-lisa-800 w-4 h-4 text-mona-lisa-800 bg-gray-100 border-gray-300 rounded  dark:bg-gray-700 dark:border-gray-600">
                    <label for="isStudent" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Студент профильного ВУЗа</label>
                </div>
            </div> 
            <script defer>
                function setStudent(event) {
                    const studPhotoDiv = document.getElementById('studPhotoDiv')
                    /* const isHealthyChildGk = document.getElementById('isHealthyChildGk')
                    const isHealthyChildFranch = document.getElementById('isHealthyChildFranch')

                    const isAPPCPDiv = document.getElementById('isAPPCPDiv')
                    const isAPPCP = document.getElementById('isAPPCP')

                    const isLegal = document.getElementById('isLegal')
                    const isLegalHealthyChildGK = document.getElementById('isLegalHealthyChildGK') */

                    if (event.checked) {
                        
                        //Дизейблим кнопки я сотрудник и убираем галочки
                        /* isHealthyChildGk.checked = false
                        isHealthyChildGk.disabled = true
                        isHealthyChildFranch.checked = false
                        isHealthyChildFranch.disabled = true */
                        
                        //На всякий убираем галки с оплат юр лицом
                        /* isLegal.checked = false
                        isLegalHealthyChildGK.checked = false */


                        //Показываем блок загрузки студака
                        studPhotoDiv.classList.remove('hide');
                        studPhotoDiv.classList.add('visible');
                        studPhotoDiv.classList.remove('hiding');
                    }
                    else {

                        //Возвращаем активность кнопкам я сотрудник
                        /* isHealthyChildGk.disabled = false
                        isHealthyChildFranch.disabled = false */
                        
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
           <!--  <div id="isAPPCPDiv" class="sm:col-span-2">
                <div class="relative mt-2 rounded-md shadow-sm items-center flex">
                    <input id="isAPPCP" value="true" type="checkbox" name="isAPPCP" class="accent-mona-lisa-800 w-4 h-4 text-mona-lisa-800 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                    <label for="isAPPCP" class="my-2 ms-2.5 text-md font-medium text-black-900 dark:text-black-300">Являюсь членом Ассоциации педагогов, психологов, психотерапевтов</label>
                </div>
            </div>  -->
            {{-- <div>
                <label for="workPlace" class="block text-sm/6 font-semibold text-gray-900">Место работы</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->workPlace }}" id="workPlace" type="text" name="workPlace" id="workPlace" autocomplete="workPlace" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="workPost" class="block text-sm/6 font-semibold text-gray-900">Должность</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->workPost }}" type="text" name="workPost" id="workPost" autocomplete="workPost" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="spetiality" class="block text-sm/6 font-semibold text-gray-900">Специальность</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->spetiality }}" type="text" name="spetiality" id="spetiality" autocomplete="spetiality" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="tgNickname" class="block text-sm/6 font-semibold text-gray-900">Профиль Телеграм (@user)</label>
                <div class="mt-2.5">
                    <input value="{{ Auth::user()->tgNickname }}" type="text" name="tgNickname" id="tgNickname" autocomplete="tgNickname" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm/6">
                </div>
            </div>   --}}
            {{-- <div class="sm:col-span-2  mt-2">
                <label for="phone-number" class="block text-sm/6 font-semibold text-gray-900">Паспортные данные</label>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 mt-2">
                        <label for="passportSeria" class="block text-sm/6 font-medium text-gray-900">Серия</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <input value="{{ Auth::user()->passportSeria }}" minlength="4" maxlength="4" type="text" name="passportSeria" id="passportSeria" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="0000">
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
                            <input value="{{ Auth::user()->passpoortNumber }}" minlength="6" maxlength="6" type="text" name="passpoortNumber" id="passpoortNumber" class="px-3.5 block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6" placeholder="000000">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      --}}   
            <div class="sm:col-span-full animated hide" id='studPhotoDiv'>
                <label for="studPhotoDiv" class="block text-sm/6 font-medium text-gray-900">Фотография или скан сутденческого билета</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm/6 text-gray-600">
                            <label for="studPhoto" class="relative cursor-pointer rounded-md bg-white font-semibold text-mona-lisa-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-mona-lisa-600 focus-within:ring-offset-2 hover:text-mona-lisa-500">
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

            {{-- <div class="flex gap-x-4 sm:col-span-2">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <input required type="checkbox" value="agree" class="sr-only peer">
                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-mona-lisa-300 dark:peer-focus:ring-mona-lisa-800 rounded-full peer dark:bg-grey-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-mona-lisa-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Я согласен с условиями пользовательского соглашения</span>
                </label>
            </div> --}}
             
        </div>
        <div class="mt-8">
            <button type="submit" class="block w-full rounded-md bg-mona-lisa-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-mona-lisa-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mona-lisa-600">Подтвердить</button>
        </div>
        <div class="grid grid-cols-1 gap-x-8 gap-y-3 sm:grid-cols-2 mt-2">
            <div id="isAgreePrivacy" class="sm:col-span-2">
                <div class="relative mt-4 rounded-md shadow-sm items-center flex">
                    <input id="agree" required type="checkbox" class="accent-mona-lisa-800 min-w-4 min-h-4 text-mona-lisa-800 bg-gray-100 border-gray-300 rounded  dark:bg-gray-700 dark:border-gray-600">
                    <label for="agree" class="my-2 ms-2.5 text-md font-medium text-grey-900 dark:text-grey-300">Согласен с <a target="_blank" href="{{ route('documents.privacy') }}" class="text-mona-lisa-600">политикой конфиденциальности</a></label>
                </div>
            </div> 
            
            <div id="isAgreeWithPersonalDataProc" class="sm:col-span-2">
                <div class="relative rounded-md shadow-sm items-center flex">
                    <input id="agreeWithPersonalDataProc" required type="checkbox" class="accent-mona-lisa-800 min-w-4 min-h-4 text-mona-lisa-800 bg-gray-100 border-gray-300 rounded  dark:bg-gray-700 dark:border-gray-600">
                    <label for="agreeWithPersonalDataProc" class="my-2 ms-2.5 text-md font-medium text-grey-900 dark:text-grey-300">Согласен с <a target="_blank" href="{{ route('documents.policy') }}" class="text-mona-lisa-600">политикой обработки персональных данных</a></label>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection