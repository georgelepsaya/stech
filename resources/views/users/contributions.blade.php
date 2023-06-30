<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pages <a href="{{route('users.show', ['id' => $user->id])}}">{{$user->name}}</a> contributes to
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(count($user->companyPages) > 0)
                <h1 class="text-gray-800 dark:text-gray-200 text-lg font-medium mb-2">Company Pages</h1>
                <div class="grid grid-cols-1 gap-5">
                    @foreach($user->companyPages as $page)
                        <div class="flex items-center p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-800 dark:text-gray-200">
                            @if($page->logo_path)
                                <img class="w-10 rounded-md" src="{{ asset('storage/' . $page->logo_path) }}" alt="Company Logo">
                            @else
                                <img class="w-10 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                            @endif
                            <h4 class="ml-3 flex flex-row justify-between text-lg font-medium">
                                <a href="{{ route('pages.show_company', ['id' => $page->id]) }}" class="font-bold">
                                    {{ $page->name }}
                                </a>
                            </h4>
                        </div>
                    @endforeach
                </div>
            @endif
            @if(count($user->productPages) > 0)
                    <h1 class="mt-4 text-gray-800 dark:text-gray-200 text-lg font-medium mb-2">Product Pages</h1>
                    <div class="grid grid-cols-1 gap-5">
                        @foreach($user->productPages as $page)
                            <div class="flex items-center p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-800 dark:text-gray-200">
                                @if($page->logo_path)
                                    <img class="w-10 rounded-md" src="{{ asset('storage/' . $page->logo_path) }}" alt="Company Logo">
                                @else
                                    <img class="w-10 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                                @endif
                                <h4 class="ml-3 flex flex-row justify-between text-lg font-medium">
                                    <a href="{{ route('pages.show_product', ['id' => $page->id]) }}" class="font-bold">
                                        {{ $page->name }}
                                    </a>
                                </h4>
                            </div>
                        @endforeach
                    </div>
            @endif
                @if(count($user->topicPages) > 0)
                    <h1 class="mt-4 text-gray-800 dark:text-gray-200 text-lg font-medium mb-2">Topic Pages</h1>
                    <div class="grid grid-cols-1 gap-5">
                        @foreach($user->topicPages as $page)
                            <div class="flex items-center p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-800 dark:text-gray-200">
                                @if($page->logo_path)
                                    <img class="w-10 rounded-md" src="{{ asset('storage/' . $page->logo_path) }}" alt="Company Logo">
                                @else
                                    <img class="w-10 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                                @endif
                                <h4 class="ml-3 flex flex-row justify-between text-lg font-medium">
                                    <a href="{{ route('pages.show_topic', ['id' => $page->id]) }}" class="font-bold">
                                        {{ $page->name }}
                                    </a>
                                </h4>
                            </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </div>
</x-app-layout>
