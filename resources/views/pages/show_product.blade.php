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
                    <img class="w-14 rounded-md" src="{{ asset('storage/' . $productPage->logo_path) }}" alt="Product Logo">
                @else
                    <img class="w-14 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                @endif
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-6">
                    {{$productPage->name}}
                </h2>
            </div>
            <div class="flex items-center button-group">
                <!-- Bookmark button -->
                @can('bookmark', $productPage)
                    @if(!$productPage->isBookmarkedBy(auth()->user()->id))
                        <form action="{{ route('bookmarks.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $productPage->id }}">
                            <input type="hidden" name="target_type" value="2">
                            <button type="submit" name="submit" class="flex items-center border border-gray-200 flex items-center hover:bg-gray-50 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                                Bookmark
                            </button>
                        </form>
                    @else
                        <form action="{{ route('bookmarks.delete') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $productPage->id }}">
                            <input type="hidden" name="target_type" value="2">
                            <button type="submit" name="submit" class="flex items-center border border-gray-200 flex items-center hover:bg-gray-50 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#ff7373" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff7373" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                                Unbookmark
                            </button>
                        </form>
                    @endif
                @endcan
                <!-- Contribution button -->
                @if($productPage->isContributor(auth()->user()->id))
                    <div class="dark:text-gray-200 text-gray-800">
                        contributor mode
                    </div>
                @elseif($productPage->requestedContribution(auth()->user()->id))
                    <div class="dark:text-gray-200 text-gray-800">
                        contribution request sent
                    </div>
                @else
                    @can('create', 'App\Models\Contributor')
                        <form class="flex items-center" action="{{ route('requests.store_contributor') }}" method="post" enctype="application/x-www-form-urlencoded">
                            @csrf
                            <button type="submit" name="store" class="flex items-center border border-gray-200 flex items-center hover:bg-gray-50 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                Contribute
                            </button>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="page_id" value="{{ $productPage->id }}">
                            <input type="hidden" name="page_type" value="2">
                        </form>
                    @endcan
                @endif
                <!-- Edit button -->
                @can('update', $productPage)
                    <a class="cursor-pointer hover:bg-gray-100 flex items-center border border-gray-200 flex items-center transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md" href="{{ route('pages.edit_product', $productPage->id) }}">Edit Page</a>
                @endcan
                <!-- Request delete button -->
                @if($productPage->approved > 0) <!-- If the page has been approved -->
                    @if(!$productPage->delete_requested)
                    @can('requestDeletion', $productPage)
                        <form action="{{ route('pages.product_delete_request') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $productPage->id }}">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="Request deletion">
                        </form>
                    @endcan
                    @else
                        <span class="dark:text-gray-200 text-gray-800">delete requested</span>
                    @endif
                @else
                    <form action="{{ route('pages.approve') }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $productPage->id }}">
                        <input type="hidden" name="approved" value="{{ $productPage->approved }}">
                        <input type="submit" name="submit" class="cursor-pointer hover:bg-gray-100 flex items-center border border-gray-200 flex items-center transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md" value="Approve">
                    </form>
                @endif
                <!-- Delete button -->
                @can('delete', 'App\Model\ProductPage')
                    <form action="{{ route('pages.delete_product', ['id' => $productPage->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" name="submit" class="cursor-pointer hover:bg-red-100 flex items-center border border-gray-200 flex items-center transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-2 text-md" value="Delete">
                    </form>
                @endcan
            </div>
        </div>
        <div class="mt-5 dark:text-gray-200 text-gray-800">
            Tags:
            @foreach($productPage->tags()->get() as $tag)
                <a href="{{route('pages.index', ['tags[]' => $tag->id, 'page_type' => 'all'])}}" class="inline-block text-gray-200 bg-gray-800 px-2 py-1 m-1 text-sm font-semibold rounded-full cursor-pointer hover:bg-gray-700 transition-colors duration-200 border border-gray-600">
                    {{$tag->title}}
                </a>
            @endforeach
        </div>
        <a class="text-gray-800 dark:text-gray-200" href="{{route('pages.product_contributors', ['id' => $productPage->id])}}">
            Contributors: {{$user_contributors}}
        </a>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-4 dark:bg-gray-800 bg-white overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 text-gray-800">
                <ul>
                    <li>Description: {{$productPage->description}}</li>
                    <li>Released in {{date('M Y', strtotime($productPage->release_date))}}</li>
                </ul>
            </div>
            @if(count($productPage->company()->get()) != 0)
                <div class="px-4 pt-4 pb-2 mt-3 dark:bg-gray-800 bg-white sm:rounded-lg dark:text-gray-200 text-gray-800">
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
            <div class="p-4 mt-3 dark:bg-gray-800 bg-white dark:text-gray-200 text-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $productPage->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
