@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl pt-16 lg:flex lg:gap-x-16 lg:px-8">
  <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
    <nav class="flex-none px-4 sm:px-6 lg:px-0">
      <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
        <li>
          <a href="{{ route('anthro.index') }}" class="bg-gray-50 text-indigo-600 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold">
            <svg class="h-6 w-6 shrink-0 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Anthropometry
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
    <div class="mx-auto max-w-2xl space-y-8">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Anthropometry calculator</h2>

      <form method="POST" action="{{ route('anthro.calculate') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Дата вычисления</label>
            <input type="date" name="calc_date" value="{{ old('calc_date', \Carbon\Carbon::now()->toDateString()) }}" class="mt-1 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Дата рождения</label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="mt-1 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Пол</label>
            <select name="sex" class="mt-1 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300">
              <option value="male" {{ old('sex')=='male' ? 'selected':'' }}>Мальчик</option>
              <option value="female" {{ old('sex')=='female' ? 'selected':'' }}>Девочка</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Рост (см)</label>
            <input type="number" step="any" name="height_cm" value="{{ old('height_cm') }}" class="mt-1 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Вес (кг)</label>
            <input type="number" step="any" name="weight_kg" value="{{ old('weight_kg') }}" class="mt-1 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300">
          </div>
        </div>

        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Рассчитать</button>
      </form>

      @isset($heightSDS)
      <div class="mt-6 border-t border-gray-200 pt-6">
        <h3 class="text-base font-semibold text-gray-900">Результаты</h3>
        <dl class="mt-4 text-sm text-gray-700">
          <div class="flex justify-between py-2">
            <dt>Height age (месяцы)</dt><dd>{{ number_format($heightAgeMonths, 2) }} мес ({{ number_format($heightAgeYears,2) }} г.)</dd>
          </div>
          <div class="flex justify-between py-2">
            <dt>Height SDS</dt><dd>{{ number_format($heightSDS, 3) }}</dd>
          </div>
          <div class="flex justify-between py-2">
            <dt>BMI</dt><dd>{{ number_format($bmi, 2) }}</dd>
          </div>
          <div class="flex justify-between py-2">
            <dt>BMI SDS (for Height age)</dt><dd>{{ number_format($bmiSDS_forHeightAge, 3) }}</dd>
          </div>
        </dl>
      </div>
      @endisset

    </div>
  </main>
</div>
@endsection
