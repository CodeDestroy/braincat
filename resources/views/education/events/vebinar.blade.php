@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
@endphp
<div class="mx-auto max-w-7xl px-6 lg:px-8">
    {{$vebinar}}
    <div id="jitsi">
        <jitsi :user="{{ json_encode($user) }}" :room="{{ json_encode($vebinar) }}"/>
    </div>
</div>
@endsection