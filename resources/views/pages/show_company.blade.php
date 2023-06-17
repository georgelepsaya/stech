<x-app-layout>
    <style>
        .content-from-ql-editor {
            color: #c0cde3;
        }

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

        .content-from-ql-editor ul {
            list-style: inside;
            padding-left: 20px;
        }

    </style>

    <x-slot name="header">
        <div class="flex items-center">
            @if($companyPage->logo_path)
                <img class="w-14 rounded-md" src="{{ asset('storage/' . $companyPage->logo_path) }}" alt="Company Logo">
            @else
                <img class="w-14 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
            @endif
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-6">
                {{$companyPage->name}}
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200" style="color: #c0cde3;">
                    <li class="py-2"><b>Description:</b> {{$companyPage->description}}</li>
                    <li class="pb-2"><b>Website:</b> {{$companyPage->website}}</li>
                    <li class="pb-2"><b>Industry:</b> {{$companyPage->industry}}</li>
                    <li class="pb-2"><b>Founding Date:</b> {{date('M Y', strtotime($companyPage->founding_date))}}</li>
                </ul>
            </div>
            @if(count($companyPage->products()->get()) != 0)
                <div class="px-4 pt-4 pb-2 mt-3 dark:bg-gray-800 sm:rounded-lg">
                    <p class="font-semibold mb-3">Products</p>
                    <ul>
                        @foreach($companyPage->products()->get() as $product)
                            <li class="flex items-center pb-4">
                                @if($product->logo_path)
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/' . $product->logo_path) }}" alt="Company logo">
                                @else
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                                @endif
                                <a class="ml-2" href="{{route('pages.show_product', ['id' => $product->id])}}">{{$product->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $companyPage->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
