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

        .edit-button, .delete-button {
            display: block;
            height: 30px;
            transition: all 150ms ease-in-out;
        }

        .edit-button {
            display: flex;
            align-items: center;
        }

        .delete-button:hover {
            background-color: #643f44;
        }

        .edit-button:hover {
            background-color: #3f4a5d;
        }

        .button-group {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-right: 20px;
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                @if($productPage->logo_path)
                    <img class="w-14 rounded-md" src="{{ asset('storage/' . $productPage->logo_path) }}" alt="{{__('general.logo')}}">
                @else
                    <img class="w-14 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="{{__('general.no_logo')}}">
                @endif
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-6">
                    {{$productPage->name}}
                </h2>
            </div>
            <!-- Contribution button -->
            @if($productPage->isContributor(auth()->user()->id))
                <div>
                    {{__('requests.contributor_mode')}}
                </div>
            @elseif($productPage->requestedContribution(auth()->user()->id))
                <div>
                    {{__('requests.contribution_request_sent')}}
                </div>
            @else
                @can('create', 'App\Models\Contributor')
                    <form class="flex items-center" action="{{ route('requests.store_contributor') }}" method="post" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <input type="submit" name="store" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('requests.contribute')}}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="page_id" value="{{ $productPage->id }}">
                        <input type="hidden" name="page_type" value="2">
                    </form>
                @endcan
            @endif
            <div class="flex items-center button-group">
                <!-- Bookmark button -->
                @can('bookmark', $productPage)
                    @if(!$productPage->isBookmarkedBy(auth()->user()->id))
                        <form action="{{ route('bookmarks.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $productPage->id }}">
                            <input type="hidden" name="target_type" value="2">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('general.bookmark')}}">
                        </form>
                    @else
                        <form action="{{ route('bookmarks.delete') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $productPage->id }}">
                            <input type="hidden" name="target_type" value="2">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('general.unbookmark')}}">
                        </form>
                    @endif
                @endcan
                <!-- Edit button --> 
                @can('update', $productPage)
                    <a class="rounded-md bg-gray-500 text-gray-900 px-3 text-md edit-button" href="{{ route('pages.edit_product', $productPage->id) }}">{{__('pages.edit')}}</a>
                @endcan
                <!-- Request delete button -->
                @if($productPage->approved > 0) <!-- If the page has been approved -->
                    @if(!$productPage->delete_requested)
                    @can('requestDeletion', $productPage)
                        <form action="{{ route('pages.product_delete_request') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $productPage->id }}">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('requests.delete_page')}}">
                        </form>
                    @endcan
                    @else
                        {{__('requests.delete_requested')}}
                    @endif
                @else
                    <form action="{{ route('pages.approve') }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $productPage->id }}">
                        <input type="hidden" name="approved" value="{{ $productPage->approved }}">
                        <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('requests.approve')}}">
                    </form>
                @endif
                <!-- Delete button -->
                @can('delete', 'App\Model\ProductPage')
                    <form action="{{ route('pages.delete_product', ['id' => $productPage->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{__('general.delete')}}">
                    </form>
                @endcan
            </div>
        </div>
        <div class="mt-5">
            {{__('general.tags')}}:
            @foreach($productPage->tags()->get() as $tag)
                <a href="{{route('pages.index', ['tags[]' => $tag->id, 'page_type' => 'all'])}}" class="inline-block text-gray-200 bg-gray-800 px-2 py-1 m-1 text-sm font-semibold rounded-full cursor-pointer hover:bg-gray-700 transition-colors duration-200 border border-gray-600">
                    {{$tag->title}}
                </a>
            @endforeach
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>{{__('general.description')}}: {{$productPage->description}}</li>
                    <li>{{__('pages.release')}} {{date('M Y', strtotime($productPage->release_date))}}</li>
                </ul>
            </div>
            @if(count($productPage->company()->get()) != 0)
                <div class="px-4 pt-4 pb-2 mt-3 dark:bg-gray-800 sm:rounded-lg">
                    <p class="font-semibold mb-3">{{__('pages.company')}}</p>
                    <ul>
                        @foreach($productPage->company()->get() as $company)
                            <li class="flex items-center pb-4">
                                @if($company->logo_path)
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/' . $company->logo_path) }}" alt="{{__('general.logo')}}">
                                @else
                                    <img class="w-6 rounded-md inline" src="{{ asset('storage/images/no-logo.svg') }}" alt="{{__('general.no_logo')}}">
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
