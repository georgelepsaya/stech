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
                @if($topicPage->logo_path)
                    <img class="w-14 rounded-md" src="{{ asset('storage/' . $topicPage->logo_path) }}" alt="Topic Image">
                @else
                    <img class="w-14 rounded-md" src="{{ asset('storage/images/no-logo.svg') }}" alt="No logo">
                @endif
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-6">
                    {{ $topicPage->name }}
                </h2>
            </div>
            {{-- Buttons for manipulationg pages --}}
            @if(!$topicPage->isContributor(auth()->user()->id))
                <form class="flex items-center" action="{{ route('requests.store_contributor') }}" method="post" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <input type="submit" name="store" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="Contribute">
                    <input type="hidden" name="user_id" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="page_id" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="{{ $topicPage->id }}">
                    <input type="hidden" name="page_type" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="3">
                </form>
            @else
                <div>
                    contribution is active
                </div>
            @endif
            <form class="flex items-center" action="{{ route('pages.delete_topic', ['id' => $topicPage->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('delete')
                <div class="button-group">
                    <a class="rounded-md bg-gray-500 text-gray-900 px-3 text-md edit-button" href="{{ route('pages.edit_topic', $topicPage->id) }}">Edit Page</a>
                    <input type="submit" name="delete" class="cursor-pointer rounded-md bg-gray-500 text-gray-900 px-3 text-md delete-button" value="Delete Page">
                </div>
            </form>
        </div>
        <div class="mt-5">
            Tags:
            @foreach($topicPage->tags()->get() as $tag)
                <span class="inline-block text-gray-200 bg-gray-800 px-2 py-1 m-1 text-sm font-semibold rounded-full cursor-pointer hover:bg-gray-700 transition-colors duration-200 border border-gray-600">
                    {{$tag->title}}
                </span>
            @endforeach
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>Description: {{$topicPage->description}}</li>
                </ul>
            </div>
            <div class="p-4 mt-3 dark:bg-gray-800 sm:rounded-lg">
                <div class="content-from-ql-editor">
                    {!! $topicPage->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
