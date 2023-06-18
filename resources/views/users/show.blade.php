<x-app-layout>
    <x-slot name="header">
        <div class="relative flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $user->name }} <span class="text-gray-500">{{ $user->email }}<span>
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- article header --}}
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('users.show', ['id' => $user->id]) }}" method="GET">
                    <label class="text-gray-200 text-xl text-bold" for="search-articles">{{ $user->name }}&apos;s articles</label>
                    <div class="pt-4 flex items-center">
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
                            <span class="text-gray-400">by <a href="" class="text-gray-400 font-bold hover:text-blue-500">{{ $user->name }}</a></span> 
                        </h4>
                        <p>Description: {{ $article->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
