@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-purple-800 mb-4">{{ $test['title'] }}</h1>
    <p class="text-gray-700 mb-6">{{ $test['description'] }}</p>

    <div class="text-center">
    <div class="mb-4">
        <span class="text-xl font-semibold">Количество попыток:</span> {{ $triesCount }}
    </div>
    <div class="mb-4">
        <span class="text-xl font-semibold">Последний результат:</span> 
        @if($lastResult)
            {{ $lastResult->score }} из ({{ $lastResult->max_score }})
        @else
            Нет результатов
        @endif
    </div>
    @if($isBlocked)
        <div class="p-4 mb-4 text-red-600 border border-red-600 rounded">
            {{$whyBlocked}}
        </div>
    @elseif($isCompleted)
            <div class="text-xl p-4 mb-4 text-green-600 border border-green-600 rounded">
                Тест успешно пройден! Ваш результат: {{ ($lastResult->score) }} из ({{ $lastResult->max_score }}).
            </div>
    @else
        <div class="mt-8 mb-4">
            <a 
                href="{{route('education.startTest', ['id' => $test['id'], 'course_id' => $course_id])}}" 
                class="text-xl w-full py-2 px-4 bg-purple-800 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-800">
                Начать тест
            </a>
        </div>   
    @endif
    </div>
</div>
@endsection
