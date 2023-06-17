<x-app-layout>
    <x-slot name="header">
        <div class="relative flex items-center">
            @if($productPage->logo_path)
                <img class="w-14 rounded-md" src="{{ asset('storage/' . $productPage->logo_path) }}" alt="Product Logo">
            @else
                <img class="w-14 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
            @endif
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-6">
                {{$productPage->name}}
            </h2>
            {{-- Buttons for manipulationg pages --}}
            <form class="absolute right-0 top-0" action="{{ route('pages.delete_product', ['id' => $productPage->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('delete')
                <a class="rounded-md bg-gray-500 hover:bg-yellow-500 text-gray-900 px-3 text-2xl" href="{{ route('pages.edit_product', $productPage->id) }}">EDIT</a>
                <input type="submit" name="delete" class="rounded-md bg-gray-500 hover:bg-red-500 text-gray-900 px-3 text-2xl ml-6" value="DELETE">
            </form> 
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>Description: {{$productPage->description}}</li>
                    <li>Released in {{date('M Y', strtotime($productPage->release_date))}}</li>
                </ul>
            </div>
            @if(count($productPage->company()->get()) != 0)
                <div class="px-4 pt-4 pb-2 mt-3 dark:bg-gray-800 sm:rounded-lg">
                    <p class="font-semibold mb-3">Company</p>
                    <ul>
                        @foreach($productPage->company()->get() as $company)
                            <li class="flex items-center pb-4">
                                @if($company->logo_path)
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/' . $company->logo_path) }}" alt="Company logo">
                                @else
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                                @endif
                                <a class="ml-2" href="{{route('pages.show_company', ['id' => $company->id])}}">{{$company->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $productPage->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
