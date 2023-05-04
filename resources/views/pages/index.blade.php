<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pages') }}
            </h2>
            <div class="relative inline-block text-left group">
                <button class="text-gray-400 font-medium hover:text-gray-200 cursor-pointer transition-colors duration-200 focus:outline-none">
                    Create a new page
                </button>
                <div class="absolute dropdown-menu right-0 hidden mt-0 w-56 rounded-md shadow-lg bg-gray-700 text-gray-200 ring-1 ring-black ring-opacity-5 group-hover:block">
                    <a href="{{route('pages.create_company')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Company</a>
                    <a href="{{route('pages.create_company')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Product</a>
                    <a href="{{route('pages.create_company')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Topic</a>
                </div>
            </div>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('pages.index') }}" method="GET">
                    <label class="text-gray-200 text-lg text-bold" for="search-pages">Search for pages</label>
                    <div class="flex mt-3 items-center">
                        <input class="w-full dark:bg-gray-700 px-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for a company/product/topic" id="search-pages" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                    <label for="page_type" class="block mt-2 mb-2 text-gray-200 text-lg text-bold">What are we searching for?</label>
                    <select class="cursor-pointer block bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="page_type" name="page_type">
                        <option value="all">All</option>
                        <option value="company">Company</option>
                        <option value="product">Product</option>
                        <option value="topic">Topic</option>
                    </select>
                </form>
                <h3 class="mt-5 mb-1 text-gray-200 text-lg text-bold">Select filters</h3>
                <div class="flex flex-wrap">
                    @foreach($tags as $tag)
                        <span class="inline-block text-gray-200 bg-gray-800 px-3 py-1 m-1 text-sm font-semibold rounded-full cursor-pointer hover:bg-gray-700 transition-colors duration-200 border border-gray-600">
                            {{$tag->title}}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5 mt-5">
                @foreach($pages as $page)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
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
                        <p>Description: {{$page->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>

    </script>

</x-app-layout>
