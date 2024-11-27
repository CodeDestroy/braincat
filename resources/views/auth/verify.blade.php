
@extends('layouts.app')

@section('content')
<div class="container" style="display: block; margin-left: auto; margin-right: auto">
    <div class="flex min-h-full justify-center">
        <div class="flex flex-1 flex-col justify-center px-4 py-32 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Verify Your Email Address') }}</h2>
                </div>
                <p class="mt-8 text-sm leading-6 text-gray-500">
                 
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                   
                       
                </p>
                <p class="mt-8 text-sm leading-6 text-gray-500">
                 
                   
                    {{ __('If you did not receive the email') }}: 
                       
                </p>
                
                <div class="mt-6">
                    <div>
                        <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
                            @csrf
                            
            
                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-purple-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-800">
                                    {{ __('click here to request another') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('img/register_main.jpg') }}" alt="">
        </div>
    </div>
</div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, 
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection