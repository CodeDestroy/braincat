<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
// ... (namespace и use остаются как у тебя)

class AnthropometryController extends Controller
{
    // ... index() и другие методы остаются
    public function index()
    {
        return view('calculators.bmi.calc');
    }
    public function calculate(Request $request)
    {
        $request->validate([
            'birth_date' => 'required|date',
            'calc_date'  => 'required|date|after:birth_date',
            'sex'        => 'required|in:male,female',
            'height'     => 'required|numeric|min:30|max:250',
            'weight'     => 'required|numeric|min:1|max:300',
        ]);

        $ageMonths = $this->getAgeInMonths($request->birth_date, $request->calc_date);
        $ageYears = floor($ageMonths / 12);
        $ageMonthsRemain = round($ageMonths - $ageYears * 12);
        $birthDateFormatted = date('d.m.Y', strtotime($request->birth_date));
        $calcDateFormatted  = date('d.m.Y', strtotime($request->calc_date));


        $sexCode = $request->sex === 'male' ? 1 : 2;

        $hfaFile = storage_path('app/public/anthropometry_data/height_for_age_2-20.csv');
        $bmiFile = storage_path('app/public/anthropometry_data/bmi_for-age_2-20.csv');

        // Загружаем CSV — теперь loadWhoCsv делает нормализацию заголовков
        $hfaRows = collect($this->loadWhoCsv($hfaFile));
        $bmiRows = collect($this->loadWhoCsv($bmiFile));

        // Проверка: после загрузки должны быть колонки Sex и Agemos и L/M/S
        if ($hfaRows->isEmpty() || $bmiRows->isEmpty()) {
            return back()->withErrors(['csv' => 'Не удалось загрузить CSV — файл пустой или неправильный формат.']);
        }

        // Проверяем наличие ожидаемых ключей в первой строке (без ошибки PHP)
        $required = ['Sex','Agemos','L','M','S'];
        $firstHfaKeys = array_keys($hfaRows->first());
        foreach ($required as $k) {
            if (!in_array($k, $firstHfaKeys, true)) {
                return back()->withErrors(['csv' => "В CSV для роста отсутствует колонка «{$k}». Проверьте заголовок файла."]);
            }
        }
        $firstBmiKeys = array_keys($bmiRows->first());
        foreach ($required as $k) {
            if (!in_array($k, $firstBmiKeys, true)) {
                return back()->withErrors(['csv' => "В CSV для BMI отсутствует колонка «{$k}». Проверьте заголовок файла."]);
            }
        }

        // Фильтруем по полу (Sex) — теперь безопасно, т.к. ключ гарантирован
        $hfa = $hfaRows->where('Sex', (string)$sexCode)->values();
        $bmiData = $bmiRows->where('Sex', (string)$sexCode)->values();

        if ($hfa->isEmpty() || $bmiData->isEmpty()) {
            return back()->withErrors(['csv' => 'Нет строк для выбранного пола (Sex) в CSV. Проверьте значения в колонке Sex.']);
        }

        // Находим ближайшую строку по возрасту
        $hfaRow = $hfa->sortBy(fn($r) => abs((float)$r['Agemos'] - $ageMonths))->first();
        $bmiRow = $bmiData->sortBy(fn($r) => abs((float)$r['Agemos'] - $ageMonths))->first();

        // Извлекаем LMS
        $Lh = (float)$hfaRow['L'];
        $Mh = (float)$hfaRow['M'];
        $Sh = (float)$hfaRow['S'];

        $Lb = (float)$bmiRow['L'];
        $Mb = (float)$bmiRow['M'];
        $Sb = (float)$bmiRow['S'];

        $height = (float)$request->height;
        $weight = (float)$request->weight;

        $heightSDS = $this->calcSds($height, $Lh, $Mh, $Sh);

        $bmi = $weight / pow($height / 100, 2);
        $bmiSDS = $this->calcSds($bmi, $Lb, $Mb, $Sb);

        // Height age: находим возраст, где M(height) ближе всего к росту
        $closestHeight = $hfa->sortBy(fn($r) => abs((float)$r['M'] - $height))->first();
        $heightAgeMonths = (float)$closestHeight['Agemos'];
        $heightAgeYears = $heightAgeMonths / 12;

        // BMI SDS for Height age — находим LMS из BMI таблицы для этого heightAgeMonths
        $bmiForHeightAgeRow = $bmiData->sortBy(fn($r) => abs((float)$r['Agemos'] - $heightAgeMonths))->first();
        $Lb2 = (float)$bmiForHeightAgeRow['L'];
        $Mb2 = (float)$bmiForHeightAgeRow['M'];
        $Sb2 = (float)$bmiForHeightAgeRow['S'];
        $bmiSDS_forHeightAge = $this->calcSds($bmi, $Lb2, $Mb2, $Sb2);

        
        return view('calculators.bmi.result', [
            'ageMonths'           => round($ageMonths, 1),
            'ageYears'            => $ageYears,
            'ageMonthsRemain'     => $ageMonthsRemain,

            'birthDate'           => $birthDateFormatted,
            'calcDate'            => $calcDateFormatted,
            'sex'                 => $request->sex,
            'height'              => $request->height,
            'weight'              => $request->weight,

            'heightAge'           => round($heightAgeYears, 2),
            'heightSDS'           => round($heightSDS, 2),
            'bmi'                 => round($bmi, 2),
            'bmiSDS'              => round($bmiSDS, 2),
            'bmiSDS_forHeightAge' => round($bmiSDS_forHeightAge, 2),
        ]);

        /* return view('calculators.bmi.result', [
            'ageMonths'           => round($ageMonths, 1),
            'heightAge'           => round($heightAgeYears, 2),
            'heightSDS'           => round($heightSDS, 2),
            'bmi'                 => round($bmi, 2),
            'bmiSDS'              => round($bmiSDS, 2),
            'bmiSDS_forHeightAge' => round($bmiSDS_forHeightAge, 2),
        ]); */
    }

    // Оставляем calcSds и getAgeInMonths как в предыдущей версии
    private function calcSds(float $x, float $L, float $M, float $S): float
    {
        if ($L == 0.0) {
            return log($x / $M) / $S;
        }
        return (pow($x / $M, $L) - 1) / ($L * $S);
    }

    private function getAgeInMonths($birthDate, $calcDate): float
    {
        $d1 = new DateTime($birthDate);
        $d2 = new DateTime($calcDate);
        $interval = $d1->diff($d2);
        return $interval->y * 12 + $interval->m + $interval->d / 30.4375;
    }

    /**
     * Надёжный загрузчик CSV:
     * - Автоопределяет разделитель (\t, ; или ,)
     * - Удаляет BOM, пробелы и непечатные символы из заголовков
     * - Нормализует имена заголовков (пример: " sex " -> "Sex")
     */
    private function loadWhoCsv(string $path): array
    {
        $data = [];
        if (!file_exists($path)) {
            return $data;
        }

        $handle = fopen($path, 'r');
        if ($handle === false) return $data;

        // Прочитаем первую строку отдельно для детекции разделителя
        $firstLine = fgets($handle);
        if ($firstLine === false) {
            fclose($handle);
            return $data;
        }

        // Определяем разделитель: таб, ; или ,
        $delim = "\t";
        if (substr_count($firstLine, ";") > substr_count($firstLine, "\t")) {
            $delim = ";";
        } elseif (substr_count($firstLine, ",") > substr_count($firstLine, "\t")) {
            $delim = ",";
        }

        // Вернёмся в начало файла и используем fgetcsv с найденным разделителем
        rewind($handle);

        $header = null;
        while (($row = fgetcsv($handle, 0, $delim)) !== false) {
            // Некоторые строки могут быть пустыми — пропускаем
            if ($row === [null] || count($row) === 0) continue;

            // Преобразуем значения (замена запятой на точку для чисел)
            $row = array_map(function ($val) {
                if ($val === null) return $val;
                $val = trim($val);
                // Удаляем BOM если есть
                $val = preg_replace('/^\xEF\xBB\xBF/', '', $val);
                // Удаляем множественные пробелы внутри
                $val = preg_replace('/\s+/', ' ', $val);
                // Заменяем запятую на точку (для чисел с запятой)
                $val = str_replace(',', '.', $val);
                return $val;
            }, $row);

            if (!$header) {
                // Нормализуем имена заголовков: удаляем непечатные символы и пробелы, делаем ucfirst
                $header = array_map(function ($h) {
                    $h = trim((string)$h);
                    $h = preg_replace('/^\xEF\xBB\xBF/', '', $h); // BOM
                    // Удаляем непечатные символы
                    $h = preg_replace('/[^\PC\s]/u', '', $h);
                    // Удаляем лишние пробелы и символы кроме букв/цифр/_
                    $h = preg_replace('/[^\p{L}\p{N}_]+/u', '', $h);
                    $h = ucfirst(strtolower($h));
                    return $h;
                }, $row);
                continue;
            }

            // Если строка короче заголовка — дополним пустыми
            if (count($row) < count($header)) {
                $row = array_pad($row, count($header), null);
            }

            // Сопоставляем
            $assoc = array_combine($header, $row);
            if ($assoc !== false) {
                $data[] = $assoc;
            }
        }

        fclose($handle);
        return $data;
    }
}
