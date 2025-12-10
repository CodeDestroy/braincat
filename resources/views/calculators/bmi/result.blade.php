@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex justify-center items-start py-10">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-3xl space-y-6">
        <h3 class="text-xl font-semibold text-center mb-4">Введённые данные:</h3>
        <p><strong>Дата рождения:</strong> {{ $birthDate }}</p>
        <p><strong>Дата расчёта:</strong> {{ $calcDate }}</p>
        <p><strong>Пол:</strong> {{ $sex === 'male' ? 'Мужской' : 'Женский' }}</p>
        <p><strong>Рост:</strong> {{ $height }} см</p>
        <p><strong>Вес:</strong> {{ $weight }} кг</p>

        <h3 class="text-xl font-semibold text-center mb-4">Результаты</h3>
        <p><strong>Возраст:</strong> {{ $ageYears }} лет {{ $ageMonthsRemain }} мес ({{ $ageMonths }} мес)</p>

        @if(isset($method) && $method === 'WHO 0–5 лет')
            <p><strong>LFA SDS:</strong> {{ $lfaSDS }}</p>
            <p><strong>WFL/WFH SDS:</strong> {{ $wflSDS }}</p>
            <p><strong>LFA перцентиль:</strong> {{ $percLFA }}%</p>
            <p><strong>WFL/WFH перцентиль:</strong> {{ $percWFL }}%</p>
            <p><strong>Задержка роста:</strong> {{ $stunting }}</p>
            <!-- <p><strong>Атрофия:</strong> </p> -->
            <p><strong>Недовес:</strong> {{ $underweight }}</p>
            <p><strong>Риск ожирения:</strong> {{ $overweightRisk }}</p>
            <p><strong>Пропорциональность развития:</strong> {{ $harmony }}</p>
        @else
            <p><strong>Height age:</strong> {{ $heightAge }} лет</p>
            <p><strong>Height SDS:</strong> {{ $heightSDS }}</p>
            <p><strong>Height-for-age перцентиль:</strong> {{ $percHFA ?? 'N/A' }}%</p>

            <p><strong>BMI:</strong> {{ $bmi }}</p>
            <p><strong>BMI SDS:</strong> {{ $bmiSDS }}</p>
            <p><strong>BMI SDS (for Height age):</strong> {{ $bmiSDS_forHeightAge ?? 'N/A' }}</p>
            <p><strong>BMI-for-age перцентиль:</strong> {{ $percBMI ?? 'N/A' }}%</p>

            <p><strong>Задержка роста:</strong> {{ $stunting }}</p>
            <!-- <p><strong>Атрофия:</strong> </p> -->
            <p><strong>Недовес:</strong> {{ $underweight }}</p>
            <p><strong>Риск ожирения:</strong> {{ $overweightRisk }}</p>
            <p><strong>Пропорциональность развития:</strong> {{ $harmony }}</p>
        @endif


        <h3 class="text-xl font-semibold text-center mb-4">Скорость прироста роста и веса</h3>
        <canvas id="historyChart" width="400" height="200"></canvas>

        <h3 class="text-xl font-semibold text-center mb-4">График роста к возрасту (Height-for-Age)</h3>
        <canvas id="heightAgeChart" width="400" height="200"></canvas>

        @if(isset($method) && $method === 'WHO 0–5 лет')
            <h3 class="text-xl font-semibold text-center mb-4">График веса к росту (Weight-for-Height)</h3>
            <canvas id="weightHeightChart" width="400" height="200"></canvas>
        @else
            <h3 class="text-xl font-semibold text-center mb-4">График BMI к росту (BMI-for-Height)</h3>
            <canvas id="bmiHeightChart" width="400" height="200"></canvas>

            <h3 class="text-xl font-semibold text-center mb-4">График BMI к возрасту (BMI-for-Age)</h3>
            <canvas id="bmiAgeChart" width="400" height="200"></canvas>

        @endif

        <a href="{{ route('calc.form') }}" class="block mt-4 text-center bg-mona-lisa-600 hover:bg-mona-lisa-700 text-white rounded-lg py-2">
            Новый расчёт
        </a>
    </div>
</div>
<script>
function parseDateDMY(dateStr) {
    const parts = dateStr.split('.');
    // parts[0] = день, parts[1] = месяц, parts[2] = год
    return new Date(parts[2], parts[1]-1, parts[0]); // месяц 0-based
}

function getAgeInMonths(birthDateStr, currentDateStr) {
    const birth = new Date(birthDateStr);
    const current = new Date(currentDateStr);

    let months = (current.getFullYear() - birth.getFullYear()) * 12;
    months += current.getMonth() - birth.getMonth();

    // Если день месяца ещё не прошёл, уменьшаем на 1
    if (current.getDate() < birth.getDate()) {
        months -= 1;
    }

    // Добавляем дробную часть за дни
    const dayDiff = current.getDate() - birth.getDate();
    const daysInMonth = new Date(current.getFullYear(), current.getMonth()+1, 0).getDate();
    months += dayDiff / daysInMonth;

    return months;
}

function getAgeInYears(birthDateStr, currentDateStr) {

    const birth = new Date(birthDateStr);
    const current = new Date(currentDateStr);

    const years = current.getFullYear() - birth.getFullYear();
    const months = current.getMonth() - birth.getMonth();

    if (months < 0 || (months === 0 && current.getDate() < birth.getDate())) {
        return years - 1;
    }
    return years;
}
function getPercentileAtAge(age, percArray) {
    // percArray — это массив [{x: ageMonths, y: value}]
    // Находим два ближайших узла для линейной интерполяции
    for (let i = 0; i < percArray.length - 1; i++) {
        const a = percArray[i];
        const b = percArray[i+1];
        if (age >= a.x && age <= b.x) {
            const t = (age - a.x) / (b.x - a.x);
            return a.y + (b.y - a.y) * t;
        }
    }
    // если возраст выходит за пределы таблицы
    return percArray[percArray.length - 1].y;
}
</script>

<script src="/js/chart.js"></script>
<script>
const historyData = @json($history ?? []);
const labelsCtxHist = historyData.map(d => d.date);
const heightVelData = historyData.map(d => d.heightVel);
const weightVelData = historyData.map(d => d.weightVel);

// График скорости прироста 
const ctxHist = document.getElementById('historyChart').getContext('2d');
new Chart(ctxHist, {
    type: 'line',
    data: {
        labels: labelsCtxHist,
        datasets: [
            { label: 'Рост (см/мес)', data: heightVelData, borderColor: 'rgb(75,192,192)', fill: false, tension: 0.3 },
            { label: 'Вес (кг/мес)', data: weightVelData, borderColor: 'rgb(255,99,132)', fill: false, tension: 0.3 }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
        scales: { x: { title: { display: true, text: 'Дата' } }, y: { title: { display: true, text: 'Прирост' } } }
    }
});
const sdsColors = {
    "-3": "red",
    "-2": "orange",
    "-1": "gold",
     "0": "blue",
     "1": "green",
     "2": "cyan",
     "3": "purple"
};
</script>
<script>
// ---------- HEIGHT-FOR-AGE (перцентили + заливки как BMI-график) ----------

// WHO таблица для Height-for-Age
const hfaRows2 = @json($hfaRows ?? []);

// вычисление перцентиля по LMS
/* function hfaPercentile(r, p) {
    const L = parseFloat(r.L);
    const M = parseFloat(r.M);
    const S = parseFloat(r.S);

    // конвертация перцентиля → SDS
    // P3=−1.88079; P5=−1.64485; P10=−1.28155; P25=−0.6745; P50=0; P75=0.6745; ...
    const z = {
        3:  -1.88079,
        5:  -1.64485,
        10: -1.28155,
        25: -0.67449,
        50:  0,
        75:  0.67449,
        90:  1.28155,
        95:  1.64485,
        97:  1.88079
    }[p];

    if (L === 0) return M * Math.exp(S * z);
    return M * Math.pow(1 + L * S * z, 1 / L);
} */

// строим массивы данных по перцентилям
/* function buildHfaPerc_old(p) {
    return hfaRows2.map(r => {
        console.log(r)
        return ({
        x: parseFloat(r.Agemos),
        y: hfaPercentile(r, p)
    })});
} */
function buildHfaPerc(key) {
    return hfaRows2.map(r => {
        return ({
        x: parseFloat(r.Agemos),
        y: parseFloat(r[key])
    })});
}
const hfa_p3  = buildHfaPerc('P3');
const hfa_p5  = buildHfaPerc('P5');
const hfa_p10 = buildHfaPerc('P10');
const hfa_p25 = buildHfaPerc('P25');
const hfa_p50 = buildHfaPerc('P50');
const hfa_p75 = buildHfaPerc('P75');
const hfa_p90 = buildHfaPerc('P90');
const hfa_p95 = buildHfaPerc('P95');
const hfa_p97 = buildHfaPerc('P97');

// пользовательские точки роста
const heightData2 = @json($measurements ?? []);
const birthDateHfa = @json($birthDate);

const userHeightPoints = heightData2.map(m => {
    return {
        x: getAgeInMonths(parseDateDMY(birthDateHfa), m.date),
        y: m.height
    };
});

// ---- формируем перцентильные слои (как BMI-график) ----

const hfaDatasets = [
    // P3
    { label: 'P3', data: hfa_p3, backgroundColor: 'rgba(255,0,0,0.18)', borderColor: 'rgba(255,0,0,0.18)', pointRadius: 0 },

    // P5
    { label: 'P5', data: hfa_p5, backgroundColor: 'rgba(255,255,0,0.25)', borderColor: 'rgba(255,255,0,0.25)', pointRadius: 0 },

    // P10
    { label: 'P10', data: hfa_p10, backgroundColor: 'rgba(0,200,0,0.25)', borderColor: 'rgba(0,200,0,0.25)', pointRadius: 0 },

    // P25
    { label: 'P25', data: hfa_p25, backgroundColor: 'rgba(0,100,0,0.35)', borderColor: 'rgba(0,100,0,0.35)', pointRadius: 0 },

    // P75
    { label: 'P75', data: hfa_p75, backgroundColor: 'rgba(0,100,0,0.35)', borderColor: 'rgba(0,100,0,0.35)', pointRadius: 0 },

    // P90
    { label: 'P90', data: hfa_p90, backgroundColor: 'rgba(0,200,0,0.25)', borderColor: 'rgba(0,200,0,0.25)', pointRadius: 0 },

    // P95
    { label: 'P95', data: hfa_p95, backgroundColor: 'rgba(255,255,0,0.25)', borderColor: 'rgba(255,255,0,0.25)', pointRadius: 0 },

    // P97
    { label: 'P97', data: hfa_p97, backgroundColor: 'rgba(255,0,0,0.18)', borderColor: 'rgba(255,0,0,0.18)', pointRadius: 0 },
];


hfaDatasets[3].fill = { target: 4, above: 'rgba(0,100,0,0.35)' };     // p25–p75
hfaDatasets[2].fill = { target: 5, above: 'rgba(0,200,0,0.25)' };     // p10–p90
hfaDatasets[1].fill = { target: 6, above: 'rgba(255,255,0,0.25)' };   // p5–p95
hfaDatasets[0].fill = { target: 7, above: 'rgba(255,0,0,0.18)' };     // p3–p97
// Добавляем линию P50 (медиану)
hfaDatasets.push({
    label: 'P50',
    data: hfa_p50,
    borderColor: '#00cc00',   // ярко-зелёная линия
    borderWidth: 3,
    pointRadius: 0,
    tension: 0.3,
    fill: false
});

// пользовательская линия роста

const percColors = [
    { from: hfa_p3,  to: hfa_p5,  color: 'rgba(255, 0, 0, 1)'  }, // P3–P5
    { from: hfa_p5,  to: hfa_p10, color: 'rgba(255, 255, 0, 1)'}, // P5–P10
    { from: hfa_p10, to: hfa_p25, color: 'rgba(69, 245, 69, 1)' }, // P10–P25
    { from: hfa_p25, to: hfa_p75, color: 'rgba(10, 207, 10, 0.67)' }, // P25–P75
    { from: hfa_p75, to: hfa_p90, color: 'rgba(69, 245, 69, 1)' }, // P75–P90
    { from: hfa_p90, to: hfa_p95, color: 'rgba(255, 255, 0, 1)'}, // P90–P95
    { from: hfa_p95, to: hfa_p97, color: 'rgba(255, 0, 0, 1)'  }, // P95–P97
];

const coloredUserPoints = userHeightPoints.map(pt => {
    const age = pt.x;
    const height = pt.y;

    let pointColor = 'black'; // fallback

    for (const interval of percColors) {
        const low  = getPercentileAtAge(age, interval.from);
        const high = getPercentileAtAge(age, interval.to);

        if (height >= low && height <= high) {
            pointColor = interval.color;
            break;
        }
    }

    return {
        x: age,
        y: height
    };
});

const pointColors = userHeightPoints.map(pt => {
    const age = pt.x;
    const height = pt.y;

    let color = 'black';
    for (const interval of percColors) {
        const low  = getPercentileAtAge(age, interval.from);
        const high = getPercentileAtAge(age, interval.to);
        if (height >= low && height <= high) {
            color = interval.color;
            break;
        }
    }
    return color;
});

// dataset для пользовательской линии
hfaDatasets.push({
    type: 'line',
    label: 'Ваш рост',
    data: coloredUserPoints,
    borderColor: 'black',
    borderWidth: 3,
    tension: 0.3,
    pointRadius: 6,
    fill: false,
    pointBackgroundColor: pointColors  // <--- массив цветов
});

// ---- отрисовка графика ----
new Chart(document.getElementById('heightAgeChart'), {
    type: 'line',
    data: { datasets: hfaDatasets },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { type: 'linear', title: { display: true, text: 'Возраст (мес)' } },
            y: { title: { display: true, text: 'Рост (см)' } }
        }
    }
});
</script>

<script>
// --- Вес-к-росту ---

const wflRows = @json($wflRows ?? []);   // WHO таблица WFL/WFH
const measurementData = @json($measurements ?? []);

// Функция вычисления веса по SDS
function wflValue(r, sds) {
    const L = parseFloat(r.L);
    const M = parseFloat(r.M);
    const S = parseFloat(r.S);
    if (L === 0) return M * Math.exp(S * sds);
    return M * Math.pow(1 + L * S * sds, 1 / L);
}

// Строим SDS линии по всей таблице WHO
const sdsLinesWFL = [-3, -2, -1, 0, 1, 2, 3].map(sds => ({
    label: `${sds} SDS`,
    data: wflRows.map(r => ({
        x: parseFloat(r.Height),
        y: wflValue(r, sds)
    })),
    borderColor: sdsColors[sds],
    borderWidth: 2,
    fill: false,
    pointRadius: 0,
    pointHoverRadius: 0,
}));

// Пользовательские точки + линия
const userWflPoints = measurementData.map(m => ({
    x: parseFloat(m.height),
    y: parseFloat(m.weight)
}));

const userWflLine = {
    type: 'line',
    label: 'Ваш вес',
    data: userWflPoints,
    borderColor: 'black',
    backgroundColor: 'black',
    borderWidth: 3,
    tension: 0.3,
    pointRadius: 5,
    fill: false
};

new Chart(document.getElementById('weightHeightChart'), {
    type: 'line',
    data: {
        datasets: [
            ...sdsLinesWFL,
            userWflLine
        ]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                title: { display: true, text: 'Рост (см)' }
            },
            y: {
                title: { display: true, text: 'Вес (кг)' }
            }
        }
    }
});
</script>
<script>
// --- BMI-к-росту график ---
const bmiData = @json($measurements ?? []);

// Формируем точки: x = рост, y = BMI
const bmiPoints = bmiData.map(m => {
    const hMeters = m.height / 100;
    const bmi = m.weight / (hMeters * hMeters);
    return {
        x: parseFloat(m.height),
        y: parseFloat(bmi.toFixed(2))
    };
});

// Линия пользователя
const bmiUserLine = {
    type: 'line',
    label: 'Ваш BMI',
    data: bmiPoints,
    borderColor: 'black',
    backgroundColor: 'black',
    borderWidth: 3,
    tension: 0.3,
    pointRadius: 5,
    fill: false
};

// Строим график
new Chart(document.getElementById('bmiHeightChart'), {
    type: 'line',
    data: {
        datasets: [bmiUserLine]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                title: { display: true, text: 'Рост (см)' }
            },
            y: {
                title: { display: true, text: 'BMI' }
            }
        }
    }
});
</script>
<script>
const bmiRows = @json($bmiRows ?? []);
const measurements = @json($measurements ?? []);
const birthDateStr2 = @json($birthDate);

// функция для построения перцентильных линий
function buildPerc(key) {
    return bmiRows.map(r => {
        return ({
        x: parseFloat(r.Agemos),
        y: parseFloat(r[key])
    })});
}

// создаём линии перцентилей
const p3  = buildPerc('P3');
const p5  = buildPerc('P5');
const p10 = buildPerc('P10');
const p25 = buildPerc('P25');
const p50 = buildPerc('P50');
const p75 = buildPerc('P75');
const p90 = buildPerc('P90');
const p95 = buildPerc('P95');
const p97 = buildPerc('P97');

// цвета для пользовательских точек по диапазонам
const percColors2 = [
    { from: p3,  to: p5,  color: 'rgba(255,0,0,1)'  }, // P3–P5
    { from: p5,  to: p10, color: 'rgba(255,255,0,1)'}, // P5–P10
    { from: p10, to: p25, color: 'rgba(69,245,69,1)' }, // P10–P25
    { from: p25, to: p75, color: 'rgba(10,207,10,0.67)' }, // P25–P75
    { from: p75, to: p90, color: 'rgba(69,245,69,1)' }, // P75–P90
    { from: p90, to: p95, color: 'rgba(255,255,0,1)'}, // P90–P95
    { from: p95, to: p97, color: 'rgba(255,0,0,1)'  }  // P95–P97
];

// функция для интерполяции значения перцентиля по возрасту
function getPercentileAtAge(age, percArray) {
    for (let i = 0; i < percArray.length - 1; i++) {
        const a = percArray[i];
        const b = percArray[i+1];
        if (age >= a.x && age <= b.x) {
            const t = (age - a.x) / (b.x - a.x);
            return a.y + (b.y - a.y) * t;
        }
    }
    return percArray[percArray.length - 1].y;
}

// создаём массив пользовательских точек с цветом
const userBmiPoints = measurements.map(m => {
    const age = getAgeInMonths(parseDateDMY(birthDateStr2), m.date);
    const bmi = m.weight / Math.pow(m.height / 100, 2);

    // определяем цвет точки
    let pointColor = 'black';
    for (const interval of percColors2) {
        const low  = getPercentileAtAge(age, interval.from);
        const high = getPercentileAtAge(age, interval.to);
        if (bmi >= low && bmi <= high) {
            pointColor = interval.color;
            break;
        }
    }

    return { x: age, y: bmi, pointColor };
});

// массив цветов для Chart.js
const bmiPointColors = userBmiPoints.map(pt => pt.pointColor);

// строим dataset перцентилей с заливками
const datasets = [
    { label: 'P3', data: p3, backgroundColor: 'rgba(255,0,0,0.18)', borderColor: 'rgba(255,0,0,0.18)', pointRadius: 0 },
    { label: 'P5', data: p5, backgroundColor: 'rgba(255,255,0,0.25)', borderColor: 'rgba(255,255,0,0.25)', pointRadius: 0 },
    { label: 'P10', data: p10, backgroundColor: 'rgba(0,200,0,0.25)', borderColor: 'rgba(0,200,0,0.25)', pointRadius: 0 },
    { label: 'P25', data: p25, backgroundColor: 'rgba(0,100,0,0.35)', borderColor: 'rgba(0,100,0,0.35)', pointRadius: 0 },
    { label: 'P75', data: p75, backgroundColor: 'rgba(0,100,0,0.35)', borderColor: 'rgba(0,100,0,0.35)', pointRadius: 0 },
    { label: 'P90', data: p90, backgroundColor: 'rgba(0,200,0,0.25)', borderColor: 'rgba(0,200,0,0.25)', pointRadius: 0 },
    { label: 'P95', data: p95, backgroundColor: 'rgba(255,255,0,0.25)', borderColor: 'rgba(255,255,0,0.25)', pointRadius: 0 },
    { label: 'P97', data: p97, backgroundColor: 'rgba(255,0,0,0.18)', borderColor: 'rgba(255,0,0,0.18)', pointRadius: 0 },
];

// заливки
datasets[3].fill = { target: 4, above: 'rgba(0,100,0,0.35)' };
datasets[2].fill = { target: 5, above: 'rgba(0,200,0,0.25)' };
datasets[1].fill = { target: 6, above: 'rgba(255,255,0,0.25)' };
datasets[0].fill = { target: 7, above: 'rgba(255,0,0,0.18)' };

// медиана
datasets.push({
    label: 'P50',
    data: p50,
    borderColor: '#00cc00',
    borderWidth: 3,
    pointRadius: 0,
    tension: 0.3,
    fill: false
});

// пользовательские точки с цветом
datasets.push({
    type: 'line',
    label: 'Ваш BMI',
    data: userBmiPoints,
    borderColor: 'black',
    borderWidth: 3,
    pointRadius: 6,
    tension: 0.3,
    fill: false,
    pointBackgroundColor: bmiPointColors
});

// отрисовка графика
new Chart(document.getElementById('bmiAgeChart'), {
    type: 'line',
    data: { datasets },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { type: 'linear', title: { display: true, text: 'Возраст (мес)' } },
            y: { title: { display: true, text: 'BMI' } }
        }
    }
});
</script>


<!-- <script>
// ГРАФИК BMI-к-возрасту 
const bmiRows = @json($bmiRows ?? []);
console.log('bmiRows', bmiRows)
const measurements = @json($measurements ?? []);
const birthDateStr2 = @json($birthDate);
function buildBmiSdsPoint(row, sds) {
    const L = parseFloat(row.L);
    const M = parseFloat(row.M);
    const S = parseFloat(row.S);
    if (L === 0) {
        return M * Math.exp(S * sds);
    }
    
    const base = 1 + L*S*sds;
    if (base <= 0) {//  защита от отрицательных/нулевых
        return M * 0.001;
    } 
    if (M * Math.pow(base, 1 / L) > 80)
        return M * Math.pow(base, 1 / L);
}
// строим SDS линии: [{x: ageMonths, y: BMI_SDS}, ...]
const bmiSdsLines = [-3,-2,-1,0,1,2,3].map(sds => ({
    label: `${sds} SDS`,
    data: bmiRows.map(r => ({
        x: parseFloat(r.Agemos),
        y: parseFloat(buildBmiSdsPoint(r, sds))  // <--- parseFloat
    })),
    borderColor: sdsColors[sds] ?? 'gray',
    borderWidth: 2,
    pointRadius: 0,
    tension: 0.25,
    fill: false
}));


// пользовательские BMI-точки
const userBmiPoints = measurements.map(m => {
    const age = getAgeInMonths(parseDateDMY(birthDateStr2), m.date); // число
    const bmi = parseFloat(m.weight) / Math.pow(parseFloat(m.height)/100, 2); // число
    return { x: age, y: bmi };
});
userBmiPoints.sort((a,b) => a.x - b.x);
bmiRows.sort((a,b) => parseFloat(a.Agemos) - parseFloat(b.Agemos));

// график
new Chart(document.getElementById('bmiAgeChart'), {
    type: 'line',
    data: {
        datasets: [
            ...bmiSdsLines,
            {
                type: 'scatter',
                label: 'Ваш BMI',
                data: userBmiPoints,
                showLine: true,
                borderColor: 'black',
                backgroundColor: 'black',
                borderWidth: 3,
                pointRadius: 5,
                tension: 0.3,
                fill: false
            }
        ]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                title: { display: true, text: 'Возраст (мес)' }
            },
            y: {
                title: { display: true, text: 'BMI' }
            }
        }
    }
});
</script> -->

@endsection
