@extends('layouts.app')

@section('content')
{{-- <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div>Мои курсы</div>
    {{$courses}}
    
</div> --}}

<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Мои курсы</h2>
            {{-- <p class="mt-2 text-lg leading-8 text-gray-600">Тут представленны все оплаченные вами курсы.</p> --}}
            <div class="mt-10 space-y-20 lg:mt-20 lg:space-y-20">
                @if (count($courses) > 0)
                    @foreach ($courses as $course)
                        <a href="{{route('education.course', ['course_id' => $course->id])}}">
                            <article class="relative isolate flex flex-col gap-8 lg:flex-row my-5">
                                <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
                                    <img src="{{$course['image']}}"" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover">
                                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                                <div>
                                    <div class="flex items-center gap-x-4 text-xs">
                                        {{-- <img src="{{$course['image']}}"> --}}
                                        @php
                                        $date = $course['start_date']; // Дата
                                        $time = $course['start_time']; // Время
                                        $datetime = \Carbon\Carbon::parse("$date $time");
                                        $formattedDateTime = ucfirst($datetime->translatedFormat('d F Y H:i'));
                                    @endphp
                                    <time datetime="{{ $datetime->toIso8601String() }}" class="text-gray-500">{{ $formattedDateTime }}</time>
                                        {{-- <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Психология</a> --}}
                                    </div>
                                    <div class="group relative max-w-xl">
                                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                            
                                                <span class="absolute inset-0"></span>
                                                {{$course['name']}}
                                            
                                        </h3>
                                        <p class="mt-5 text-sm leading-6 text-gray-600">{{$course['description']}}</p>
                                    </div>
                                    {{-- <div class="mt-6 flex border-t border-gray-900/5 pt-6">
                                        <div class="relative flex items-center gap-x-4">
                                            <img src="{{$course['image']}}">
                                            <div class="text-sm leading-6">
                                                <p class="font-semibold text-gray-900">
                                                    <a href="#">
                                                        <span class="absolute inset-0"></span>
                                                        Michael Foster
                                                    </a>
                                                </p>
                                                <p class="text-gray-600">Co-Founder / CTO</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </article>
                        </a>
                    @endforeach
                @else
                    <h3 class="text-2xl tracking-tight text-gray-700 sm:text-3xl">Нет доступных курсов</h3>
                @endif
            </div>
            @isset($availableCourses)
            <h2 class="mt-10 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Доступные к оплате</h2>
            {{-- <p class="mt-2 text-lg leading-8 text-gray-600">Тут представленны все оплаченные вами курсы.</p> --}}
            <div class="mt-10 space-y-20 lg:mt-20 lg:space-y-20">
                @foreach ($availableCourses as $course)
                <a href="{{$course->url}}">
                    <article class="relative isolate flex flex-col gap-8 lg:flex-row my-5">
                        <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
                            <img src="{{$course['image']}}"" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div>
                            <div class="flex items-center gap-x-4 text-xs">
                                @php
                                    $date = $course['start_date']; // Ваша дата
                                    $formattedDate = ucfirst(\Carbon\Carbon::parse($date)->translatedFormat('d F Y'));
                                @endphp
                                <time datetime="2020-03-16" class="text-gray-500">{{$formattedDate}}</time>
                            </div>
                            <div class="group relative max-w-xl">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    
                                        <span class="absolute inset-0"></span>
                                        {{$course['name']}}
                                    
                                </h3>
                                <p class="mt-5 text-sm leading-6 text-gray-600">{{$course['description']}}</p>
                            </div>

                        </div>
                    </article>
                </a>
                @endforeach
           
            </div>
            @endisset
        </div>
        
    </div>
</div>
@endsection