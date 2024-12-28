@extends('layouts.app')

@section('content')
<div>
    {{-- Оплата льгота {{$freq}}% --}}
    @if ($freq == 100)
        <div class="flex justify-center items-center bg-gray-100" style="height: 60vh">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Вам подходит тариф: <br>Студенческий</h2>
                
                <!-- Plan and Price -->
                <div class="bg-indigo-100 p-4 rounded-lg mb-6 text-center">
                    <h3 class="text-xl font-semibold text-indigo-700">Студенческий</h3>
                    <p class="text-3xl font-bold text-indigo-900 mt-2">{{ (int)$sum }} ₽</p>
                    <p class="text-gray-500 mt-1">Единовременная оплата</p>
                </div>
        
                <!-- Robokassa Payment Button -->
                <div class="text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=BdZVjYbcQkqeTEJ4WHJzjw"></script>
                </div>
                
                <!-- Back Button -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-indigo-600 hover:underline">Назад на главную</a>
                </div>
            </div>
        </div>  
    @endif                                          
    {{-- <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=x9tsj8v0FECSsRG6RJ0S5Q"></script>
        <div>Оплата 100%</div> --}}
    
</div>

@endsection