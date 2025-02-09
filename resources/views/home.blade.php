@extends('layouts.app')

@section('content')

<div id="hero">
    <hero />
</div>

<div id="gridlist">
    <grid-list />
</div>
  
<div class="bg-gray-100 py-24 sm:py-32"  id='dopObr'{{-- style="height: 100vh;" --}}>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-mona-lisa-600 sm:text-4xl">Обучайтесь с нами</h2>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600" aria-hidden="true">
                            <svg class="h-7 w-7 text-white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" fill="#d43f2e"/>
                            </svg>
                        </div>
                    </dt>
                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                        <p class="flex-auto">Внимательное отношение к каждому слушателю</p>
                    </dd>
                </div>
                <div class="flex flex-col">
                  <dt class="text-base font-semibold leading-7 text-gray-900">
                    <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600">
                        <svg class="h-7 w-7 text-white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" fill="#d43f2e"/>
                        </svg>
                    </div>
                  </dt>
                  <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                      <p class="flex-auto">Комфортный доступ к обучающим материалам</p>
                  </dd>
                </div>
                <div class="flex flex-col">
                  <dt class="text-base font-semibold leading-7 text-gray-900">
                      <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600">
                      <svg class="h-7 w-7 text-white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" fill="#d43f2e"/>
                        </svg>
                      </div>
                  </dt>
                  <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                      <p class="flex-auto">Живой контакт со спикерами и кураторами курсов</p>
                  </dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<div id="cards">
    <cards />
</div>

@endsection