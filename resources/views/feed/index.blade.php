@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('layout.feed') }}
            </h2>
            @can('create', 'App\Models\Article')
                <div class="relative inline-block text-left group">
                    <a href="{{ route('feed.create_article') }}" class="dark:text-gray-400 text-gray-500 hover:text-gray-700 font-medium dark:hover:text-gray-200 cursor-pointer transition-colors duration-200 focus:outline-none">{{__('feed.create_article_title')}}</a>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-5 p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->blocked)
                    <div class="text-xl text-gray-900 dark:text-red-400">{{ __('feed.suspended') }}</div>
                @else
                    <div class="text-xl text-gray-900 dark:text-gray-400">{{ __('feed.welcome').auth()->user()->name}}</div>
                @endif
        </div>
    </div>

    <div class="pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('feed.index') }}" method="GET">
                    <label class="dark:text-gray-200 text-gray-800 text-lg text-bold" for="search-articles">
                        {{ __('general.search') }}
                    </label>
                    <div class="flex mt-3 items-center">
                        <input class="dark:text-gray-200 text-gray-700 w-full dark:bg-gray-700 px-4 py-2 border dark:border-gray-800 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="{{ __('feed.search') }}" id="search-articles" />
                        <button class="flex items-center ml-2 px-3 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            {{ __('general.search') }}
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
                                @if($article->author()->get()[0]->profile_image_path)
                                    <img class="w-8 rounded-3xl mr-1" src="{{ asset('storage/' . $article->author()->get()[0]->profile_image_path) }}" alt="Profile Image">
                                @else
                                    <img class="w-8 rounded-3xl mr-1" src="{{ asset('storage/images/no-profile.png') }}" alt="No Profile Image">
                                @endif
                                <a href="{{ route('users.show', ['id' => $article->author()->get()[0]->id]) }}" class="ml-1 text-gray-400 font-bold hover:text-blue-500">{{ $article->author()->get()[0]->name . (($article->author()->get()[0]->blocked)? ' [blocked]' : '') }}</a></span>
                        </h4>
                        @php
                            $date = Carbon::parse($article->created_at)->timezone('Europe/Riga');
                        @endphp
                        <p class="text-sm dark:text-gray-400 text-gray-400 mb-2">{{ $date }}</p>
                        <p class="mb-2">{{ $article->description }}</p>
                        @foreach($article->tags as $tag)
                            <span class="dark:text-gray-200 dark:bg-gray-600 bg-white px-3 py-1 dark:border-none border border-gray-200 mr-1 rounded-full text-sm">{{$tag->title}}</span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
