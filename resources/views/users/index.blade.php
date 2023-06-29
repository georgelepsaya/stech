<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('viewAny', 'App\Models\Contributor')
                <a href="{{ route('requests.contributors') }}" class="flex items-center hover:bg-gray-50 border border-gray-200 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-3 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" />
                    </svg>
                    Contribution Requests
                </a>
            @endcan
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200">
                <form action="{{ route('users.index') }}" method="GET">
                    <label class="dark:text-gray-200 text-gray-800 text-lg text-bold" for="search-users">Search</label>
                    <div class="flex mt-3 items-center">
                        <input class="w-full dark:bg-gray-700 px-4 py-2 border dark:border-gray-800 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an User" id="search-users" />
                        <button class="flex items-center ml-2 px-3 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-4 gap-5 mt-5">
                @foreach($users as $user)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 text-gray-800">
                        <a href="{{route('users.show', ['id' => $user->id])}}" class="flex items-center mb-2">
                            @if($user->profile_image_path)
                                <img class="w-16 rounded-3xl mr-3" src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Profile Image">
                            @else
                                <img class="w-16 rounded-3xl mr-3" src="{{ asset('storage/images/no-profile.png') }}" alt="No Profile Image">
                            @endif
                                <div class="ml-2">
                                    <h2 class="font-semibold text-xl leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-800 dark:text-gray-200' }}">
                                        {{ $user->name . (($user->blocked)? ' [blocked]' : '') }}
                                    </h2>
                                    <h2 class="font-semibold text-md leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-500 dark:text-gray-200' }}">
                                        {{ '@' . $user->username }}
                                    </h2>
                                </div>
                        </a>
                        <div>
                            <div class="flex items-center my-2 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                                <span class="mr-2">Interests</span>
                            </div>
                            @foreach($user->tags()->pluck('title')->toArray() as $tag)
                                <p class="overflow-hidden overflow-ellipsis whitespace-nowrap my-2 shadow-sm dark:text-gray-200 dark:bg-gray-600 bg-white px-3 py-1 dark:border-none border border-gray-200 mr-3 rounded-full text-sm">{{$tag}}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
