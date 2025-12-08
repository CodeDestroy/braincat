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
</script>
<script>
const sdsColors = {
    "-3": "red",
    "-2": "orange",
    "-1": "gold",
     "0": "blue",
     "1": "green",
     "2": "cyan",
     "3": "purple"
};
// Рост-к-возрасту
const hfaRows = @json($hfaRows ?? []);
const heightData = @json($measurements ?? []);
const birthDateStr = @json($birthDate);

// Построение линии SDS

// SDS линии в формате [{x, y}, ...] без точек
const hfaSdsLines = [-3,-2,-1,0,1,2,3].map(sds => ({
    label: `${sds} SDS`,
    data: hfaRows.map(r => ({
        x: parseFloat(r.Agemos),
        y: buildHfaSingle(r, sds)
    })),
    borderColor: sdsColors[sds],
    borderWidth: 2,
    fill: false,
    pointRadius: 0,        // <-- отключаем точки
    pointHoverRadius: 0,   // <-- отключаем ховер-точки
}));

// для расчёта точки SDS по одной строке
function buildHfaSingle(r, sds) {
    const L = parseFloat(r.L);
    const M = parseFloat(r.M);
    const S = parseFloat(r.S);
    if (L === 0) return M * Math.exp(S * sds);
    return M * Math.pow(1 + L * S * sds, 1 / L);
}

// Точки пользователя
const userPoints = heightData.map(m => {
    return {
        x: getAgeInMonths(parseDateDMY(birthDateStr), m.date),
        y: m.height
    };
});
new Chart(document.getElementById('heightAgeChart'), {
    type: 'line',
    data: {
        datasets: [
            ...hfaSdsLines,
            {
                /* type: 'scatter',
                label: 'Ваш рост',
                data: userPoints, // {x, y}
                backgroundColor: 'black',
                pointRadius: 5, */
                type: 'line',
                label: 'Ваш рост',
                data: userPoints,  
                borderColor: 'black',
                backgroundColor: 'black',
                borderWidth: 3,
                tension: 0.3,
                pointRadius: 5,
                fill: false
            }
        ]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                title: { display:true, text:'Возраст (мес)' }
            },
            y: {
                title: { display:true, text:'Рост (см)' }
            }
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
console.log('bmiRows', bmiRows)
const measurements = @json($measurements ?? []);
const birthDateStr2 = @json($birthDate);
console.log('measurements', measurements)
console.log('birthDateStr2', birthDateStr2)
const percColors = {
    P3: 'red', P5: 'orange', P10: 'gold',
    P25: 'green', P50: 'blue', P75: 'green',
    P85: 'purple', P90: 'violet', P95: 'pink', P97: 'darkred'
};

const percKeys = ['P3','P5','P10','P25','P50','P75','P85','P90','P95','P97'];

const percDatasets = percKeys.map(key => ({
    label: key,
    data: bmiRows.map(r => ({ x: parseFloat(r.Agemos), y: parseFloat(r[key]) })),
    borderColor: percColors[key],
    borderWidth: 2,
    fill: false,
    pointRadius: 0,
    tension: 0.25
}));
console.log('percDatasets', percDatasets)
const userBmiPoints = measurements.map(m => {
    const age = getAgeInMonths(parseDateDMY(birthDateStr2), m.date);
    const bmi = parseFloat(m.weight) / Math.pow(parseFloat(m.height)/100, 2);
    return { x: age, y: bmi };
});
console.log('userBmiPoints', userBmiPoints)
new Chart(document.getElementById('bmiAgeChart'), {
    type: 'line',
    data: {
        datasets: [
            ...percDatasets,
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
