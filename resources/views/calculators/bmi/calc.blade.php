@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" action="{{ route('calc.calculate') }}" class="bg-white p-8 rounded-2xl shadow-md w-96 space-y-4">
        @csrf
        <h2 class="text-xl font-semibold text-center mb-4">Калькулятор антропометрии</h2>

        <div>
            <label class="block font-medium">Дата рождения:</label>
            <input type="date" name="birth_date" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 ">
        </div>

        <div>
            <label class="block font-medium">Дата вычисления:</label>
            <input type="date" name="calc_date" value="<?php echo date('Y-m-d'); ?>" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 ">
        </div>

        <div>
            <label class="block font-medium">Пол:</label>
            <select name="sex" class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-2 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 ">
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Рост (см):</label>
            <input type="number" step="0.1" name="height" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 ">
        </div>

        <div>
            <label class="block font-medium">Вес (кг):</label>
            <input type="number" step="0.1" name="weight" required class="block w-full rounded-md border-0 outline-none accent-mona-lisa-600 py-1.5 px-4 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mona-lisa-600 sm:text-sm sm:leading-6 ">
        </div>

        <button type="submit" class="w-full bg-mona-lisa-600 hover:bg-mona-lisa-700 text-white rounded-lg py-2">
            Рассчитать
        </button>
    </form>
</div>
@endsection