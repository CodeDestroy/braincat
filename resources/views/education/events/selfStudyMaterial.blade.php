@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-6 lg:px-8">
    <img src="{{$selfStudyMaterial['image']}}"/>
    {{$selfStudyMaterial['image']}}
    {{$selfStudyMaterial['name']}}
    <br>
    {{$selfStudyMaterial['description']}}
    <br>
    {!! $selfStudyMaterial['text'] !!}
</div>
@endsection