<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-200 text-gray-800">
            <h2 class="font-semibold text-xl leading-tight">
                {{__('users.edit_interests')}}
            </h2>
            <button id="submit_btn" class="flex items-center hover:bg-gray-50 border border-gray-200 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-3 text-sm">
                {{__('general.save')}}
            </button>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800">
            <div class="flex flex-col mt-2">
                <p class="mb-2 inline font-semibold">{{__('users.select_interests')}} (3-5)</p>
                <form method="POST" id="update_interests_form" action="{{route('users.update_interests', ['id' => auth()->id()])}}">
                    @csrf
                    @method('put')
                    <ul id="tags_list" class="p-3 mt-4 grid md:grid-cols-3 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach($tags as $tag)
                            <li class="w-full">
                                <div class="flex items-center pl-3">
                                    <input {{in_array($tag->title, $selectedTags) ? 'checked' : ''}} name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-list-{{$tag->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submit_btn').addEventListener('click', function() {
            document.getElementById('update_interests_form').submit();
        });
    </script>
</x-app-layout>
