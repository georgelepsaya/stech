@props(['tags','filterTags'])

<div class="flex flex-col mt-4">
    <div>
        <p class="mb-2 inline">{{__('general.tags_filter')}}</p>
        <button id="show_tags_btn" class="dark:bg-gray-700 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200">{{__('general.show_tags')}}</button>
    </div>
    <ul id="tags_list" class="mt-4 grid md:grid-cols-3 items-center w-full text-sm font-medium bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @foreach($tags as $tag)
            <li class="w-full">
                <div class="flex items-center pl-3">
                    <input {{in_array($tag->id, $filterTags) ? 'checked' : ''}} name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="checkbox-list-{{$tag->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>