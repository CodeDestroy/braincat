@extends('layouts.app')

@section('content')
<div>
    {{-- Оплата льгота {{$freq}}% --}}
    @if ($freq == 100)
        <div class="flex justify-center items-center bg-gray-100" style="height: 80vh">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Видеозапись вебинара  <br> 26.05.2025 19-00 - 21-15</h2>
                <p class="text-xl font-semibold text-gray-700 text-center mb-4">педагог, психолог Марина Евгеньевна Лисавенко</p>
                <p class="text-md font-semibold text-gray-700 text-center mb-4">"Три чемодана или путешествие длиною в жизнь: авторская диагностико-ресурсная техника"</p>
                
                <!-- Plan and Price -->
                <div class="p-4 rounded-lg mb-6 text-center">
                    <h3 class="text-xl font-semibold text-indigo-700">Студенческий тариф</h3>
                    <p id='price' class="text-3xl font-bold text-indigo-900 mt-2">800 ₽</p>
                    {{-- <p class="text-gray-500 mt-1">Единовременная оплата</p> --}}
                </div>
        
                <!-- Robokassa Payment Button -->
                <div id='robokassaFull' class="text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=ID-RefRNqEm_o2Zf8sDMIw"></script>
                </div>
                {{-- <div id='robokassaPromo' class="hidden text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=EYEfU4GKGECXBcHAj2cVVw"></script>
                </div>

                <div class="text-center justify-center">
                    <h1 class="text-mona-lisa-600 font-semibold text-xl">Промокод</h1>
                    <p id="promoMessage" class="text-red-500 mt-2"></p>
                </div>
                <div class="flex px-3 py-2">
                    
                    <input name="promo" id="promo" placeholder="Промокод" class="mr-2 block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6"/>
                    <button onclick="checkPromo()" class="bg-salt-700 hover:bg-salt-900 text-white font-normal text-md py-1 px-2 ms-auto me-0 rounded">Применить</button>
                </div> --}}
                
                <!-- Back Button -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-indigo-600 hover:underline">на главную</a>
                </div>
            </div>
        </div>  
    @endif                                          
    <script>
        function checkPromo() {
            const promo = document.getElementById('promo').value.trim().toLowerCase();
        
            if (!promo) {
                document.getElementById('promoMessage').innerText = "Введите промокод.";
                document.getElementById('promoMessage').className = 'text-red-500 mt-2';
                return;
            }
        
            fetch(`/api/promo?promo=${encodeURIComponent(promo)}`)
                .then(response => response.json())
                .then(data => {
                    const promoMsg = document.getElementById('promoMessage');
                    const fullBlock = document.getElementById('robokassaFull');
                    const promoBlock = document.getElementById('robokassaPromo');
        
                    if (data.success) {
                        fullBlock.classList.add('hidden');
                        promoBlock.classList.remove('hidden');
        
                        promoMsg.innerText = "Промокод применён. Скидка активирована!";
                        promoMsg.className = 'text-green-600 mt-2';
                        document.getElementById('price').innerHTML = '900 рублей'
                    } else {
                        promoMsg.innerText = "Неверный промокод.";
                        promoMsg.className = 'text-red-500 mt-2';
        
                        // При ошибке можно оставить текущую форму или явно переключить обратно:
                        promoBlock.classList.add('hidden');
                        fullBlock.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    const promoMsg = document.getElementById('promoMessage');
                    promoMsg.innerText = 'Произошла ошибка при проверке промокода.';
                    promoMsg.className = 'text-red-500 mt-2';
                });
        }
    </script>
    
</div>

@endsection