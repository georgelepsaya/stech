<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('layout.bookmarks') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-search action="{{ route('bookmarks.index') }}" title="{{__('bookmarks.search')}}" hint="{{__('bookmarks.search_hint')}}">
                <x-content-filter :types="[
                    'all' => __('pages.all'),
                    'company' => __('pages.company'),
                    'product' => __('pages.product'),
                    'topic' => __('pages.topic'),
                    'article' => __('feed.article')
                ]"/>
                <x-tag-filter :tags="$tags" :filterTags="$filterTags"/>
            </x-search>
            <div class="grid grid-cols-2 gap-5 mt-5">
                @foreach($bookmarks as $bookmark)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 text-gray-800">
                        <div class="flex items-center mb-3">
                            @if($bookmark->getTarget()->logo_path)
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/' . $bookmark->getTarget()->logo_path) }}" alt="{{__('general.logo')}}">
                            @else
                                <img class="w-12 rounded-md mr-4" src="{{ asset('storage/images/no-logo.svg') }}" alt="{{__('general.no_logo')}}">
                            @endif
                            @switch($bookmark->target_type)
                                @case(1)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_company', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(2)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_product', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(3)
                                    <h4 class="text-lg font-medium"><a href="{{route('pages.show_topic', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->name}}</a></h4>
                                    @break
                                @case(4)
                                    <h4 class="text-lg font-medium"><a href="{{route('feed.show_article', ['id' => $bookmark->getTarget()->id])}}">{{$bookmark->getTarget()->title}}</a></h4>
                                    @break
                                @default
                                    <h4>Unknown</h4>
                            @endswitch
                        </div>
                        <p>{{__('general.description')}}: {{$bookmark->getTarget()->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', (event) => {
            const showTagsBtn = document.getElementById('show_tags_btn');
            const tagsList = document.getElementById('tags_list');

            showTagsBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // If the list is not displayed, show it and update the button text
                if (tagsList.style.display === 'none') {
                    tagsList.style.display = 'grid';
                    showTagsBtn.textContent = 'Hide tags';
                }
                // If the list is displayed, hide it and update the button text
                else {
                    tagsList.style.display = 'none';
                    showTagsBtn.textContent = 'Show tags';
                }
            });

            // Initially hide the tags list
            tagsList.style.display = 'none';
            showTagsBtn.textContent = 'Show tags';
        });

    </script>

</x-app-layout>
