@extends('layouts.app')

@section('content')
@php
use Diglactic\Breadcrumbs\Breadcrumbs;
@endphp
<div class="container mx-auto">
    <div id='docs-heading'>
        <section-headings-with-tabs/>
    </div>
    {{ Breadcrumbs::render('documents.policy') }}
   
    <div id="policy">
        <policy />
    </div>

</div>
@endsection