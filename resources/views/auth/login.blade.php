@extends('layouts.app')

@section('content')

<div class="container" style="display: block; margin-left: auto; margin-right: auto">
    <div class="flex min-h-full justify-center">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-salt-700">{{ __('Войдите в аккаунт') }}</h2>
                        @if (Route::has('register'))
                            <div class="flex items-center justify-between mt-10">
                                <div class="flex items-center text-sm">
                                    <p class="text-gray-500">Нет учетной записи? </p>
                                </div>
                                <div class="text-sm leading-6">
                                    <a href="{{ route('register') }}" class="font-semibold text-mona-lisa-600 hover:text-mona-lisa-600">{{ __('Зарегистрируйтесь') }}</a>
                                </div>
                            </div>
                        @endif
                </div>
        
                <div class="mt-10">
                    <div>
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Почта') }}</label>
                                <div class="mt-2">
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        autocomplete="email" 
                                        required 
                                        class="@error('email') is-invalid @enderror block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
            
                            <div>
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password') is-invalid @enderror block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded accent-purple-800 border-gray-300 text-purple-800 focus:ring-purple-800" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="ml-3 block text-sm leading-6 text-gray-700">{{ __('Запомнить меня') }}</label>
                                </div>
            
                                @if (Route::has('password.request'))
                                    <div class="text-sm leading-6">
                                        <a href="{{ route('password.request') }}" class="font-semibold text-mona-lisa-600 hover:text-mona-lisa-600">{{ __('Забыли пароль?') }}</a>
                                    </div>
                                @endif
                            </div>
            
                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-salt-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-salt-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-salt-800">
                                    {{ __('Войти') }}
                                </button>
                            </div>
                        </form>
                    </div>
        
                    <div class="mt-10">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm font-medium leading-6">
                                <span class="bg-white px-6 text-gray-900">Войти с помощью</span>
                            </div>
                        </div>
            
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.04001 12C2.04001 6.477 6.51601 2 12.04 2C17.562 2 22.04 6.477 22.04 12C22.04 17.523 17.562 22 12.04 22C6.51601 22 2.04001 17.523 2.04001 12Z" fill="#FC3F1D"/>
                                    <path d="M13.32 7.666H12.396C10.702 7.666 9.81099 8.524 9.81099 9.789C9.81099 11.219 10.427 11.889 11.692 12.748L12.737 13.452L9.73399 17.939H7.48999L10.185 13.925C8.63499 12.814 7.76499 11.735 7.76499 9.91C7.76499 7.622 9.35999 6.06 12.385 6.06H15.388V17.928H13.32V7.666Z" fill="white"/>
                                </svg>
                                <span class="text-sm font-semibold leading-6">Yandex ID</span>
                            </a>
                
                            <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_5_82)">
                                        <path d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z" fill="url(#paint0_linear_5_82)"/>
                                        <path d="M8.12292 12.8772L9.54663 16.8178C9.54663 16.8178 9.72463 17.1865 9.91523 17.1865C10.1058 17.1865 12.9407 14.2373 12.9407 14.2373L16.0932 8.14832L8.17373 11.86L8.12292 12.8772Z" fill="#C8DAEA"/>
                                        <path d="M10.0106 13.8878L9.73733 16.7924C9.73733 16.7924 9.62293 17.6824 10.5127 16.7924C11.4025 15.9024 12.2542 15.2161 12.2542 15.2161" fill="#A9C6D8"/>
                                        <path d="M8.14859 13.0178L5.21999 12.0636C5.21999 12.0636 4.86999 11.9216 4.98269 11.5996C5.00589 11.5332 5.05269 11.4767 5.19269 11.3796C5.84159 10.9273 17.2033 6.84359 17.2033 6.84359C17.2033 6.84359 17.5241 6.73549 17.7133 6.80739C17.7601 6.82188 17.8022 6.84854 17.8353 6.88465C17.8684 6.92076 17.8914 6.96501 17.9018 7.01289C17.9222 7.09746 17.9308 7.18446 17.9272 7.27139C17.9263 7.34659 17.9172 7.41629 17.9103 7.52559C17.8411 8.64209 15.7703 16.9749 15.7703 16.9749C15.7703 16.9749 15.6464 17.4625 15.2025 17.4792C15.0934 17.4827 14.9847 17.4642 14.8829 17.4249C14.7811 17.3855 14.6883 17.326 14.61 17.25C13.7389 16.5007 10.7281 14.4773 10.0628 14.0323C10.0478 14.0221 10.0351 14.0087 10.0257 13.9932C10.0163 13.9777 10.0103 13.9603 10.0082 13.9423C9.99889 13.8954 10.0499 13.8373 10.0499 13.8373C10.0499 13.8373 15.2925 9.17729 15.432 8.68809C15.4428 8.65019 15.402 8.63149 15.3472 8.64809C14.999 8.77619 8.96279 12.5881 8.29659 13.0088C8.24863 13.0233 8.19795 13.0264 8.14859 13.0178Z" fill="white"/>
                                    </g>
                                    <defs>
                                        <linearGradient id="paint0_linear_5_82" x1="12" y1="24" x2="12" y2="0" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#1D93D2"/>
                                            <stop offset="1" stop-color="#38B0E3"/>
                                        </linearGradient>
                                        <clipPath id="clip0_5_82">
                                        <rect width="24" height="24" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="text-sm font-semibold leading-6">Telegram</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 md:block">
            <img class="absolute inset-0 h-full w-full object-contain" src="{{ asset('img/login_main.jpg') }}" alt="">
        </div>
    </div>
</div>
@endsection
