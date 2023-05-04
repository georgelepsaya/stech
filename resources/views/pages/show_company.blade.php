<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$companyPage->name}}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>Description: {{$companyPage->description}}</li>
                    <li>Website: {{$companyPage->website}}</li>
                    <li>Industry: {{$companyPage->industry}}</li>
                    <li>Founded in {{date('M Y', strtotime($companyPage->founding_date))}}</li>
                </ul>
            </div>
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <b>Products</b>
                <ul>
                    @foreach($companyPage->products()->get() as $product)
                        <li>{{$product->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
