<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('layout.pages') }}
            </h2>
            @can('can-create-page')
                <div class="relative inline-block text-left group">
                    <button class="text-gray-400 font-medium dark:hover:text-gray-200 hover:text-gray-600 cursor-pointer transition-colors duration-200 focus:outline-none">
                    {{__('pages.create')}}
                    </button>
                    <div class="absolute dropdown-menu py-2 right-0 hidden mt-0 w-56 rounded-md shadow-lg dark:bg-gray-700 bg-white text-gray-500 dark:text-gray-200 ring-1 ring-black ring-opacity-5 group-hover:block">
                        <a href="{{route('pages.create_company')}}" class="block px-4 py-2 text-sm hover:text-gray-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            {{__('pages.company')}}
                        </a>
                        <a href="{{route('pages.create_product')}}" class="block px-4 py-2 text-sm hover:text-gray-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            {{__('pages.product')}}
                        </a>
                        <a href="{{route('pages.create_topic')}}" class="block px-4 py-3 text-sm hover:text-gray-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>
                            {{__('pages.topic')}}
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8 text-gray-800 dark:text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('pages.index') }}" method="GET">
                    <label class="text-lg text-bold" for="search-pages">{{__('general.search_title')}}</label>
                    <div class="flex mt-3 items-center">
                        <input value="{{request()->input('search')}}" class="w-full dark:bg-gray-700 px-4 py-2 border dark:border-gray-600 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="{{__('pages.search_hint')}}" id="search-pages" />
                        <button class="flex items-center ml-2 px-3 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            {{__('general.search')}}
                        </button>
                    </div>
                    <label for="page_type" class="block mt-2 mb-2 text-lg text-bold">{{__('general.search_question')}}</label>
                    <select class="cursor-pointer block dark:bg-gray-700 shadow-sm rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="page_type" name="page_type">
                        <option value="all" {{ request()->input('page_type', 'all') === 'all' ? 'selected' : '' }}>{{__('pages.all')}}</option>
                        <option value="company" {{ request()->input('page_type', 'company') === 'company' ? 'selected' : '' }}>{{__('pages.company')}}</option>
                        <option value="product" {{ request()->input('page_type', 'product') === 'product' ? 'selected' : '' }}>{{__('pages.product')}}</option>
                        <option value="topic" {{ request()->input('page_type', 'topic') === 'topic' ? 'selected' : '' }}>{{__('pages.topic')}}</option>
                    </select>
                    <div class="flex flex-col mt-4">
                        <div>
                            <p class="mb-2 inline">{{__('general.tags_filter')}}</p>
                            <button id="show_tags_btn" class="dark:bg-gray-700 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200">{{__('general.show_tags')}}</button>
                        </div>
                        <ul id="tags_list" class="mt-4 grid md:grid-cols-3 items-center w-full text-sm font-medium bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($tags as $tag)
                                <li class="w-full">
                                    <div class="flex items-center pl-3">
                                        <input {{in_array($tag->id, $filterTags) ? 'checked' : ''}} name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-list-{{$tag->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
            <div class="grid md:grid-cols-2 gap-5 mt-5">
                @foreach($pages as $page)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200">
                        <div class="flex items-center mb-3">
                            @if($page->logo_path)
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/' . $page->logo_path) }}" alt="{{__('general.logo')}}">
                            @else
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/images/no-logo.svg') }}" alt="{{__('general.no_logo')}}">
                            @endif
                            @switch($page->getTable())
                                @case('company_page')
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_company', ['id' => $page->id])}}">{{$page->name}}</a></h4>
                                    @break
                                @case('product_page')
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_product', ['id' => $page->id])}}">{{$page->name}}</a></h4>
                                    @break
                                @case('topic_page')
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_topic', ['id' => $page->id])}}">{{$page->name}}</a></h4>
                                    @break
                                @default
                                    <h4>Unknown</h4>
                            @endswitch
                        </div>
                        <p>{{$page->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', (event) => {
            const showTagsBtn = document.getElementById('show_tags_btn');
            const tagsList = document.getElementById('tags_list');

            showTagsBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // If the list is not displayed, show it and update the button text
                if (tagsList.style.display === 'none') {
                    tagsList.style.display = 'grid';
                    showTagsBtn.textContent = 'Hide tags';
                }
                // If the list is displayed, hide it and update the button text
                else {
                    tagsList.style.display = 'none';
                    showTagsBtn.textContent = 'Show tags';
                }
            });

            // Initially hide the tags list
            tagsList.style.display = 'none';
            showTagsBtn.textContent = 'Show tags';
        });

    </script>

</x-app-layout>
