{{-- @extends('errors::minimal') --}}
@extends('layouts.app')
@section('title', __('Не найдено'))
{{-- @section('code', '404') --}}
@section('content')
    {{-- <div>
        @if($exception->getMessage())
            <div class="container text-center mt-5">
                <h1 class="display-4">404</h1>
                <p class="lead">{{$exception->getMessage()}}</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Вернуться на главную</a>
            </div>
        @else
            <div class="container text-center mt-5">
                <h1 class="display-4">404</h1>
                <p class="lead">Извините, страница, которую вы ищете, не существует.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Вернуться на главную</a>
            </div>
        @endif
    </div> --}}


<div class="h-0 min-h-[768px] bg-white" style="padding-top: 5rem; padding-bottom: 5rem">

    <!--
    This example requires updating your template:
  
    ```
    <html class="h-full">
    <body class="h-full">
    ```
    -->
    <main class="grid min-h-full place-items-center bg-white px-6 py-32 sm:py-32 lg:px-8">
        <div class="text-center">
                {{-- <p class="text-base font-semibold text-indigo-600">404</p> --}}
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{$error_title}}</h1>
                <p class="mt-6 text-base leading-7 text-gray-600">{{$error_message}}</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Вернуться на главную</a>
                {{-- <a href="#" class="text-sm font-semibold text-gray-900">Contact support <span aria-hidden="true">→</span></a> --}}
            </div>
        </div>
    </main>
  
</div>
@endsection