<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Feed') }}
            </h2>
            @can('create', 'App\Models\Article')
                <div class="relative inline-block text-left group">
                    <a href="{{ route('feed.create_article') }}" class="text-gray-400 font-medium hover:text-gray-200 cursor-pointer transition-colors duration-200 focus:outline-none">Create new article</a>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-5 p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->blocked)
                    <div class="text-xl text-gray-900 dark:text-red-400">{{ __("Your account has been suspended") }}</div>
                @else
                    <div class="text-xl text-gray-900 dark:text-gray-400">{{ __("Welcome, " . auth()->user()->name) . "!" }}</div>
                @endif
        </div>
    </div>

    <div class="pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('feed.index') }}" method="GET">
                    <label class="dark:text-gray-200 text-gray-800 text-lg text-bold" for="search-articles">
                        Search
                    </label>
                    <div class="flex mt-3 items-center">
                        <input class="dark:text-gray-200 text-gray-700 w-full dark:bg-gray-700 px-4 py-2 border dark:border-gray-800 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an Article" id="search-articles" />
                        <button class="flex items-center ml-2 px-3 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($articles as $article)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 text-gray-800">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('feed.show_article', ['id' => $article->id]) }}" class="font-bold">{{ $article->title }}</a>
                            <span class="text-gray-400 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                                by <a href="{{ route('users.show', ['id' => $article->author()->get()[0]->id]) }}" class="ml-1 text-gray-400 font-bold hover:text-blue-500">{{ $article->author()->get()[0]->name . (($article->author()->get()[0]->blocked)? ' [blocked]' : '') }}</a></span>
                        </h4>
                        <p class="text-sm dark:text-gray-400 text-gray-400 mb-2">{{ $article->created_at->format('d.m.y - H:i:s')}}</p>
                        <p>{{ $article->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
