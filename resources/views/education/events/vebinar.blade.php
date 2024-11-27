@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    /* $isModer = false; */
    $roles = $user->roles()->get();
    $roles = $roles->pluck('slug')->toArray();
    if (in_array('manager', $roles)) {
        /* print_r('moder = true'); */
        /* $isModer = true; */
        $user->isModer = true;
    }
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