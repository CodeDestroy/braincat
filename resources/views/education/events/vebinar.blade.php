@extends('layouts.app')

@section('content')
@php

    // TODO: переделать на orchid роли
    $user = Auth::user();

    if ($user->hasAccess('vebinarModer')){ $user->isModer = true;}

@endphp
<div class="mx-auto max-w-7xl px-6 lg:px-8" style="height: 60vh">
    {{-- {{$vebinar}} --}}
    {{-- {{print_r($roles)}}
    {{$isModer ? 'true' : 'false'}} --}}
    <div id="jitsi">
        <jitsi 
            :user="{{ json_encode($user) }}" 
            :room="{{ json_encode($vebinar) }}" 
        />
    </div>
</div>
@endsection