@extends('layouts.app')

@section('content')
<style>
canvas{
  /*prevent interaction with the canvas*/
  pointer-events:none;
}
</style>

<div class="container mx-auto px-4">
    <div class="flex min-h-full justify-center">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Создайте аккаунт') }}</h2>


                <div class="flex items-center justify-between mt-10">
                    <div class="flex items-center text-sm">
                        <p class="text-gray-500"> Уже зарегистрированы?</p>
                    </div>
                    <div class="text-sm leading-6">
                        <a href="{{ route('login') }}" class="font-semibold text-mona-lisa-600 hover:text-mona-lisa-700">{{ __('Войдите в аккаунт') }}</a>
                    </div>
                </div>


                <div class="mt-10">
                    <form onsubmit="submitForm(event)" method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Фамилия -->
                        <div>
                            <label for="secondName" class="block text-sm font-medium text-gray-900">{{ __('Фамилия') }}</label>
                            <div class="mt-2">

                                <input id="secondName" name="secondName" type="text" value="{{ old('secondName') }}" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('lastName') border-red-500 @enderror">

                                @error('secondName')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Имя -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-900">{{ __('Имя') }}</label>
                            <div class="mt-2">

                                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('name') border-red-500 @enderror">

                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Отчество -->
                        <div>
                            <label for="patronymicName" class="block text-sm font-medium text-gray-900">{{ __('Отчество') }}</label>
                            <div class="mt-2">

                                <input id="patronymicName" name="patronymicName" type="text" value="{{ old('patronymicName') }}" class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('patronymicName') border-red-500 @enderror">

                                @error('patronymicName')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                            <div class="mt-2">

                                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('email') border-red-500 @enderror">

                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Телефон -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-900">{{ __('Телефон') }}</label>
                            <div class="mt-2">

                                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('phone') border-red-500 @enderror">

                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Дата рождения -->
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-900">{{ __('Дата рождения') }}</label>
                            <div class="mt-2">

                                <input id="birthday" name="birthday" type="date" value="{{ old('birthday') }}" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('birthday') border-red-500 @enderror">

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
                                    <input id="male" type="radio" value="male" name="gender" {{ old('gender') == 'male' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-mona-lisa-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="male" class="ms-2 text-sm font-medium text-gray-900">{{ __('Мужской') }}</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="female" type="radio" value="female" name="gender" {{ old('gender') == 'female' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-mona-lisa-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="female" class="ms-2 text-sm font-medium text-gray-900">{{ __('Женский') }}</label>
                                </div>
                            </div>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Пароль -->
                        {{-- <div style="margin-top: 0.75rem">
                            <label for="password" class="block text-sm font-medium text-gray-900">{{ __('Пароль') }}</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div style="margin-top: 0.75rem">
                            <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                            <div class="relative mb-6">
                                <button style="z-index: 5" onclick="console.log(1)" class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"  data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                    </svg>
                                </button>
                                <input type="password" id="input-group-1" class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 @error('password') border-red-500 @enderror">
                            </div>
                        </div> --}}

                        <div style="margin-top: 0.75rem">
                            <label for="password" class="block text-sm font-medium text-gray-900">{{ __('Пароль') }}</label>
                            <div class="relative mt-2">
                                <input id="password" name="password" type="password" required

                                       class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 pr-10 @error('password') border-red-500 @enderror">

                                    <button id="showPass" onclick="showPassFunc()" type="button" class="absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500 hover:text-gray-700" style="right: 5px">
                                        
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                                        </svg>
                                    </button>
                                    <button id="dontShowPass" onclick="showPassFunc()" type="button" class="absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500 hover:text-gray-700" style="right: 5px; display: none;">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"  data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                        </svg>
                                    </button>
                                    
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <script>
                            const showPassBtn = document.getElementById('showPass')
                            const dontShowPassBtn = document.getElementById('dontShowPass')
                            const passwordInp = document.getElementById('password')
                            var showPassBool = false;
                            function showPassFunc() {
                                if (!showPassBool) {
                                    showPassBtn.style.display = 'none'
                                    dontShowPassBtn.style.display = 'block'
                                    showPassBool = true;
                                    passwordInp.type = 'text'
                                }
                                else {
                                    showPassBtn.style.display = 'block'
                                    dontShowPassBtn.style.display = 'none'
                                    showPassBool = false;
                                    passwordInp.type = 'password'
                                }
                            }
                        </script>

                        <!-- Подтверждение пароля -->
                        <div>
                            <label for="password-confirm" class="block text-sm font-medium text-gray-900">{{ __('Подтверждение пароля') }}</label>
                            <div class="mt-2">

                                <input id="password-confirm" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6">

                            </div>
                        </div>

                        <div>
                            <div id="captcha">
                            </div>
                            <label for="captcha" class="block text-sm font-medium text-grey-900">Введите код</label>

                            <input id="cpatchaTextBox" type="text" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6">

                        </div>
                        

                        <!-- Кнопка регистрации -->
                        <div>

                            <button type="submit" class="w-full py-2 bg-mona-lisa-600 text-white rounded-md hover:bg-mona-lisa-700 focus:outline-none focus:ring-2 focus:ring-mona-lisa-600">

                                {{ __('Зарегистрироваться') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 md:block">
            <img class="mt-16 inset-0 inline-block align-top w-full object-contain" src="{{ asset('img/register_main.jpg') }}" alt="">
        </div>
    </div>
</div>
<script defer>
    createCaptcha();
    var code;
    function createCaptcha() {
    //clear the contents of captcha div first 
        document.getElementById('captcha').innerHTML = "";
        var charsArray =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
        var lengthOtp = 6;
        var captcha = [];
        for (var i = 0; i < lengthOtp; i++) {
            //below code will not allow Repetition of Characters
            var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
            if (captcha.indexOf(charsArray[index]) == -1)
            captcha.push(charsArray[index]);
            else i--;
        }
        var canv = document.createElement("canvas");
        canv.id = "captchaCanv";
        canv.width = 150;
        canv.height = 75;
        var ctx = canv.getContext("2d");
        ctx.font = "34px Georgia";
        ctx.strokeText(captcha.join(""), 0, 30);
        //storing captcha so that can validate you can save it somewhere else according to your specific requirements
        code = captcha.join("");
        document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
    }
    function submitForm(event) {
        event.preventDefault();
        const form = event.target;
        if (document.getElementById("cpatchaTextBox").value == code) {
            form.submit();
        }else{
            alert("Код введён неверно. Попробуйте снова");
            createCaptcha();
        }
    }
</script>
@endsection
