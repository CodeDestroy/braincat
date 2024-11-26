@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-6 lg:px-8">
    {{$test}}
    <br>
    <a href="{{route('education.startTest', ['id' => $test['id'], 'course_id' => $course_id])}}">Перейти к тесту</a>
</div>
@endsection