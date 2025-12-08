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
            <p><strong>Атрофия:</strong> {{ $wasting }}</p>
            <p><strong>Недовес:</strong> {{ $underweight }}</p>
            <p><strong>Риск ожирения:</strong> {{ $overweightRisk }}</p>
            <p><strong>Пропорциональность развития:</strong> {{ $harmony }}</p>
        @else
            <p><strong>Height age:</strong> {{ $heightAge }} лет</p>
            <p><strong>Height SDS:</strong> {{ $heightSDS }}</p>
            <p><strong>BMI:</strong> {{ $bmi }}</p>
            <p><strong>BMI SDS (for Height age):</strong> {{ $bmiSDS_forHeightAge ?? 'N/A' }}</p>
        @endif

        <h3 class="text-xl font-semibold text-center mb-4">Скорость прироста роста и веса</h3>
        <canvas id="historyChart" width="400" height="200"></canvas>

        <h3 class="text-xl font-semibold text-center mb-4">График роста к возрасту (Height-for-Age)</h3>
        <canvas id="heightAgeChart" width="400" height="200"></canvas>

        <h3 class="text-xl font-semibold text-center mb-4">График веса к росту (Weight-for-Height)</h3>
        <canvas id="weightHeightChart" width="400" height="200"></canvas>

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

// --- График скорости прироста ---
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
// --- Height-for-Age ---
const heightData = @json($measurements ?? []);
const hfaRows = @json($hfaRows ?? []);
const birthDate = @json($birthDate ?? []);

const labelsHeightChart = heightData.map(d => d.date); // <-- теперь все измерения
function buildHeightSDSLine(sdsValue) {
    return heightData.map((d,i) => {
        const date = new Date(d.date);
        const birth = parseDateDMY(birthDate);
        const ageMonths = getAgeInMonths(birth, date);
        let closest = hfaRows.reduce((prev,row)=> Math.abs(row.Agemos-ageMonths)<Math.abs(prev.Agemos-ageMonths)?row:prev, hfaRows[0]);
        const L = parseFloat(closest.L), M = parseFloat(closest.M), S = parseFloat(closest.S);
        if(L===0) return M*Math.exp(S*sdsValue);
        return M*Math.pow(1+L*S*sdsValue,1/L);
    });
}

const heightChart = new Chart(document.getElementById('heightAgeChart'), {
    type: 'line',
    data: {
        labels: labelsHeightChart,
        datasets: [
            { label: '-3 SDS', data: buildHeightSDSLine(-3), borderColor: 'rgba(255,0,0,0.5)', borderDash:[5,5], fill:false },
            { label: '-2 SDS', data: buildHeightSDSLine(-2), borderColor: 'rgba(255,165,0,0.5)', borderDash:[5,5], fill:false },
            { label: '-1 SDS', data: buildHeightSDSLine(-1), borderColor: 'rgba(255,255,0,0.5)', borderDash:[5,5], fill:false },
            { label: '0 SDS', data: buildHeightSDSLine(0), borderColor: 'rgba(0,0,255,0.5)', fill:false },
            { label: '+1 SDS', data: buildHeightSDSLine(1), borderColor: 'rgba(0,255,0,0.5)', fill:false },
            { label: '+2 SDS', data: buildHeightSDSLine(2), borderColor: 'rgba(0,255,255,0.5)', fill:false },
            { label: '+3 SDS', data: buildHeightSDSLine(3), borderColor: 'rgba(128,0,128,0.5)', borderDash:[5,5], fill:false },
            { label: 'Ваш рост', data: heightData.map(d=>d.height), borderColor: 'rgba(0,0,0,1)', fill:false, tension:0.2 }
        ]
    },
    options: { responsive:true, plugins:{legend:{position:'top'}}, scales:{x:{title:{display:true,text:'Дата'}},y:{title:{display:true,text:'Рост (см)'}}} }
});
</script>
<script>
// --- Weight-for-Height ---
const wflRows = @json($wflRows ?? []); // LMS таблицы WFL/WFH
function buildWFLLine(sdsValue) {
    return heightData.map(d => {
        const height = d.height;
        let closest = wflRows.reduce((prev,row)=> Math.abs(parseFloat(row.Height)-height)<Math.abs(parseFloat(prev.Height)-height)?row:prev, wflRows[0]);
        const L = parseFloat(closest.L), M = parseFloat(closest.M), S = parseFloat(closest.S);
        if(L===0) return M*Math.exp(S*sdsValue);
        return M*Math.pow(1+L*S*sdsValue,1/L);
    });
}

const weightHeightChart = new Chart(document.getElementById('weightHeightChart'), {
    type: 'line',
    data: {
        labels: heightData.map(d => d.height), // рост по оси X
        datasets: [
            { label: '-3 SDS', data: buildWFLLine(-3), borderColor: 'rgba(255,0,0,0.5)', borderDash:[5,5], fill:false },
            { label: '-2 SDS', data: buildWFLLine(-2), borderColor: 'rgba(255,165,0,0.5)', borderDash:[5,5], fill:false },
            { label: '-1 SDS', data: buildWFLLine(-1), borderColor: 'rgba(255,255,0,0.5)', borderDash:[5,5], fill:false },
            { label: '0 SDS', data: buildWFLLine(0), borderColor: 'rgba(0,0,255,0.5)', fill:false },
            { label: '+1 SDS', data: buildWFLLine(1), borderColor: 'rgba(0,255,0,0.5)', fill:false },
            { label: '+2 SDS', data: buildWFLLine(2), borderColor: 'rgba(0,255,255,0.5)', fill:false },
            { label: '+3 SDS', data: buildWFLLine(3), borderColor: 'rgba(128,0,128,0.5)', borderDash:[5,5], fill:false },
            { label: 'Ваш вес', data: heightData.map(d => d.weight), borderColor: 'rgba(0,0,0,1)', fill:false, tension:0.2 }
        ]
    },
    options: {
        responsive:true,
        plugins:{legend:{position:'top'}},
        scales:{
            x:{title:{display:true,text:'Рост (см)'}},
            y:{title:{display:true,text:'Вес (кг)'}}
        }
    }
});
</script>
@endsection
