<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bookmarks') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('bookmarks.index') }}" method="GET">
                    <label class="dark:text-gray-200 text-gray-800 text-lg text-bold" for="search-content">Bookmark search</label>
                    <div class="flex mt-3 items-center">
                        <input value="{{request()->input('search')}}" class="dark:text-gray-200 text-gray-800 w-full dark:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for a bookmark" id="search-content" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                    <label for="target_type" class="block mt-2 mb-2 dark:text-gray-200 text-gray-800 text-lg text-bold">What are we searching for?</label>
                    <select class="cursor-pointer block dark:bg-gray-700 shadow-sm rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600 dark:text-gray-200 text-gray-800" id="target_type" name="target_type">
                        <option value="all" {{ request()->input('page_type', 'all') === 'all' ? 'selected' : '' }}>All</option>
                        <option value="company" {{ request()->input('page_type', 'company') === 'company' ? 'selected' : '' }}>Company</option>
                        <option value="product" {{ request()->input('page_type', 'product') === 'product' ? 'selected' : '' }}>Product</option>
                        <option value="topic" {{ request()->input('page_type', 'topic') === 'topic' ? 'selected' : '' }}>Topic</option>
                        <option value="article" {{ request()->input('page_type', 'topic') === 'topic' ? 'selected' : '' }}>Article</option>
                    </select>
                </form>
            </div>
            <div class="grid grid-cols-2 gap-5 mt-5">
                @foreach($bookmarks as $bookmark)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 text-gray-800">
                        <div class="flex items-center mb-3">
                            @if($bookmark->getTarget()->logo_path)
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/' . $page->logo_path) }}" alt="Company Logo">
                            @else
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                            @endif
                            @switch($bookmark->target_type)
                                @case(1)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_company', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(2)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_product', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(3)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_topic', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(4)
                                    <h4 class="text-lg font-medium"><a href="{{route('feed.show_article', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->title}}</a></h4>
                                    @break
                                @default
                                    <h4>Unknown</h4>
                            @endswitch
                        </div>
                        <p>Description: {{$bookmark->getTarget()->description}}</p>
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
