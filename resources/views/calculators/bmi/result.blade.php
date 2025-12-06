
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-md w-96 space-y-3">
        <h3 class="text-xl font-semibold text-center mb-4">Введённые данные:</h3>
        <p><strong>Дата рождения:</strong> {{ $birthDate }}</p>
        <p><strong>Дата расчёта:</strong> {{ $calcDate }}</p>
        <p><strong>Пол:</strong> {{ $sex === 'male' ? 'Мужской' : 'Женский' }}</p>
        <p><strong>Рост:</strong> {{ $height }} см</p>
        <p><strong>Вес:</strong> {{ $weight }} кг</p>

        <h3 class="text-xl font-semibold text-center mb-4">Результаты</h3>

        <p><strong>Возраст (в мес.):</strong> {{ $ageMonths }}</p>
        <p>
            <strong>Возраст (лет + месяцев):</strong>
            {{ $ageYears }} лет {{ $ageMonthsRemain }} мес
        </p>
        <p><strong>Height age:</strong> {{ $heightAge }} лет</p>
        <p><strong>Height SDS:</strong> {{ $heightSDS }}</p>
        <p><strong>BMI:</strong> {{ $bmi }}</p>
        <p><strong>BMI SDS (for Height age):</strong> {{ $bmiSDS }}</p>


        <a href="{{ route('calc.form') }}" class="block mt-4 text-center bg-mona-lisa-600 hover:bg-mona-lisa-700 text-white rounded-lg py-2">
            Новый расчёт
        </a>
    </div>
</div>
@endsection
