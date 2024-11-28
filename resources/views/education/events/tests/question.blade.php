@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 my-5 ">
    <form action="submitTest" method="POST">
        @csrf
        @foreach ($questions as $question)
            <div class="mb-6">
                {{-- <legend class="text-sm font-semibold leading-6 text-gray-900 mt-2">ГОООООООООООООООООООООООООООООООЙДА?</legend>
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center ">
                        <input id="small" aria-describedby="small-description" name="plan" type="radio" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="small" class="font-medium text-gray-900">ГОЙДААА</label>
                        <span id="small-description" class="text-gray-500">ГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААМ</span>
                    </div>
                </div> --}}
                {{-- <p class="font-bold">{{ $question['text'] }}</p> --}}
                <legend class="text-xl font-semibold leading-6 text-gray-900 my-2">{{ $question['text'] }}</legend>
                @foreach ($question['answers'] as $answer)
                    <div class="relative flex items-start">
                        <div class="flex items-center mb-4">
                            <input 
                                id="small{{ $answer['id'] }}" type="radio" 
                                name="answers[{{ $question['id'] }}]" 
                                value="{{ $answer['id'] }}"   
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 outline-none accent-purple-800 dark:bg-gray-700 dark:border-gray-600">
                            <label for="small{{ $answer['id'] }}" class="ms-2 text-md text-gray-600">{{ $answer['text'] }}</label>
                        </div>
                        {{-- <div class="flex h-6 items-center ">
                            <input 
                                id="small" 
                                aria-describedby="small-description" type="radio" 
                                name="answers[{{ $question['id'] }}]" 
                                value="{{ $answer['id'] }}"  
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                            >
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="small" class="font-medium text-gray-900"> {{ $answer['text'] }}</label>
                            <span id="small-description" class="text-gray-500">ГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААМ</span>
                        </div> --}}
                    </div>
                    {{-- <div>
                        <label>
                            <input 
                                type="radio" 
                                name="answers[{{ $question['id'] }}]" 
                                value="{{ $answer['id'] }}">
                            {{ $answer['text'] }}
                        </label>
                    </div> --}}
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить</button>
    </form>
</div>
@endsection
{{-- <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 my-5 ">
    <legend class="text-sm font-semibold leading-6 text-gray-900 mt-2">ГОООООООООООООООООООООООООООООООЙДА?</legend>
   <div class="relative flex items-start">
     <div class="flex h-6 items-center ">
       <input id="small" aria-describedby="small-description" name="plan" type="radio" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
     </div>
     <div class="ml-3 text-sm leading-6">
       <label for="small" class="font-medium text-gray-900">ГОЙДААА</label>
       <span id="small-description" class="text-gray-500">ГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААМ</span>
     </div>
   </div>
   <div class="relative flex items-start mt-2">
     <div class="flex h-6 items-center">
       <input id="medium" aria-describedby="medium-description" name="plan" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
     </div>
     <div class="ml-3 text-sm leading-6">
       <label for="medium" class="font-medium text-gray-900">ГОЙДААА</label>
       <span id="medium-description" class="text-gray-500">ГОЙДАААМГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДААА</span>
     </div>
   </div>
   <div class="relative flex items-start mt-2">
     <div class="flex h-6 items-center">
       <input id="large" aria-describedby="large-description" name="plan" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
     </div>
     <div class="ml-3 text-sm leading-6">
       <label for="large" class="font-medium text-gray-900">ГОЙДААА</label>
       <span id="large-description" class="text-gray-500">ГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДАААГОЙДААА</span>
     </div>
   </div>
 </div>
 --}}