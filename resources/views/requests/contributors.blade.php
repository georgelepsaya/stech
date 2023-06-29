@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contribution requests') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-8 dark:text-gray-200 text-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($contributors as $contributor)
                    <div class="flex justify-between p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <h4 class="text-lg font-medium">
                            <a href="{{ route('users.show', ['id' => $contributor->user_id]) }}" class="mr-2 font-bold text-blue-500">
                                {{ $contributor->getUser()->name }}
                            </a>
                            to
                            <a href="{{ route('users.show', ['id' => $contributor->user_id]) }}" class="ml-2 font-bold text-blue-500">
                                {{ $contributor->getPage()->name }}
                            </a>
                            @php
                                $date = Carbon::parse($contributor->created_at)->timezone('Europe/Riga');
                            @endphp
                            <span class="ml-4 text-sm text-gray-400">{{$date->format('d.m.y - G:i:s')}}</span>
                        </h4>
                        <form action="{{ route('requests.approve_contribution') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $contributor->id }}">
                            <button type="submit" name="submit" class="flex items-center hover:bg-gray-50 border border-gray-200 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-3 text-sm">
                                Approve
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
