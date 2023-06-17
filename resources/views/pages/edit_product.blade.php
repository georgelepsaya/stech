<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('New Product editor') }}
            </h2>
            <button class="rounded-md mr-5 bg-gray-500 hover:bg-gray-400 text-gray-900 px-3" id="submit_btn">Edit the page</button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="create_product_page_form" action="{{ route('pages.update_product') }}" method="post" class="flex flex-col max-w-6xl mx-auto" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h3 class="text-xl font-semibold mb-4">General information</h3>
                        {{-- logo of the product --}}
                        <p class="mb-2">Logo of the product</p>
                        <div class="mb-4">
                            <span id="fileInputWrapper">
                                <input id="fileInput" class="hidden" type="file" name="product_logo" required/>
                                <label for="fileInput" class="w-36 text-center bg-gray-600 hover:bg-gray-700 transition-colors duration-150 text-white font-bold py-1 px-2 rounded cursor-pointer">
                                    Choose file
                                </label>
                                <span id="selectedFile" class="ml-2">No image chosen</span>
                            </span>
                            {{-- default logo --}}
                            <label id="is_default_button" for="is_default" class="px-2 py-1 rounded cursor-pointer">[set to default]</label>
                            <input id="is_default" name="is_default" type="checkbox" class="hidden">
                        </div>
                        {{-- name of the product --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="name">Name of the Product</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="name" name="name" type="text"
                                   placeholder="Enter the name of the product" value="{{ $productPage->name }}"/>
                        </div>
                        {{-- description of the product --}}
                        <div class="flex flex-col mt-2">
                            <label class="mb-2" for="description">Description</label>
                            <textarea class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="description" name="description"
                                      placeholder="Briefly write the description of the product">{{ $productPage->description }}</textarea>
                        </div>
                        {{-- company of the product --}}
                        <div class="flex flex-col mt-2">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600">
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" {{ ($company->id == $productPage->company_id)? "selected" : "" }}>
                                        {{$company->name}} - {{substr($company->founding_date, 0, 4)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-between gap-6 mt-2">
                            {{-- release date of the product --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="release_date">Release Date</label>
                                <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="release_date" name="release_date" type="date" value="{{ $productPage->release_date }}"/>
                            </div>
                        </div>
                        {{-- hidden input for finding the element to update --}}
                        <input type="hidden" name="id" id="id" value="{{ $productPage->id }}"/>
                        {{-- hidden input for content form quill editor --}}
                        <input type="hidden" name="content" id="content"/>
                    </form>
                </div>
            </div>
            {{-- content of the product page --}}
            <div class="mt-5 p-6 bg-gray-800 border-gray-700 rounded-lg">
                <h1 class="text-lg font-semibold">Table of contents</h1>
                <div class="" id="toc">
                </div>
            </div>
            <div class="mt-5">
                <div class="bg-gray-800 border-gray-700" id="editor">
                    <h1>Hello world</h1>
                    <h2>Heading 2</h2>
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
                document.getElementById('is_default_button').appendChild(document.createTextNode('[set to default]'));
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
            document.getElementById('create_product_page_form').submit();
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
        var delta = quill.clipboard.convert('{!! $productPage->content !!}');
        quill.setContents(delta);

        // update hidden content input to store all HTML from the Quill editor
        document.getElementById('submit_btn').addEventListener('click', function(event) {
            var contentInput = document.getElementById('content');
            contentInput.value = quill.root.innerHTML;

            if (contentInput.value) {
                document.getElementById('create_product_page_form').submit(); // Submit the form manually only if the content input has a value
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
    </script>
</x-app-layout>
