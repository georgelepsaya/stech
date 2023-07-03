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
            <x-search hint="{{ __('feed.search') }}"/>
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
