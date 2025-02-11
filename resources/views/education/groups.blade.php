@extends('layouts.app')

@section('content')
{{-- <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div>Мои курсы</div>
    {{$courses}}
    
</div> --}}
<?
    function mb_ucfirst_custom($str, $encoding='UTF-8')
	{
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
?>
<div class="bg-white">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <!--
  This example requires Tailwind CSS v2.0+

  The alpine.js code is *NOT* production ready and is included to preview
  possible interactivity
-->
        <div class="bg-white py-24 ">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{mb_ucfirst_custom($groupName)}}</h2>
                    {{-- <p class="mt-2 text-lg leading-8 text-gray-600">Тут можно описание</p> --}}
                </div>
                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach ($courses as $course)
                        <article class="flex flex-col items-start justify-between mb-12">
                            <div class="relative w-full">
                                <img src="{{$course['image']}}"  alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                            </div>
                            <div class="max-w-xl">
                                <div class="mt-8 flex items-center gap-x-4 text-xs">
                                    @if ($course['start_date'] )
                                        @php
                                            $date = $course['start_date']; // Ваша дата
                                            $formattedDate = ucfirst(\Carbon\Carbon::parse($date)->translatedFormat('d F Y'));
                                        @endphp
                                        <time datetime="2020-03-16" class="text-gray-500">{{$formattedDate}}</time>
                                    @else 
                                        <time datetime="2020-03-16" class="text-gray-500">Скоро</time>
                                    @endif
                                    {{-- Тут сделаем тип (Вебинар, курс и т.п) --}}
                                    {{-- <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Marketing</a> --}}
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="{{$course->url}}">
                                        <span class="absolute inset-0"></span>
                                        {{$course['name']}}
                                    </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{$course['description']}}</p>
                                </div>
                                {{-- Сюда расказчика --}}
                                {{-- <div class="relative mt-8 flex items-center gap-x-4">
                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="" class="h-10 w-10 rounded-full bg-gray-100">
                                    <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="#">
                                        <span class="absolute inset-0"></span>
                                            Michael Foster
                                        </a>
                                    </p>
                                    <p class="text-gray-600">Co-Founder / CTO</p>
                                    </div>
                                </div> --}}
                            </div>
                        </article>
                    @endforeach

        
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
            {{-- <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{mb_ucfirst($groupName)}}</h2>
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
                @else
                    <h3 class="text-2xl tracking-tight text-gray-700 sm:text-3xl">Нет доступных курсов</h3>
                @endif
            </div> --}}



            {{-- @isset($availableCourses)
            <h2 class="mt-10 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Доступные к оплате</h2>
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
            @endisset --}}
        </div>
        
    </div>
</div>
@endsection