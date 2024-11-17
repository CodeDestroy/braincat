{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="firstName" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control @error('name') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="name" autofocus>

                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Телефон') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex min-h-full justify-center">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Создайте аккаунт') }}</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Уже зарегистрированы?
                    <a href="{{ route('login') }}" class="font-semibold text-purple-800 hover:text-purple-700">{{ __('Войдите в свой аккаунт') }}</a>
                </p>

                <div class="mt-10">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Фамилия -->
                        <div>
                            <label for="secondName" class="block text-sm font-medium text-gray-900">{{ __('Фамилия') }}</label>
                            <div class="mt-2">
                                <input id="secondName" name="secondName" type="text" value="{{ old('secondName') }}" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('lastName') border-red-500 @enderror">
                                @error('secondName')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Имя -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-900">{{ __('Имя') }}</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Отчество -->
                        <div>
                            <label for="patronymicName" class="block text-sm font-medium text-gray-900">{{ __('Отчество') }}</label>
                            <div class="mt-2">
                                <input id="patronymicName" name="patronymicName" type="text" value="{{ old('patronymicName') }}" class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('patronymicName') border-red-500 @enderror">
                                @error('patronymicName')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Телефон -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-900">{{ __('Телефон') }}</label>
                            <div class="mt-2">
                                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Дата рождения -->
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-900">{{ __('Дата рождения') }}</label>
                            <div class="mt-2">
                                <input id="birthday" name="birthday" type="date" value="{{ old('birthday') }}" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('birthday') border-red-500 @enderror">
                                @error('birthday')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Пол -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900">{{ __('Пол') }}</label>
                            <div class="flex items-center space-x-6 pt-4">
                                <div class="flex items-center mb-4">
                                    <input id="male" type="radio" value="male" name="gender" {{ old('gender') == 'male' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-purple-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="male" class="ms-2 text-sm font-medium text-gray-900">{{ __('Мужской') }}</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="female" type="radio" value="female" name="gender" {{ old('gender') == 'female' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-purple-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="female" class="ms-2 text-sm font-medium text-gray-900">{{ __('Женский') }}</label>
                                </div>
                            </div>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Пароль -->
                        <div style="margin-top: 0.75rem">
                            <label for="password" class="block text-sm font-medium text-gray-900">{{ __('Пароль') }}</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Подтверждение пароля -->
                        <div>
                            <label for="password-confirm" class="block text-sm font-medium text-gray-900">{{ __('Подтверждение пароля') }}</label>
                            <div class="mt-2">
                                <input id="password-confirm" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 outline-none accent-purple-800 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="captcha" class="block text-sm font-medium text-grey-900">Введите код</label>
                            <input class="jCaptcha" id="captcha" type="text" placeholder="Введите результат сюда">
                        </div>
                        

                        <!-- Кнопка регистрации -->
                        <div>
                            <button type="submit" class="w-full py-2 bg-purple-800 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-800">
                                {{ __('Зарегистрироваться') }}
                            </button>
                        </div>
                    </form>
                    <script>
                        var myCaptcha = new jCaptcha({
                            el: '.jCaptcha',
                            canvas: {
                                class: 'jCaptchaCanvas',
                                style: {
                                    // required properties for captcha stylings:
                                    width: 100,
                                    height: 15,
                                    textBaseline: 'top',
                                    font: '15px Arial',
                                    textAlign: 'left',
                                    fillStyle: '#ddd'
                                }
                            },
                            // set callback function for success and error messages:
                            callback: ( response, $captchaInputElement, numberOfTries ) => {
                                if ( response == 'success' ) {
                                    // success handle, e.g. continue with form submit
                                }
                                if ( response == 'error' ) {
                                    // error handle, e.g. add error class to captcha input
                    
                                    if (numberOfTries === 3) {
                                        // maximum attempts handle, e.g. disable form
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-contain" src="{{ asset('img/register_main.jpg') }}" alt="">
        </div>
    </div>
</div>
@endsection
