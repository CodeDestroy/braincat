@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div id='docs-heading'>
        <section-headings-with-tabs/>
    </div>
    {{ Breadcrumbs::render('documents.contract') }}
   
    <div id="contract">
        <contract />
    </div>

</div>
@endsection