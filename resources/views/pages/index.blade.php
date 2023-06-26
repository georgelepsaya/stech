<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pages') }}
            </h2>
            @can('is-admin')
            <a href="{{ route('requests.delete_index') }}" class="rounded-md bg-gray-500 hover:bg-gray-400 text-gray-900 px-3 text-md edit-button">Deletion requests</a>
            @endcan
            @can('is-admin')
            <a href="{{ route('requests.create_index') }}" class="rounded-md bg-gray-500 hover:bg-gray-400 text-gray-900 px-3 text-md edit-button">Creation requests</a>
            @endcan
            @can('can-create-page')
                <div class="relative inline-block text-left group">
                    <button class="text-gray-400 font-medium hover:text-gray-200 cursor-pointer transition-colors duration-200 focus:outline-none">
                        Create a new page
                    </button>
                    <div class="absolute dropdown-menu right-0 hidden mt-0 w-56 rounded-md shadow-lg bg-gray-700 text-gray-200 ring-1 ring-black ring-opacity-5 group-hover:block">
                        <a href="{{route('pages.create_company')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Company</a>
                        <a href="{{route('pages.create_product')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Product</a>
                        <a href="{{route('pages.create_topic')}}" class="block px-4 py-2 text-gray-400 text-sm hover:text-gray-100">Topic</a>
                    </div>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('pages.index') }}" method="GET">
                    <label class="text-gray-200 text-lg text-bold" for="search-pages">Search for pages</label>
                    <div class="flex mt-3 items-center">
                        <input value="{{request()->input('search')}}" class="w-full dark:bg-gray-700 px-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for a company/product/topic" id="search-pages" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                    <label for="page_type" class="block mt-2 mb-2 text-gray-200 text-lg text-bold">What are we searching for?</label>
                    <select class="cursor-pointer block bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="page_type" name="page_type">
                        <option value="all" {{ request()->input('page_type', 'all') === 'all' ? 'selected' : '' }}>All</option>
                        <option value="company" {{ request()->input('page_type', 'company') === 'company' ? 'selected' : '' }}>Company</option>
                        <option value="product" {{ request()->input('page_type', 'product') === 'product' ? 'selected' : '' }}>Product</option>
                        <option value="topic" {{ request()->input('page_type', 'topic') === 'topic' ? 'selected' : '' }}>Topic</option>
                    </select>
                    <div class="flex flex-col mt-4">
                        <div>
                            <p class="mb-2 inline">Filter Search with Tags</p>
                            <button id="show_tags_btn" class="bg-gray-700 w-40 inline rounded-md ml-3 hover:bg-gray-600">Show tags</button>
                        </div>
                        <ul id="tags_list" class="mt-4 grid grid-cols-5 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
            <div class="grid grid-cols-2 gap-5 mt-5">
                @foreach($pages as $page)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <div class="flex items-center mb-3">
                            @if($page->logo_path)
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/' . $page->logo_path) }}" alt="Company Logo">
                            @else
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
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
                        <p>Description: {{$page->description}}</p>
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
