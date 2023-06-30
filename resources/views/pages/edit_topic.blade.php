<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('pages.edit_title')}} '{{$topicPage->name}}'
            </h2>
            <button class="rounded-md mr-5 bg-gray-500 hover:bg-gray-400 text-gray-900 px-3" id="submit_btn">Update the page</button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="create_topic_page_form" action="{{ route('pages.update_topic') }}" method="post" class="flex flex-col max-w-6xl mx-auto" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h3 class="text-xl font-semibold mb-4">{{__('general.title')}}</h3>
                        {{-- image for the topic --}}
                        <p class="mb-2">{{__('pages.topic_logo')}}</p>
                        <div class="mb-4">
                            <span id="fileInputWrapper">
                                <input id="fileInput" class="hidden" type="file" name="topic_image" required/>
                                <label for="fileInput" class="w-36 text-center bg-gray-600 hover:bg-gray-700 transition-colors duration-150 text-white font-bold py-1 px-2 rounded cursor-pointer">
                                    {{__('pages.choose_file')}}
                                </label>
                                <span id="selectedFile" class="ml-2">{{__('pages.no_file')}}</span>
                            </span>
                            {{-- default image --}}
                            <label id="is_default_button" for="is_default" class="px-2 py-1 rounded cursor-pointer">{{__('pages.default_file')}}</label>
                            <input id="is_default" name="is_default" type="checkbox" class="hidden">
                        </div>
                        {{-- name of the topic --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="name">{{__('pages.topic_name')}}</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="name" name="name" type="text"
                                   placeholder="Enter the name of the topic" value="{{ $topicPage->name }}"/>
                        </div>
                        {{-- description of the topic --}}
                        <div class="flex flex-col mt-2">
                            <label class="mb-2" for="description">{{__('general.description')}}</label>
                            <textarea class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="description" name="description"
                                      placeholder="Briefly write the description of the topic">{{ $topicPage->description }}</textarea>
                        </div>
                        {{-- tags of the topic --}}
                        <div class="flex flex-col mt-2">
                            <div>
                                <p class="mb-2 inline">{{__('general.relevant_tags')}}</p>
                                <button id="show_tags_btn" class="bg-gray-700 w-40 inline rounded-md ml-3 hover:bg-gray-600">{{__('general.show_tags')}}</button>
                            </div>
                            <ul id="tags_list" class="mt-4 grid grid-cols-5 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach($tags as $tag)
                                    <li class="w-full">
                                        <div class="flex items-center pl-3">
                                            <input {{in_array($tag->title, $selectedTags) ? 'checked' : ''}} name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-list-{{$tag->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- hidden input for finding the element to update --}}
                        <input type="hidden" name="id" id="id" value="{{ $topicPage->id }}"/>
                        {{-- hidden input for content form quill editor --}}
                        <input type="hidden" name="content" id="content"/>
                    </form>
                </div>
            </div>
            {{-- content of the topic page --}}
            <div class="mt-5 p-6 bg-gray-800 border-gray-700 rounded-lg">
                <h1 class="text-lg font-semibold">{{__('general.toc')}}</h1>
                <div class="" id="toc">
                </div>
            </div>
            <div class="mt-5">
                <div class="bg-gray-800 border-gray-700" id="editor">
                    <h1>{{__('pages.dummy_h1')}}</h1>
                    <h2>{{__('pages.dummy_h2')}}</h2>
                    <p><br></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        // Default button functionality
        document.getElementById('is_default_button').addEventListener('click', function() {
            if(document.getElementById('is_default').checked) {
                document.getElementById('fileInputWrapper').style.display = 'inline';
                document.getElementById('is_default_button').style.borderWidth = '0px';
                console.log(document.getElementById('is_default_button').lastChild);
                document.getElementById('is_default_button').removeChild(document.getElementById('is_default_button').lastChild);
                document.getElementById('is_default_button').appendChild(document.createTextNode('is_default_button'));
            } else {
                document.getElementById('fileInputWrapper').style.display = 'none';
                document.getElementById('is_default_button').style.borderWidth = '0.1rem';
                console.log(document.getElementById('is_default_button').lastChild);
                document.getElementById('is_default_button').removeChild(document.getElementById('is_default_button').lastChild);
                document.getElementById('is_default_button').appendChild(document.createTextNode('set to custom'));
            }
        })

        // submit action
        document.getElementById('submit_btn').addEventListener('click', function() {
            document.getElementById('create_topic_page_form').submit();
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

        // load the existing content(the safer way)
        var delta = quill.clipboard.convert('{!! $topicPage->content !!}');
        quill.setContents(delta);

        // update hidden content input to store all HTML from the Quill editor
        document.getElementById('submit_btn').addEventListener('click', function(event) {
            var contentInput = document.getElementById('content');
            contentInput.value = quill.root.innerHTML;

            if (contentInput.value) {
                document.getElementById('create_topic_page_form').submit(); // Submit the form manually only if the content input has a value
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
