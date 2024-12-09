@extends('layouts.app')

@section('content')
@php
use Diglactic\Breadcrumbs\Breadcrumbs;
@endphp
<div class="container mx-auto">
    <div id='docs-heading'>
        <section-headings-with-tabs/>
    </div>
    {{ Breadcrumbs::render('documents.offer') }}
   
    <div id="offer">
        <offer />
    </div>

</div>
@endsection