@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex justify-center items-start py-10">
    <form method="POST" action="{{ route('calc.calculate') }}" class="bg-white p-8 rounded-2xl shadow-md w-full max-w-2xl space-y-4">
        @csrf
        <h2 class="text-xl font-semibold text-center mb-4">Калькулятор антропометрии</h2>

        <div>
            <label class="block font-medium">Дата рождения:</label>
            <input type="date" name="birth_date" required class="block w-full rounded-md border-0 outline-none py-1.5 px-4 shadow-sm ring-1 ring-gray-300">
        </div>

        <div>
            <label class="block font-medium">Пол:</label>
            <select name="sex" class="block w-full rounded-md border-0 outline-none py-2 px-4 shadow-sm ring-1 ring-gray-300">
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
        </div>

        <h3 class="text-lg font-semibold mt-4">Показания:</h3>
        <div id="measurementsContainer" class="space-y-2">
            <div class="measurement flex space-x-2">
                <input id='startDatePicker' type="date" name="measurements[0][date]" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
                <input type="number" step="0.1" name="measurements[0][height]" placeholder="Рост (см)" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
                <input type="number" step="0.1" name="measurements[0][weight]" placeholder="Вес (кг)" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
                <button type="button" class="removeBtn text-red-900 px-2 rounded">X</button>
            </div>
        </div>

        <button type="button" id="addMeasurement" class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Добавить показание</button>

        <button type="submit" class="mt-4 w-full bg-mona-lisa-600 hover:bg-mona-lisa-700 text-white rounded-lg py-2">
            Рассчитать
        </button>
    </form>
</div>

<script>
const startDatePicker = document.getElementById('startDatePicker')
startDatePicker.valueAsDate = new Date()
let counter = 1;
document.getElementById('addMeasurement').addEventListener('click', function () {
    const container = document.getElementById('measurementsContainer');
    const div = document.createElement('div');
    div.classList.add('measurement', 'flex', 'space-x-2');
    div.innerHTML = `
        <input type="date" name="measurements[${counter}][date]" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
        <input type="number" step="0.1" name="measurements[${counter}][height]" placeholder="Рост (см)" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
        <input type="number" step="0.1" name="measurements[${counter}][weight]" placeholder="Вес (кг)" required class="rounded-md border-0 py-1 px-2 shadow-sm ring-1 ring-gray-300">
        <button type="button" class="removeBtn text-red-900 px-2 rounded">X</button>
    `;
    container.appendChild(div);
    counter++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('removeBtn')){
        const measurements = document.querySelectorAll('.measurement');
        if(measurements.length > 1){
            e.target.parentNode.remove();
        }
    }
});
</script>
@endsection
