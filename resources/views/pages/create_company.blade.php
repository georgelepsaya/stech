<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('pages.create_company') }}
            </h2>
            <button class="dark:bg-gray-700 bg-white dark:text-gray-200 text-gray-800 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200" id="submit_btn">{{ __('pages.create') }}</button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="create_company_page_form" action="{{action([\App\Http\Controllers\PageController::class, 'storeCompany'])}}" method="post" class="flex flex-col max-w-6xl mx-auto" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-xl font-semibold mb-4">{{__('general.title')}}</h3>
                        {{-- logo of the company --}}
                        <p class="mb-2">{{__('pages.company_logo')}}</p>
                        <div class="mb-4 flex items-center">
                            <input id="fileInput" class="hidden" type="file" name="company_logo" required/>
                            <label for="fileInput" class="cursor-pointer w-fit flex items-center hover:bg-gray-50 border border-gray-200 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-3 text-sm">
                                {{__('pages.choose_file')}}
                            </label>
                            <span id="selectedFile" class="ml-2">{{__('pages.no_file')}}</span>
                        </div>
                        {{-- name of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="name">{{__('pages.company_name')}}</label>
                            <input class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="name" name="name" type="text"
                            placeholder="{{__('pages.company_name_hint')}}"/>
                        </div>
                        {{-- description of the company --}}
                        <div class="flex flex-col mt-2">
                            <label class="mb-2" for="description">{{__('general.description')}}</label>
                            <textarea class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="description" name="description"
                            placeholder="{{__('pages.company_description_hint')}}"></textarea>
                        </div>
                        <div class="flex justify-between gap-6 mt-2">
                            {{-- website of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="website">{{__('pages.website')}}</label>
                                <input class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="website" name="website" type="url"
                                placeholder="{{__('pages.website_hint')}}"/>
                            </div>
                            {{-- industry of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="industry">{{__('pages.industry')}}</label>
                                <input class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="industry" name="industry" type="text"
                                placeholder="{{__('pages.industry_hint')}}"/>
                            </div>
                            {{-- founding date of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="founding_date">{{__('pages.founding_date')}}</label>
                                <input class="mb-3 dark:bg-gray-700 bg-white rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="founding_date" name="founding_date" type="date"/>
                            </div>
                        </div>
                        {{-- tags of the company --}}
                        <div class="flex flex-col mt-2">
                            <div>
                                <p class="mb-2 inline">{{__('general.relevant_tags')}}</p>
                                <button id="show_tags_btn" class="dark:bg-gray-700 w-40 inline rounded-md ml-3 hover:bg-gray-50 shadow-sm border border-gray-200">{{__('general.show_tags')}}</button>
                            </div>
                            <ul id="tags_list" class="mt-4 grid grid-cols-3 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($tags as $tag)
                                    <li class="w-full">
                                        <div class="flex items-center pl-3">
                                            <input name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-list-{{$tag->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- hidden input for content form quill editor --}}
                        <input type="hidden" name="content" id="content"/>
                    </form>
                </div>
            </div>
            {{-- content of the company page --}}
            <div class="mt-5 p-6 dark:bg-gray-800 bg-white dark:text-gray-200 text-gray-800 rounded-lg">
                <h1 class="text-lg font-semibold">{{__('general.toc')}}</h1>
                <div class="" id="toc">
                </div>
            </div>
            <div class="mt-5">
                <div class="dark:border-gray-700 border-gray-300 bg-white dark:bg-gray-800 dark:text-gray-200 text-gray-800" id="editor">
                    <h1>{{__('pages.dummy_h1')}}</h1>
                    <h2>{{__('pages.dummy_h2')}}</h2>
                    <p><br></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        // submit action
        document.getElementById('submit_btn').addEventListener('click', function() {
            document.getElementById('create_company_page_form').submit();
        });

        // custom file upload
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileLabel = document.getElementById('selectedFile');
            if (this.files.length > 0) {
                fileLabel.textContent = this.files[0].name;
            } else {
                fileLabel.textContent = 'No file chosen';
            }
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
                document.getElementById('create_company_page_form').submit(); // Submit the form manually only if the content input has a value
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

        quill.on('text-change', () => {
            createTOC();
        });

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
