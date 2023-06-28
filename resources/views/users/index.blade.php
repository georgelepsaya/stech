<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('viewAny', 'App\Models\Contributor')
                <a href="{{ route('requests.contributors') }}" class="rounded-md bg-gray-500 hover:bg-gray-400 text-gray-900 px-3 text-md edit-button">Check requests</a>
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
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('users.show', ['id' => $user->id]) }}" class="font-bold {{ ($user->blocked)? 'text-gray-600 dark:text-gray-400' : '' }}">
                                {{ $user->name }}
                            </a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
