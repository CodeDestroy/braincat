@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-purple-800 mb-4">Результаты теста</h1>

    <div class="text-center">
        <div class="mb-4">
            <span class="text-xl font-semibold">Ваш результат:</span> 
            {{ $testResult->score }} из {{ $testResult->max_score }}
        </div>

        @if($passed)
            <div class="text-xl p-4 mb-4 text-green-600 border border-green-600 rounded">
                Тест успешно пройден!
            </div>
        @else
            <div class="p-4 mb-4 text-red-600 border border-red-600 rounded">
                Тест не пройден. 
                <div class="mt-2">
                    <a 
                        href="{{route('education.showTest', ['id' => $testResult->test_id, 'course_id' => $course_id])}}" 
                        class="text-xl w-full py-2 px-4 bg-purple-800 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-800">
                        Вернуться к тесту
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
