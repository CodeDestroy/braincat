@extends('layouts.app')

@section('content')
<div>
    {{-- Оплата льгота {{$freq}}% --}}
    @if ($freq == 100)
        <div class="flex justify-center items-center bg-gray-100" style="height: 80vh">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Вебинар 19.01.2025 <br>10-00 - 13-00</h2>
                <p class="text-xl font-semibold text-gray-700 text-center mb-4">д.б.н., профессор Е.И. Николаева</p>
                <p class="text-md font-semibold text-gray-700 text-center mb-4">"Что такое созревание мозга и какие условия его обеспечивают"</p>
                
                <!-- Plan and Price -->
                <div class=" p-4 rounded-lg mb-6 text-center">
                    <h3 class="text-xl font-semibold text-indigo-700">Базовый тариф</h3>
                    <p class="text-3xl font-bold text-indigo-900 mt-2">{{ (int)$sum }} ₽</p>
                    {{-- <p class="text-gray-500 mt-1">Единовременная оплата</p> --}}
                </div>
        
                <!-- Robokassa Payment Button -->
                <div class="text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=M7TYJjPo7kGPTK66LFf76g"></script>
                </div>
                
                <!-- Back Button -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-indigo-600 hover:underline">на главную</a>
                </div>
            </div>
        </div>                                            
    {{-- <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=x9tsj8v0FECSsRG6RJ0S5Q"></script>
        <div>Оплата 100%</div> --}}
    {{-- @else
        <div class="flex justify-center items-center bg-gray-100" style="height: 60vh">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Вам подходит тариф: <br>Базовый план</h2>
                
                <div class="bg-indigo-100 p-4 rounded-lg mb-6 text-center">
                    <h3 class="text-xl font-semibold text-indigo-700">Базовый план</h3>
                    <p class="text-3xl font-bold text-indigo-900 mt-2">16000 ₽</p>
                    <p class="text-gray-500 mt-1">Два платежа</p>
                </div>
        
                <!-- Robokassa Payment Button -->
                <div class="text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=dRnYOkgw4E-xs21E-cIBBA"></script>
                </div>
                <!-- Back Button -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-indigo-600 hover:underline">Назад на главную</a>
                </div>
            </div>
        </div>  --}}
    {{-- <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=RrY4xB-XREWtRar937qJIg"></script>
        <div>Оплата 50%</div> --}}
    @endif
</div>

@endsection