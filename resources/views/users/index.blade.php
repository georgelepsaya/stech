<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('requests.contributors') }}" class="rounded-md bg-gray-500 hover:bg-gray-400 text-gray-900 px-3 text-md edit-button">Check requests</a>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('users.index') }}" method="GET">
                    <label class="text-gray-200 text-lg text-bold" for="search-users">Search</label>
                    <div class="flex mt-3 items-center">
                        <input class="w-full dark:bg-gray-700 px-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an User" id="search-users" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($users as $user)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('users.show', ['id' => $user->id]) }}" class="font-bold {{ ($user->blocked)? 'text-gray-600 dark:text-gray-400' : '' }}">
                                {{ $user->name }} <span class="{{ ($user->blocked)? 'text-gray-600' : 'text-blue-500' }}">{{ $user->email }}</span>
                            </a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>