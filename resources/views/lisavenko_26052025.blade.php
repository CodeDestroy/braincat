@extends('layouts.app')

@section('content')
<div class="relative bg-white" {{-- style="height: 100vh;" --}} >
    <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
        <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
          <div class="mx-auto max-w-2xl lg:mx-0">
              <div class="hidden sm:mt-32 sm:flex lg:mt-16">
                  <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                      Вебинар <strong class="text-mona-lisa-600">для специалистов</strong> 
                  </div>
              </div>
              <h1 class="mt-24 text-3xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">Три чемодана или путешествие длиною в жизнь: авторская диагностико-ресурсная техника</h1>
              <p class="mt-6 text-lg leading-6 text-gray-600">педагог, психолог Марина Евгеньевна Лисавенко</p>
              <div class="mt-10 flex items-center gap-x-6">
                  <a href="#price-webinar" class="rounded-md bg-mona-lisa-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-mona-lisa-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mona-lisa-800">Приобрести запись</a>
                  <a href="#with-large-avatar" class="text-sm font-semibold leading-6 text-gray-900">Узнать больше...</a>
              </div>
          </div>
        </div>
        <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
            <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full" src="{{ asset('img/hero_lisavenko_26052025.jpg') }}" alt="">
        </div>
    </div>
</div>
  
  
<div class="bg-stone-100 py-24 sm:py-32"  id='dopobr'{{-- style="height: 100vh;" --}}>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-mona-lisa-700 sm:text-4xl">Видеозапись вебинара</h2>
            {{-- <p class="mt-1 text-lg leading-8 text-gray-600">26 мая 2025 года с 19-00 до 21-15</p>
            <p class="mt-0 text-lg leading-8 text-gray-600"><strong>3 академических часа</strong></p>
            <p class="mt-0 text-lg leading-8 text-gray-600">лекция, практикум, ответы на вопросы</p> --}}
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600">
                          <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path d="M12 18.0093V12.7593M12 12.7593C12.5179 12.7593 13.0206 12.6937 13.5 12.5703M12 12.7593C11.4821 12.7593 10.9794 12.6937 10.5 12.5703M14.25 20.0487C13.5212 20.187 12.769 20.2593 12 20.2593C11.231 20.2593 10.4788 20.187 9.75 20.0487M13.5 22.4313C13.007 22.4828 12.5066 22.5093 12 22.5093C11.4934 22.5093 10.993 22.4828 10.5 22.4313M14.25 18.0093V17.8176C14.25 16.8347 14.9083 15.9943 15.7585 15.501C17.9955 14.203 19.5 11.7818 19.5 9.00928C19.5 4.86714 16.1421 1.50928 12 1.50928C7.85786 1.50928 4.5 4.86714 4.5 9.00928C4.5 11.7818 6.00446 14.203 8.24155 15.501C9.09173 15.9943 9.75 16.8347 9.75 17.8176V18.0093" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </div>
                        Актуальность
                    </dt>
                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                        <p class="flex-auto">Арт-терапевтические методы представляют широкий спектр техник, набор которых можно варьировать в зависимости от терапевтических задач.  Мы рассмотрим особый авторский подход, объединяющий диагностику, нарративную терапию и работу с ресурсами. Он особенно актуален при ведении клиентов, переживающих глубокий кризис, позволяет найти выход из кризисной ситуации и определить перспективные направления развития.
                        </p>
                    </dd>
                </div>
                <div class="flex flex-col">
                  <dt class="text-base font-semibold leading-7 text-gray-900">
                      <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                          </svg>
                      </div>
                      Аудитория
                  </dt>
                  <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                      <p class="flex-auto">Психологи, использующие различные подходы в терапии. Студенты профильных высших учебных заведений. Для вебинара слушателям потребуются: бумага формата А3 и цветные карандаши, восковые мелки или краски.
</p>
                  </dd>
                </div>
                <div class="flex flex-col">
                  <dt class="text-base font-semibold leading-7 text-gray-900">
                      <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-mona-lisa-600">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path d="M27 6H17V26H27C27.7956 26 28.5587 25.6839 29.1213 25.1213C29.6839 24.5587 30 23.7956 30 23V9C30 8.20435 29.6839 7.44129 29.1213 6.87868C28.5587 6.31607 27.7956 6 27 6ZM25 21H20C19.7348 21 19.4804 20.8946 19.2929 20.7071C19.1054 20.5196 19 20.2652 19 20C19 19.7348 19.1054 19.4804 19.2929 19.2929C19.4804 19.1054 19.7348 19 20 19H25C25.2652 19 25.5196 19.1054 25.7071 19.2929C25.8946 19.4804 26 19.7348 26 20C26 20.2652 25.8946 20.5196 25.7071 20.7071C25.5196 20.8946 25.2652 21 25 21ZM25 17H22C21.7348 17 21.4804 16.8946 21.2929 16.7071C21.1054 16.5196 21 16.2652 21 16C21 15.7348 21.1054 15.4804 21.2929 15.2929C21.4804 15.1054 21.7348 15 22 15H25C25.2652 15 25.5196 15.1054 25.7071 15.2929C25.8946 15.4804 26 15.7348 26 16C26 16.2652 25.8946 16.5196 25.7071 16.7071C25.5196 16.8946 25.2652 17 25 17ZM25 13H20C19.7348 13 19.4804 12.8946 19.2929 12.7071C19.1054 12.5196 19 12.2652 19 12C19 11.7348 19.1054 11.4804 19.2929 11.2929C19.4804 11.1054 19.7348 11 20 11H25C25.2652 11 25.5196 11.1054 25.7071 11.2929C25.8946 11.4804 26 11.7348 26 12C26 12.2652 25.8946 12.5196 25.7071 12.7071C25.5196 12.8946 25.2652 13 25 13Z"/>
                            <path d="M12 20C12 20.2652 11.8946 20.5196 11.7071 20.7071C11.5196 20.8946 11.2652 21 11 21C10.7348 21 10.4804 20.8946 10.2929 20.7071C10.1054 20.5196 10 20.2652 10 20V6H5C4.20435 6 3.44129 6.31607 2.87868 6.87868C2.31607 7.44129 2 8.20435 2 9V23C2 23.7956 2.31607 24.5587 2.87868 25.1213C3.44129 25.6839 4.20435 26 5 26H15V6H12V20Z"/>
                        </svg>
                      </div>
                      Результат
                  </dt>
                  <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                      <p class="flex-auto">Слушатели познакомятся с синергией метафорического, арт-терапевтического и нарративного подходов в рамках уникальной авторской методики, научатся применять ее на практике, узнают, как терапевту увидеть внутреннее состояния клиента в динамике, а  пациенту в терапии раскрыть себя с новой стороны. Участники мероприятия получат именные электронные сертификаты.</p>
                  </dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<div id="price-webinar">
    <three-tiers-price-lisavenko-26052025/>
</div>

<div id="with-large-avatar">
    <with-large-avatar-lisavenko/>
</div>

<div id="content">
    <content-lisavenko-26052025/>
</div>

@endsection