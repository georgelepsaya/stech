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
        <div class="relative flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{$article->title}} <span class="text-gray-500"> by <a href="{{ route('users.show', ['id' => $article->author()->get()[0]->id]) }}" class="text-gray-500 font-bold hover:text-blue-500">{{ $article->author()->get()[0]->name . (($article->author()->get()[0]->blocked)? ' [blocked]' : '') }}</a></span>
            </h2>
            {{-- Buttons for manipulationg articles --}}
            <form class="absolute right-0 top-0" action="{{ route('feed.delete_article', ['id' => $article->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('delete')
                <a class="rounded-md bg-gray-500 hover:bg-yellow-500 text-gray-900 px-3 text-2xl" href="{{ route('feed.edit_article', $article->id) }}">EDIT</a>
                <input type="submit" name="delete" class="rounded-md bg-gray-500 hover:bg-red-500 text-gray-900 px-3 text-2xl ml-6" value="DELETE">
            </form>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>Description: {{$article->description}}</li>
                </ul>
            </div>
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $article->content !!}
                </div>
            </div>
            <div class="mt-4 p-4 dark:bg-gray-800 sm:rounded-lg flex justify-between items-center">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <p class="ml-2 text-lg font-bold text-gray-900 dark:text-white">
                        {{array_sum($reviews->pluck('rating')->toArray()) / count($reviews->toArray())}}
                    </p>
                    <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                    <a href="#" class="text-md font-medium text-gray-900 underline hover:no-underline dark:text-white">
                        {{count($reviews->toArray())}} reviews
                    </a>
                </div>
            </div>
            @foreach($reviews as $review)
                <div class="mt-4 p-4 dark:bg-gray-800 sm:rounded-lg">
                    <div class="text-lg font-bold mb-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <h3 class="mr-3">{{$review->title}}</h3>
                            <svg aria-hidden="true" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-1 text-md font-bold text-gray-900 dark:text-white">
                                {{$review->rating}}
                            </p>
                            <span class="text-gray-400 ml-4">by {{$review->author()->first()->toArray()['name']}}</span>
                        </div>
                        <span class="text-sm text-gray-400">{{$review->created_at->format('m/d/Y H:i:s')}}</span>
                    </div>
                    <p>{!! $review->text !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
