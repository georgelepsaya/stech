<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('requests.creation')}}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-5 mt-5">
                @foreach($pages as $page)
                    <div class="flex justify-between p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">        
                        <li class="flex bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200 text-lg">
                            @if($page->logo_path)
                                <img class="w-6 rounded-md inline" src="{{ asset('storage/' . $page->logo_path) }}" alt="{{__('general.logo')}}">
                            @else
                                <img class="w-6 rounded-md inline" src="{{ asset('storage/images/no-logo.svg') }}" alt="{{__('general.no_logo')}}">
                            @endif
                            <form action="{{ route('pages.show') }}" class="ml-2">
                            <input type="hidden" name="id" value="{{ $page->id }}">
                                <input type="hidden" name="approved" value="{{ $page->approved }}">
                                <input type="submit" name="submit" value="{{ $page->name }}">
                            </form>
                        </li>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</x-app-layout>