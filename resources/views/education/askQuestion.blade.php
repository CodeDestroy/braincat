@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
@endphp
<div class="container mx-auto sm:px-16 px-3 mt-8">
    <form @if ($theme_id) action="{{route('education.askQuestion', ['course_id' => $course_id, 'theme_id'=>$theme_id])}}" @endif method="POST" enctype="multipart/form-data">
        @csrf
        <div class="{{$theme ? 'sm:columns-2' : 'columns-2'}} columns-1 " >
            <div class="w-full text-left">
                <p class="inline-flex w-full justify-center sm:justify-start gap-x-1.5 px-3 py-2 text-md font-semibold text-gray-900">
                    Вопрос по теме:
                </p>
                
            </div>
            {{-- @if($theme)
                <div class="w-full text-left xs:visible hidden">
                    <p class="inline-flex w-full justify-center gap-x-1.5 px-3 py-2 text-md font-semibold text-gray-900">
                        {{$theme->name}}
                    </p>
                </div>
            @endif --}}
            <div class="md:w-64 w-full text-right" style="margin-left: auto; margin-right: 0">
                <div x-data="dropdown()" @keydown.escape.stop="open = false" @click.away="open = false" class="relative inline-block text-left w-full">
                    
                    <div>
                        <button type="button" style="padding-left: 30px" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" x-ref="button" @click="open = !open" aria-expanded="open" aria-haspopup="true">
                            
                            @if($theme)    
                                {{$theme->name}}
                            @else
                                Выберите тему
                            @endif
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div x-show="open" x-transition class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="menu-items" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1 overflow-y-auto" role="none" style="max-height: 50svh">
                            @foreach ($themes as $index => $theme)
                                <a 
                                    href="/education/course/{{$course_id}}/askQuestion/theme/{{$theme->id}}" 
                                    class="text-gray-700 block px-4 py-2 text-sm" 
                                    :class="{ 'bg-gray-100 text-gray-900': activeIndex === {{ $index }}, 'text-gray-700': !(activeIndex === {{ $index }}) }" 
                                    role="menuitem" 
                                    tabindex="-1" 
                                    @click="open = false" 
                                    @mouseenter="activeIndex = {{ $index }}" 
                                    @mouseleave="activeIndex = null"
                                >
                                    {{ $theme->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if ($theme_id)
        <div class="flex min-h-96 overflow-hidden" style="max-height: 50svh">
            <div class="flex-1">
                <div class="overflow-y-auto p-4" id="messages-container" style="max-height: 50svh">
                    <!-- Ваши сообщения здесь -->
                    @foreach ($messages as $message)
                        <div class="{{$message->user_id == $user->id ? 'justify-end ' : ''}} flex mb-4">
                            <div class="flex flex-col">
                                <div>
                                    <p class="text-xs text-gray-500 text-right pr-2">{{ $message->created_at->format('d.m в H:i') }}@if ($message->isAnonymous), Приватный вопрос@endif</p>
                                </div>
                                <div class="{{$message->user_id == $user->id ? 'bg-purple-700 text-white' : 'bg-white'}} flex max-w-96 rounded-lg p-3 gap-3 ">
                                    <p>{{$message->text}}</p>
                                    
                                    
                                </div>
                                <div>
                                    @foreach ($message->attachments as $attachment)
                                        {{-- <p>{{$attachment->file}}</p> --}}
                                        <a href="/storage/{{$attachment->file}}" target="_blank">
                                            <svg class="w-6 h-6 text-purple-700" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="bg-white border-t border-gray-300 p-4 bottom-0 mt-2 " style="width: 100%">
            <div class="flex items-center">
                <input type="text" placeholder="Текст..." name="text" class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500">
                <label for="file-upload" class="cursor-pointer bg-gray-200 p-2 rounded-md hover:bg-gray-300 transition ml-2">
                    <svg class="w-6 h-6 text-purple-700" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"></path>
                    </svg>
                </label>
                <input type="file" id="file-upload" name="file" class="hidden">
                <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded-md ml-2">Отправить</button>
                <!-- Кнопка загрузки файла -->
                
            </div>
        </div>
        <div id="file-preview" class="hidden ml-2 flex items-center space-x-2">
            <img id="preview-image" src="" class="w-12 h-12 rounded-md hidden">
            <span id="file-name" class="text-gray-700"></span>
        </div>
        {{-- <div class="flex items-center space-x-6 pt-0 px-4">
            <div class="flex items-center mb-4">
                <input type="checkbox" value="true" id='isAnonymous' name="isAnonymous" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-purple-800 dark:bg-gray-700 dark:border-gray-600">
                <label for="isAnonymous" class="ms-2 text-sm font-medium text-gray-900">{{ __('Анонимный вопрос') }}{{ __(' (в тексте сообщения укажите как с Вами связаться)') }}</label>
            </div>

        </div> --}}
    </form>
    @else
    <div class="bg-white p-4 bottom-0 " style="width: 100%; min-height: 56vh; display: flex; align-items: center;">
        <div class="flex items-center mx-auto">
            <h2 class=" text-4xl text-purple-700">Выберите тему</h2>
        </div>
    </div>
    @endif
</div>

<script>
    function dropdown() {
        return {
            open: false,
            activeIndex: null,
        };
    }
    document.addEventListener("DOMContentLoaded", function() {
        const messagesContainer = document.getElementById('messages-container');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
</script>
<script>
    document.getElementById('file-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('file-preview');
        const previewImage = document.getElementById('preview-image');
        const fileName = document.getElementById('file-name');
    
        if (file) {
            previewContainer.classList.remove('hidden');
            fileName.textContent = file.name;
    
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
            }
        } else {
            previewContainer.classList.add('hidden');
        }
    });
</script>
{{-- <pre>
{{ print_r($themes) }}   
</pre> --}}
@endsection
