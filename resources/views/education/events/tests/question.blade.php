@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-6 lg:px-8">
    <form action="submitTest" method="POST">
        @csrf
        @foreach ($questions as $question)
            <div class="mb-6">
                <p class="font-bold">{{ $question['text'] }}</p>
                @foreach ($question['answers'] as $answer)
                    <div>
                        <label>
                            <input 
                                type="radio" 
                                name="answers[{{ $question['id'] }}]" 
                                value="{{ $answer['id'] }}">
                            {{ $answer['text'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить</button>
    </form>
</div>
@endsection
