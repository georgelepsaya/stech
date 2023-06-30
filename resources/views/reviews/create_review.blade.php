<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('reviews.write')}}
            </h2>
            <button class="rounded-md mr-5 bg-gray-500 hover:bg-gray-400 text-gray-900 px-3" id="submit_btn">{{__('reviews.create')}}</button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="create_feed_page_form" action="{{ route('reviews.store') }}" method="post" class="flex flex-col max-w-6xl mx-auto" enctype="application/x-www-form-urlencoded">
                        @csrf
                        {{-- title of the review --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="title">{{__('reviews.title')}}</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="title" name="title" type="text"
                                   placeholder="{{__('reviews.prompt_article_title')}}"/>
                        </div>

                        {{-- rating --}}
                        <div>
                            <label for="minmax-range" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">{{__('reviews.rating')}} - <span id="slider-value" class="text-gray-900 dark:text-white">1</span></label>
                            <input name="rating" id="minmax-range" type="range" min="1" max="10" value="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" oninput="updateValue(this.value)">
                        </div>

                        <input type="hidden" name="article_id" value="{{$article_id}}"/>

                        {{-- hidden input for content form quill editor --}}
                        <input type="hidden" name="text" id="content"/>
                    </form>
                </div>
            </div>
            {{-- content of the review --}}
            <div class="mt-5">
                <div class="bg-gray-800 border-gray-700" id="editor">
                    <h1>{{__('general.write_here')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        // submit action
        document.getElementById('submit_btn').addEventListener('click', function() {
            document.getElementById('create_feed_page_form').submit();
        });

        var toolbarOptions = {
            container: [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean'],                                         // remove formatting button
                // ['link', 'image', 'video'],                        // link, image and video
            ],
            handlers: {
                // Add custom handlers here if needed
            }
        };

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: 'snow'
        });

        // update hidden content input to store all HTML from the Quill editor
        document.getElementById('submit_btn').addEventListener('click', function(event) {
            var contentInput = document.getElementById('content');
            contentInput.value = quill.root.innerHTML;

            if (contentInput.value) {
                document.getElementById('create_feed_page_form').submit(); // Submit the form manually only if the content input has a value
            } else {
                event.preventDefault(); // Prevent the default form submission when the content is empty
                alert('Content is empty. Please ensure you have entered content in the editor.');
            }
        });

        function updateValue(val) {
            document.getElementById('slider-value').textContent = val;
        }
    </script>
</x-app-layout>
