
@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-7xl px-6 lg:px-8">
    {{-- <div id="plan">
        <plan/>
    </div>
    <div id="calendar">
        <calendar/>
    </div> --}}
    <div id="ask-question">
        <ask-question :course="{{ json_encode($course) }}" />
    </div>
    <div id="calendar-plan">
        <calendar-plan :course="{{ json_encode($course) }}"/>
    </div>
</div>
@endsection