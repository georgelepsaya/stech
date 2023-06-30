<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contributors') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 dark:text-gray-200 text-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5">
                @foreach ($contributors as $user)
                    <a href="{{route('users.show', ['id' => $user->id])}}" class="bg-white dark:bg-gray-600 border dark:border-none border-gray-200 shadow-sm rounded-lg px-3 py-2 dark:text-gray-200 text-gray-800 flex items-center">
                        @if($user->profile_image_path)
                            <img class="w-14 rounded-3xl mr-3" src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Profile Image">
                        @else
                            <img class="w-14 rounded-3xl mr-3" src="{{ asset('storage/images/no-profile.png') }}" alt="No Profile Image">
                        @endif
                        <div>
                            <p class="text-lg font-semibold">{{$user->name}}</p>
                            <p>{{'@' . $user->username}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
