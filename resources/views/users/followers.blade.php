<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Followers of {{$name}}
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5">
                @foreach($followers as $follower)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('users.show', ['id' => $follower->id]) }}" class="font-bold {{ ($follower->blocked)? 'text-gray-600 dark:text-gray-400' : '' }}">
                                {{ $follower->name }} <span class="{{ ($follower->blocked)? 'text-gray-600' : 'text-blue-500' }}">{{ $follower->email }}</span>
                            </a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
