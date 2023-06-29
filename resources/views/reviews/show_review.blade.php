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
    </style>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h3 class="mr-3 text-gray-800 dark:text-gray-200 font-medium text-lg">{{$review->title}}</h3>
                <svg aria-hidden="true" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <p class="ml-1 text-md font-bold text-gray-900 dark:text-white">{{$review->rating}}</p>
                <span class="text-gray-400 ml-4">by {{$review->author()->first()->toArray()['name']}}</span>
            </div>
            {{-- Buttons for manipulationg review --}}
            <div class="flex items-center">
                @can('update', $review)
                    <a class="text-center dark:bg-gray-700 bg-white dark:text-gray-200 text-gray-800 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200" href="{{ route('reviews.edit', $review->id) }}">Edit Review</a>
                @endcan
                @can('delete', $review)
                    <form action="{{ route('reviews.delete', ['id' => $review->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                        @csrf
                        @method('delete')
                        <input type="submit" name="delete" class="dark:bg-gray-700 bg-white dark:text-gray-200 text-gray-800 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200" value="Delete Review">
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4 p-4 dark:bg-gray-800 bg-white shadow-sm dark:text-gray-200 text-gray-800 sm:rounded-lg">
            <div class="text-lg font-bold mb-2 flex items-center justify-between">
                <span class="text-sm text-gray-400">{{$review->created_at->format('m/d/Y H:i')}}</span>
            </div>
            <div class="content-from-ql-editor">{!! $review->text !!}</div>
        </div>
    </div>
</x-app-layout>
