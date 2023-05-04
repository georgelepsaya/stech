<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a New Company Page') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="" method="post" class="flex flex-col max-w-6xl mx-auto">
                        <h3 class="text-xl font-semibold mb-4">General information</h3>
                        {{-- name of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="name">Name of the Company</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="name" name="name" type="text"
                            placeholder="Enter the name of the company"/>
                        </div>
                        {{-- description of the company --}}
                        <div class="flex flex-col mt-2">
                            <label class="mb-2" for="description">Description</label>
                            <textarea class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="description" name="description"
                            placeholder="Briefly write the description of the company"></textarea>
                        </div>
                        <div class="flex justify-between gap-6 mt-2">
                            {{-- website of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="website">Website</label>
                                <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="website" name="website" type="url"
                                placeholder="Company's Website"/>
                            </div>
                            {{-- industry of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="industry">Industry</label>
                                <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="industry" name="industry" type="text"
                                placeholder="Industry of the company"/>
                            </div>
                            {{-- founding date of the company --}}
                            <div class="flex flex-col w-full">
                                <label class="mb-2" for="founding_date">Founding Date</label>
                                <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="founding_date" name="founding_date" type="date"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- content of the company page --}}
            <div class="mt-5">
                <div class="bg-gray-800 border-gray-700" id="editor">
                    <p>Hello World!</p>
                    <p>Some initial <strong>bold</strong> text</p>
                    <p><br></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
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
                ['link', 'image', 'video'],                        // link, image and video
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
    </script>
</x-app-layout>
