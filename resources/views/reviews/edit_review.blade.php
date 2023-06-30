<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('reviews.edit_title') }}
            </h2>
            <button class="dark:bg-gray-700 bg-white dark:text-gray-200 text-gray-800 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200" id="submit_btn">{{__('reviews.update')}}</button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="update_review_form" action="{{ route('reviews.update', ['id' => $review->id]) }}" method="post" class="flex flex-col max-w-6xl mx-auto" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h3 class="text-xl font-semibold mb-4">{{__('general.title')}}</h3>
                        {{-- title of the review --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="title">{{__('reviews.title')}}</label>
                            <input class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="title" name="title" type="text"
                                   placeholder="Enter the title of the review" value="{{ $review->title }}"/>
                        </div>
                        {{-- rating --}}
                        <div>
                            <label for="minmax-range" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">{{__('reviews.rating')}} - <span id="slider-value" class="text-gray-900 dark:text-white">{{$review->rating}}</span></label>
                            <input name="rating" id="minmax-range" type="range" min="1" max="10" value="{{$review->rating}}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" oninput="updateValue(this.value)">
                        </div>
                        <input type="hidden" name="article_id" value="{{$review->article_id}}"/>
                        {{-- hidden input for content form quill editor --}}
                        <input type="hidden" name="text" id="content"/>
                    </form>
                </div>
            </div>
            <div class="mt-5">
                <div class="dark:border-gray-700 border-gray-300 bg-white dark:bg-gray-800 dark:text-gray-200 text-gray-800" id="editor">
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        // submit action
        document.getElementById('submit_btn').addEventListener('click', function() {
            document.getElementById('update_review_form').submit();
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

        // load the existing content(the safer way)
        var delta = quill.clipboard.convert({!! json_encode($review->text) !!});
        quill.setContents(delta);

        // update hidden content input to update all HTML of Quill editor
        document.getElementById('submit_btn').addEventListener('click', function(event) {
            var contentInput = document.getElementById('content');
            contentInput.value = quill.root.innerHTML;

            if (contentInput.value) {
                document.getElementById('update_review_form').submit(); // Submit the form manually only if the content input has a value
            } else {
                event.preventDefault(); // Prevent the default form submission when the content is empty
                alert('Content is empty. Please ensure you have entered content in the editor.');
            }
        });


        function createTOC() {
            const quillContent = document.querySelector('.ql-editor').innerHTML;
            const parser = new DOMParser();
            const quillDOM = parser.parseFromString(quillContent, 'text/html');
            const headers = quillDOM.querySelectorAll('h1, h2, h3, h4, h5, h6');
            const tocContainer = document.getElementById('toc');
            tocContainer.innerHTML = '';

            headers.forEach((header, index) => {
                const headerLevel = parseInt(header.tagName[1]);
                const tocEntry = document.createElement('div');
                tocEntry.style.marginLeft = (headerLevel - 1) * 20 + 'px';
                tocEntry.textContent = header.textContent;
                tocEntry.addEventListener('click', () => {
                    const delta = quill.getContents().find((op) => op.insert && op.insert[header.tagName] && op.insert[header.tagName].header === header.textContent);
                    if (delta) {
                        quill.setSelection(delta, 0, 'silent');
                    }
                });
                tocContainer.appendChild(tocEntry);
            });
        }

        // Call the createTOC function after Quill has been initialized
        createTOC();

        // Optionally, you can call the createTOC function whenever the Quill content changes
        quill.on('text-change', () => {
            createTOC();
        });

        function updateValue(val) {
            document.getElementById('slider-value').textContent = val;
        }
    </script>
</x-app-layout>
