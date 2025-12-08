<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class AnthropometryController extends Controller
{
    public function index()
    {
        return view('calculators.bmi.calc');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'birth_date' => 'required|date',
            'sex' => 'required|in:male,female',
            'measurements' => 'required|array|min:1',
            'measurements.*.date' => 'required|date|after_or_equal:birth_date',
            'measurements.*.height' => 'required|numeric|min:30|max:250',
            'measurements.*.weight' => 'required|numeric|min:1|max:300',
        ]);

        $measurements = collect($request->measurements)->sortBy(fn($m) => $m['date'])->values();

        $birthDateFormatted = date('d.m.Y', strtotime($request->birth_date));
        $sexCode = $request->sex === 'male' ? 1 : 2;

        $velocities = [];
        for ($i = 1; $i < $measurements->count(); $i++) {
            $prev = $measurements[$i-1];
            $curr = $measurements[$i];
            $monthsDiff = $this->getAgeInMonths($prev['date'], $curr['date']);
            if ($monthsDiff > 0) {
                $velocities[] = [
                    'date' => $curr['date'],
                    'heightVel' => round(($curr['height'] - $prev['height']) / $monthsDiff, 2),
                    'weightVel' => round(($curr['weight'] - $prev['weight']) / $monthsDiff, 2),
                ];
            }
        }

        $last = $measurements->last();
        $calcDateFormatted = date('d.m.Y', strtotime($last['date']));
        $height = (float)$last['height'];
        $weight = (float)$last['weight'];

        $ageMonths = $this->getAgeInMonths($request->birth_date, $last['date']);
        $ageYears = floor($ageMonths / 12);
        $ageMonthsRemain = round($ageMonths - $ageYears * 12);

        // Дети до 61 месяца — WHO 0–5 лет
        if ($ageMonths < 61) {
            $lfaFile = $this->whoFile('LFA', $request->sex, $ageMonths);
            $wflFile = $this->whoFile('WFL', $request->sex, $ageMonths);

            $lfaRows = collect($this->loadWhoCsv($lfaFile));
            $wflRows = collect($this->loadWhoCsv($wflFile));

            $lfaRow = $lfaRows->sortBy(fn($r) => abs((float)$r['Agemos'] - $ageMonths))->first();
            $L_lfa = (float)$lfaRow['L'];
            $M_lfa = (float)$lfaRow['M'];
            $S_lfa = (float)$lfaRow['S'];
            $lfaSDS = $this->calcSds($height, $L_lfa, $M_lfa, $S_lfa);
            $percLFA = $this->zToPercentile($lfaSDS);

            $closestWfl = $wflRows->sortBy(fn($r) => abs((float)$r['Height'] - $height))->first();
            $L_wfl = (float)$closestWfl['L'];
            $M_wfl = (float)$closestWfl['M'];
            $S_wfl = (float)$closestWfl['S'];
            $wflSDS = $this->calcSds($weight, $L_wfl, $M_wfl, $S_wfl);
            $percWFL = $this->zToPercentile($wflSDS);

            $stunting = $lfaSDS < -2 ? 'Задержка роста' : 'Нет';
            /* $wasting = $bmiSDS < -2 ? 'Атрофия' : 'Нет'; */
            $underweight = ($wflSDS < -2 && $lfaSDS < -2) ? 'Недовес' : 'Нет';
            $overweightRisk = $wflSDS > 1 ? 'Повышен' : 'Нет';
            $harmony = abs($wflSDS - $lfaSDS) <= 1 ? 'Гармоничный' : 'Дисгармоничный';

            return view('calculators.bmi.result', [
                'birthDate' => $birthDateFormatted,
                'calcDate' => $calcDateFormatted,
                'sex' => $request->sex,
                'height' => $height,
                'weight' => $weight,
                'ageMonths' => round($ageMonths, 1),
                'ageYears' => $ageYears,
                'ageMonthsRemain' => $ageMonthsRemain,
                'lfaSDS' => round($lfaSDS, 2),
                'wflSDS' => round($wflSDS, 2),
                'percLFA' => $percLFA,
                'percWFL' => $percWFL,
                'stunting' => $stunting,
                /* 'wasting' => $wasting, */
                'underweight' => $underweight,
                'overweightRisk' => $overweightRisk,
                'harmony' => $harmony,
                'heightVelocity' => end($velocities)['heightVel'] ?? 'N/A',
                'weightVelocity' => end($velocities)['weightVel'] ?? 'N/A',
                'history' => $velocities,
                'method' => 'WHO 0–5 лет',
                'measurements' => $measurements,
                'hfaRows' => $lfaRows,
                'wflRows' => $wflRows,
            ]);
        }

        // Дети старше 5 лет
        $hfaFile = storage_path('app/public/anthropometry_data/height_for_age_2-20.csv');
        $bmiFile = storage_path('app/public/anthropometry_data/bmi_for-age_2-20.csv');
        $wfaFile = storage_path('app/public/anthropometry_data/weight_for_age_2-20.csv');

        $hfaRows = collect($this->loadWhoCsv($hfaFile))->where('Sex', (string)$sexCode)->values();
        $bmiRows = collect($this->loadWhoCsv($bmiFile))->where('Sex', (string)$sexCode)->values();
        $wfaRows = collect($this->loadWhoCsv($wfaFile))->where('Sex', (string)$sexCode)->values();

        $hfaRow = $hfaRows->sortBy(fn($r) => abs((float)$r['Agemos'] - $ageMonths))->first();
        $heightSDS = $this->calcSds($height, (float)$hfaRow['L'], (float)$hfaRow['M'], (float)$hfaRow['S']);

        $bmi = $weight / pow($height / 100, 2);
        $bmiRow = $bmiRows->sortBy(fn($r) => abs((float)$r['Agemos'] - $ageMonths))->first();
        $bmiSDS = $this->calcSds($bmi, (float)$bmiRow['L'], (float)$bmiRow['M'], (float)$bmiRow['S']);

        $heightAgeMonths = null;
        $bmiSDS_forHeightAge = null;
        $closestHeight = $hfaRows->sortBy(fn($r) => abs((float)$r['M'] - $height))->first();
        if ($closestHeight) {
            $heightAgeMonths = (float)$closestHeight['Agemos'];

            $bmiForHeightAgeRow = $bmiRows->sortBy(fn($r) => abs((float)$r['Agemos'] - $heightAgeMonths))->first();
            if ($bmiForHeightAgeRow) {
                $bmiSDS_forHeightAge = $this->calcSds($bmi, (float)$bmiForHeightAgeRow['L'], (float)$bmiForHeightAgeRow['M'], (float)$bmiForHeightAgeRow['S']);
            }
        }
        $heightAge = $heightAgeMonths ? round($heightAgeMonths / 12, 2) : null;

        // WFL для графика строим через weight-for-age
        $wflRows = $wfaRows->sortBy('Agemos')->values();

        // Дополнительные показатели как у младших 0–5 лет
        $stunting = $heightSDS < -2 ? 'Да' : 'Нет';
        //$wasting = $bmiSDS < -2 ? 'Атрофия' : 'Нет';
        $underweight = $bmiSDS < -2 ? 'Недовес' : 'Нет';
        $overweightRisk = $bmiSDS > 1 ? 'Повышен' : 'Нет';
        $harmony = abs($bmiSDS - $heightSDS) <= 1 ? 'Гармоничный' : 'Дисгармоничный';
        $percHFA = $this->zToPercentile($heightSDS);
        $percBMI = $this->zToPercentile($bmiSDS);


        return view('calculators.bmi.result', [
            'birthDate' => $birthDateFormatted,
            'calcDate' => $calcDateFormatted,
            'sex' => $request->sex,
            'height' => $height,
            'weight' => $weight,
            'ageMonths' => round($ageMonths, 1),
            'ageYears' => $ageYears,
            'ageMonthsRemain' => $ageMonthsRemain,
            'heightSDS' => round($heightSDS, 2),
            'bmi' => round($bmi, 2),
            'bmiSDS' => round($bmiSDS, 2),
            'bmiSDS_forHeightAge' => $bmiSDS_forHeightAge ? round($bmiSDS_forHeightAge, 2) : null,
            'heightVelocity' => end($velocities)['heightVel'] ?? 'N/A',
            'weightVelocity' => end($velocities)['weightVel'] ?? 'N/A',
            'history' => $velocities,
            'heightAge' => $heightAge,
            'measurements' => $measurements,
            'hfaRows' => $hfaRows,
            'wflRows' => $wflRows,
            'stunting' => $stunting,
            /* 'wasting' => $wasting, */
            'underweight' => $underweight,
            'overweightRisk' => $overweightRisk,
            'harmony' => $harmony,
            'percHFA' => $percHFA,
            'percBMI' => $percBMI,
            'bmiRows' => $bmiRows

        ]);
    }


    private function calcSds(float $x, float $L, float $M, float $S): float
    {
        if ($L == 0.0) return log($x / $M) / $S;
        return (pow($x / $M, $L) - 1) / ($L * $S);
    }

    private function getAgeInMonths($birthDate, $calcDate): float
    {
        $d1 = new DateTime($birthDate);
        $d2 = new DateTime($calcDate);
        $interval = $d1->diff($d2);
        return $interval->y * 12 + $interval->m + $interval->d / 30.4375;
    }

    private function zToPercentile(float $z): float
    {
        $cdf = 0.5 * (1 + $this->erf($z / sqrt(2)));
        return round(max(0, min(1, $cdf)) * 100, 1);
    }

    private function erf(float $x): float
    {
        $sign = $x >= 0 ? 1 : -1;
        $x = abs($x);
        $a1 = 0.254829592; $a2 = -0.284496736; $a3 = 1.421413741;
        $a4 = -1.453152027; $a5 = 1.061405429; $p = 0.3275911;
        $t = 1.0 / (1.0 + $p * $x);
        $y = 1.0 - (((((($a5*$t+$a4)*$t+$a3)*$t+$a2)*$t+$a1)*$t) * exp(-$x*$x));
        return $sign * $y;
    }

    private function loadWhoCsv(string $path): array
    {
        $data = [];
        if (!file_exists($path)) return $data;
        $handle = fopen($path, 'r');
        if (!$handle) return $data;
        $firstLine = fgets($handle);
        if ($firstLine === false) { fclose($handle); return $data; }
        $delim = substr_count($firstLine, ";") > substr_count($firstLine, "\t") ? ";" : (substr_count($firstLine, ",") > substr_count($firstLine, "\t") ? "," : "\t");
        rewind($handle);
        $header = null;
        while (($row = fgetcsv($handle, 0, $delim)) !== false) {
            if ($row === [null] || count($row) === 0) continue;
            $row = array_map(fn($v) => str_replace(',', '.', trim($v)), $row);
            if (!$header) { 
                $header = array_map(fn($h) => ucfirst(strtolower(trim($h))), $row);
                continue;
            }
            if (count($row) < count($header)) $row = array_pad($row, count($header), null);
            $assoc = array_combine($header, $row);
            if ($assoc !== false) $data[] = $assoc;
        }
        fclose($handle);
        return $data;
    }

    private function whoFile(string $type, string $sex, float $ageMonths): string
    {
        $sexKey = $sex === 'male' ? 'boys' : 'girls';
        if ($ageMonths <= 60) return match($type){
                'LFA' => storage_path("app/public/anthropometry_data/tab_lhfa_{$sexKey}_p_0_5_new.csv"),
                'WFL' => storage_path("app/public/anthropometry_data/tab_wfl_{$sexKey}_p_0_5_new.csv"),
                default => '',
            };
        return '';
        /* if ($ageMonths < 24) return match($type){
            'LFA' => storage_path("app/public/anthropometry_data/tab_lhfa_{$sexKey}_p_0_2.csv"),
            'WFL' => storage_path("app/public/anthropometry_data/tab_wfl_{$sexKey}_p_0_2.csv"),
            default => '',
        };
        if ($ageMonths >=24 && $ageMonths <60) return match($type){
            'LFA' => storage_path("app/public/anthropometry_data/tab_lhfa_{$sexKey}_p_2_5.csv"),
            'WFL' => storage_path("app/public/anthropometry_data/tab_wfh_{$sexKey}_p_2_5.csv"),
            default => '',
        };
        return ''; */
    }
    
    
}
