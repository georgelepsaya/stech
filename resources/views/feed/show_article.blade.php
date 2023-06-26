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

        .rating_badge {
            min-width: 35px;
        }
    </style>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold mr-4 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{$article->title}} <span class="text-gray-500"> by <a href="{{ route('users.show', ['id' => $article->author()->get()[0]->id]) }}" class="text-gray-500 font-bold hover:text-blue-500">{{ $article->author()->get()[0]->name . (($article->author()->get()[0]->blocked)? ' [blocked]' : '') }}</a></span>
                </h2>
                <div class="flex items-center">
                    @if (count($reviews->toArray()) > 0)
                    <p class="mr-3 rating_badge h-8 flex items-center justify-center bg-blue-100 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded dark:bg-blue-200 dark:text-blue-800">
                        {{array_sum($reviews->pluck('rating')->toArray()) / count($reviews->toArray())}}
                    </p>
                    <span class="w-1 mr-3 h-1 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                    @endif
                    <a href="#reviews" class="text-md font-medium text-gray-900 underline hover:no-underline dark:text-white">
                        {{count($reviews->toArray())}} reviews
                    </a>
                </div>
            </div>
            <div class="flex items-center button-group">
                <!-- Bookmark button -->
                @can('bookmark', $article)
                    @if(!$article->isBookmarkedBy(auth()->user()->id))
                        <form action="{{ route('bookmarks.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $article->id }}">
                            <input type="hidden" name="target_type" value="4">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md edit-button" value="Bookmark">
                        </form>
                    @else
                        <form action="{{ route('bookmarks.delete') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="target_id" value="{{ $article->id }}">
                            <input type="hidden" name="target_type" value="4">
                            <input type="submit" name="submit" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="Unbookmark">
                        </form>
                    @endif
                @endcan
                <!-- Edit button --> 
                @can('update', $article)
                    <a class="rounded-md bg-gray-500 text-gray-900 px-3 text-md edit-button" href="{{ route('feed.edit_article', $article->id) }}">Edit Article</a>
                @endcan
                <!-- Delete button --> 
                @can('delete', $article)
                    <form action="{{ route('feed.delete_article', ['id' => $article->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                        @csrf
                        @method('delete')
                        <input type="submit" name="delete" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="Delete article">
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <p class="text-gray-200 text-lg">
                    {{$article->description}}
                </p>
            </div>
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $article->content !!}
                </div>
            </div>
            <div class="my-4 p-4 dark:bg-gray-800 sm:rounded-lg flex justify-between items-center">
                <h3 id="reviews" class="text-lg font-bold">Reviews - {{count($reviews->toArray())}}</h3>
                @can('review', $article)
                    <a href="{{ route('reviews.create', ['article_id' => $article->id]) }}" class="bg-gray-600 px-3 py-1 sm:rounded-lg hover:bg-gray-700">Write a Review</a>
                @endcan
            </div>
            @foreach($reviews as $review)
                <div class="mt-4 p-4 dark:bg-gray-800 sm:rounded-lg">
                    <div class="text-lg font-bold mb-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <a href="{{route('reviews.show', ['id' => $review->id])}}" class="mr-3">{{$review->title}}</a>
                            <svg aria-hidden="true" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-1 text-md font-bold text-gray-900 dark:text-white">{{$review->rating}}</p>
                            <span class="text-gray-400 ml-4">by {{$review->author()->first()->toArray()['name']}}</span>
                        </div>
                        <span class="text-sm text-gray-400">{{$review->created_at->format('m/d/Y H:i')}}</span>
                    </div>
                    <p>{!! $review->text !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
