<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Anthropometry Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" action="{{ route('calc.calculate') }}" class="bg-white p-8 rounded-2xl shadow-md w-96 space-y-4">
        @csrf
        <h2 class="text-xl font-semibold text-center mb-4">Anthropometry Calculator</h2>

        <div>
            <label class="block font-medium">Дата рождения:</label>
            <input type="date" name="birth_date" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">Дата вычисления:</label>
            <input type="date" name="calc_date" value="<?php echo date('Y-m-d'); ?>" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">Пол:</label>
            <select name="sex" class="w-full border rounded p-2">
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Рост (см):</label>
            <input type="number" step="0.1" name="height" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">Вес (кг):</label>
            <input type="number" step="0.1" name="weight" required class="w-full border rounded p-2">
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2">
            Рассчитать
        </button>
    </form>
</body>
</html>
