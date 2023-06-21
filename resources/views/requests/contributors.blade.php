<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contribution requests') }}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($contributors as $contributor)
                    <div class="flex justify-between p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <h4 class="flex flex-row text-lg font-medium">
                            <a href="{{ route('users.show', ['id' => $contributor->user_id]) }}" class="mr-4 font-bold text-blue-500">
                                {{ $contributor->getUser()->name . ' ' . $contributor->getUser()->email }}
                            </a>
                            to
                            <a href="{{ route('users.show', ['id' => $contributor->user_id]) }}" class="ml-4 font-bold text-blue-500">
                                {{ $contributor->getPage()->name }}
                            </a>
                        </h4>
                        <form action="{{ route('requests.approve_contribution') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $contributor->id }}">
                            <input type="submit" name="submit" value="approve">
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</x-app-layout>