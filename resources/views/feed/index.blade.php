<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Feed') }}
            </h2>
            <div class="relative inline-block text-left group">
                <a href="{{ route('feed.create_article') }}" class="text-gray-400 font-medium hover:text-gray-200 cursor-pointer transition-colors duration-200 focus:outline-none">Create new article</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->blocked)
                    <div class="text-2xl text-gray-900 dark:text-red-400">{{ __("Your account has been suspended") }}</div>
                @else
                    <div class="text-2xl text-gray-900 dark:text-gray-400">{{ __("Welcome, " . auth()->user()->name) . "!" }}</div>
                @endif
        </div>
    </div>
    <div class="pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('feed.index') }}" method="GET">
                    <label class="text-gray-200 text-lg text-bold" for="search-articles">Search</label>
                    <div class="flex mt-3 items-center">
                        <input class="w-full dark:bg-gray-700 px-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an Article" id="search-articles" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($articles as $article)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('feed.show_article', ['id' => $article->id]) }}" class="font-bold">{{ $article->title }}</a>
                            <span class="text-gray-400">by <a href="{{ route('users.show', ['id' => $article->author()->get()[0]->id]) }}" class="text-gray-400 font-bold hover:text-blue-500">{{ $article->author()->get()[0]->name . (($article->author()->get()[0]->blocked)? ' [blocked]' : '') }}</a></span> 
                        </h4>
                        <p>Description: {{ $article->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
