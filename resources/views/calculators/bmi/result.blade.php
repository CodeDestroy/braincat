<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты расчёта</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-96 space-y-3">
        <h2 class="text-xl font-semibold text-center mb-4">Результаты</h2>

        <p><strong>Возраст (в мес.):</strong> {{ $ageMonths }}</p>
        <p><strong>Height age:</strong> {{ $heightAge }} лет</p>
        <p><strong>Height SDS:</strong> {{ $heightSDS }}</p>
        <p><strong>BMI:</strong> {{ $bmi }}</p>
        <p><strong>BMI SDS (for Height age):</strong> {{ $bmiSDS }}</p>

        <a href="{{ route('calc.form') }}" class="block mt-4 text-center bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2">
            Новый расчёт
        </a>
    </div>
</body>
</html>
