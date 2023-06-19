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
        </div>
    </div>
</x-app-layout>
