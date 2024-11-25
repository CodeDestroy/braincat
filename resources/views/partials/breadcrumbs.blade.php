@unless ($breadcrumbs->isEmpty())
    
    <div class="bg-white p-8">
        <div class="mx-auto max-w-7xl">
            <div>
                <div>
                    <nav class="sm:hidden" aria-label="Back">
                        <a href="{{ url('/')}}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                            <svg class="-ml-1 mr-1 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"></path>
                            </svg>
                            Назад
                        </a>
                    </nav>
                    <nav class="hidden sm:flex" aria-label="Breadcrumb">
                        <ol role="list" class="flex item-center space-x-4 breadcrumb">
                            @foreach ($breadcrumbs as $breadcrumb)
                    
                                @if (!is_null($breadcrumb->url) && !$loop->last)
                                    {{-- <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li> --}}
                                   
                                    <div class="flex item-center">
                                        @if (!$loop->first)
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        <a href="{{ $breadcrumb->url }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $breadcrumb->title }}</a>
                                    </div>
                                @else
                                    {{-- <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li> --}}
                                    <div class="flex item-center">
                                        @if (!$loop->first)
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        <a class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $breadcrumb->title }}</a>
                                    </div>
                                @endif
                    
                            @endforeach
                        </ol>
                        {{-- <ol role="list" class="flex items-center space-x-4">
                            @foreach ($breadcrumbs as $breadcrumb)
                    
                                @if (!is_null($breadcrumb->url) && !$loop->last)
                                    <li>
                                        <div class="flex item-center">
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                                            </svg>
                                            <a href="{{ $breadcrumb->url }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $breadcrumb->title }}</a>
                                        </div>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                                    <li>
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="flex">
                                            <a class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $breadcrumb->title }}</a>
                                        </div>
                                    </li>
                                @endif
                    
                            @endforeach

                        </ol> --}}
                    </nav>
                </div>
                
            </div>
        </div>
    </div>
@endunless

