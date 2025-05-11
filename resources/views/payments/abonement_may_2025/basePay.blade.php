@extends('layouts.app')

@section('content')
<div>
    {{-- Оплата льгота {{$freq}}% --}}

        <div class="flex justify-center items-center bg-gray-100" style="height: 80vh">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Абонемент</h2>
                <p class="text-xl font-semibold text-gray-700 text-center mb-4">Психология: май 2025</p>
                {{-- <p class="text-md font-semibold text-gray-700 text-center mb-4">"Современные направления арт-терапии: стратегии и ресурсы"</p>
                 --}}
                <!-- Plan and Price -->
                <div class=" p-4 rounded-lg mb-6 text-center">
                    <h3 class="text-xl font-semibold text-indigo-700 line-through" style="text-decoration: line-through">10899 рублей</h3>
                    <h3 id='price' class="text-xl font-semibold text-indigo-700">{{ (int)$sum }} рублей</h3>
                    {{-- <p class="text-gray-500 mt-1">Единовременная оплата</p> --}}
                </div>
        
                <!-- Robokassa Payment Button -->
                <div id='robokassaFull' class="text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=ccfdFLriLUKGjF6aTHVO-g"></script>
                </div>
                <div id='robokassaPromo' class="hidden text-center flex justify-center">
                    <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=9vXBFEqdHUSOgxwAJiKgWw"></script>
                </div>
                {{-- <script type="text/javascript" src="https://auth.robokassa.ru/Merchant/PaymentForm/FormSS.js?EncodedInvoiceId=9vXBFEqdHUSOgxwAJiKgWw"></script> --}}

                <div class="text-center flex justify-center">
                    <h1 class="text-indigo-700 font-semibold text-xl">Промокод</h1>
                    <div id="promoMessage" class="text-red-500 mt-2"></div>
                </div>
                <div class="flex px-3">
                    
                    <input name="promo" id="promo" placeholder="Промокод" class="mr-2 block w-full rounded-md border-0 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-800 sm:text-sm sm:leading-6"/>
                    <button onclick="checkPromo()" class="bg-blue-500 hover:bg-blue-700 text-white font-normal text-md py-1 px-2 rounded" style="margin-right: 0; margin-left: auto; ">Применить</button>
                </div>

                <!-- Back Button -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-indigo-600 hover:underline">на главную</a>
                </div>
            </div>
        </div>                                            
    {{-- <script>
        
        const robokassa = document.getElementById('robokassaFull')
        function checkPromo () {
            const promo = (document.getElementById('promo').value).toLowerCase()
            console.log((promo))
            fetch(`/api/promo?promo=${encodeURIComponent(promo)}`)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== '') {
                    // Промокод верный – заменяем контейнер с оплатой
                    document.getElementById('robokassaContainer').innerHTML = data;
                    document.getElementById('promoMessage').innerText = "Промокод применён. Скидка активирована!";
                    document.getElementById('promoMessage').classList.remove('text-red-500');
                    document.getElementById('promoMessage').classList.add('text-green-600');
                } else {
                    // Промокод неверный – ничего не меняем, выводим сообщение
                    document.getElementById('promoMessage').innerText = "Неверный промокод.";
                    document.getElementById('promoMessage').classList.remove('text-green-600');
                    document.getElementById('promoMessage').classList.add('text-red-500');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                document.getElementById('promoMessage').innerText = 'Произошла ошибка.';
            });

        }

    </script> --}}
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
                        document.getElementById('price').innerHTML = '7630 рублей'
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