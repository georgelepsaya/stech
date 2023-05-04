<x-app-layout>
    <style>
        .content-from-ql-editor h1 {
            font-size: 26px;
            font-weight: bolder;
            line-height: 2;
        }

        .content-from-ql-editor h2 {
            line-height: 1.7;
            font-weight: bolder;
            font-size: 24px;
        }

        .content-from-ql-editor h3 {
            line-height: 1.6;
            font-size: 20px;
        }

        .content-from-ql-editor p {
            font-size: 16px;
        }
    </style>

    <x-slot name="header">
        <img src="{{ asset('storage/' . $companyPage->logo_path) }}" alt="User's image">
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
            <div class="p-4 mt-3">
                <div class="content-from-ql-editor">
                    {!! $companyPage->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
