@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex justify-center items-start py-10 px-4">
    <form method="POST"
          action="{{ route('calc.calculate') }}"
          class="bg-white w-full max-w-3xl p-6 sm:p-8 rounded-2xl shadow-lg space-y-6">
        @csrf

        <h2 class="text-2xl font-semibold text-center text-gray-800">
            Калькулятор антропометрии
        </h2>

        {{-- Дата рождения --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Дата рождения
            </label>
            <input type="date"
                   name="birth_date"
                   required
                   class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">
        </div>

        {{-- Пол --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Пол
            </label>
            <select name="sex"
                    class="w-full rounded-lg px-4 py-2 text-sm
                           ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
        </div>

        <h3 class="text-lg font-semibold text-gray-800">
            Показания
        </h3>

        {{-- Контейнер измерений --}}
        <div id="measurementsContainer" class="space-y-3">
            <div class="measurement grid grid-cols-1 sm:grid-cols-[1.2fr_1fr_1fr_auto] gap-2 items-center">
                <input id="startDatePicker"
                       type="date"
                       name="measurements[0][date]"
                       required
                       class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">

                <input type="number"
                       step="0.1"
                       name="measurements[0][height]"
                       placeholder="Рост (см)"
                       required
                       class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">

                <input type="number"
                       step="0.1"
                       name="measurements[0][weight]"
                       placeholder="Вес (кг)"
                       required
                       class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">

                <button type="button"
                        class="removeBtn text-red-600 hover:text-red-800 font-semibold px-3 py-2 rounded-lg">
                    ✕
                </button>
            </div>
        </div>

        {{-- Кнопка добавления --}}
        <button type="button"
                id="addMeasurement"
                class="inline-flex items-center gap-2 text-sm font-medium
                       text-blue-600 hover:text-blue-800">
            + Добавить показание
        </button>

        {{-- Сабмит --}}
        <button type="submit"
                class="w-full mt-4 bg-mona-lisa-600 hover:bg-mona-lisa-700
                       text-white font-medium py-2.5 rounded-xl transition">
            Рассчитать
        </button>
    </form>
</div>

{{-- Стили для инпутов --}}


<script>
const startDatePicker = document.getElementById('startDatePicker');
startDatePicker.valueAsDate = new Date();

let counter = 1;

document.getElementById('addMeasurement').addEventListener('click', function () {
    const container = document.getElementById('measurementsContainer');
    const div = document.createElement('div');

    div.className =
        'measurement grid grid-cols-1 sm:grid-cols-[1.2fr_1fr_1fr_auto] gap-2 items-center';

    div.innerHTML = `
        <input type="date" name="measurements[${counter}][date]" required class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">
        <input type="number" step="0.1" name="measurements[${counter}][height]" placeholder="Рост (см)" required class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">
        <input type="number" step="0.1" name="measurements[${counter}][weight]" placeholder="Вес (кг)" required class="w-full rounded-lg px-4 py-2 text-sm
                          ring-1 ring-gray-300 focus:ring-2 focus:ring-mona-lisa-500 outline-none">
        <button type="button" class="removeBtn text-red-600 hover:text-red-800 font-semibold px-3 py-2 rounded-lg">
            ✕
        </button>
    `;

    container.appendChild(div);
    counter++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('removeBtn')){
        const measurements = document.querySelectorAll('.measurement');
        if(measurements.length > 1){
            e.target.closest('.measurement').remove();
        }
    }
});
</script>
@endsection
