@extends('layouts.app')

@section('content')
@php
use Diglactic\Breadcrumbs\Breadcrumbs;
@endphp
<div class="container mx-auto">
    <div id='docs-heading'>
        <section-headings-with-tabs/>
    </div>
    {{ Breadcrumbs::render('documents.privacy') }}
   
    <div id="privacy">
        <privacy />
    </div>

</div>
@endsection