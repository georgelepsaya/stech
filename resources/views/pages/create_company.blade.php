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
                        {{-- name of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="name">Name of the Company</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="name" name="name" type="text"
                            placeholder="Enter the name of the company"/>
                        </div>
                        {{-- description of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="description">Description</label>
                            <textarea class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="description" name="description"
                            placeholder="Briefly write the description of the company"></textarea>
                        </div>
                        {{-- website of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="website">Website</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="website" name="website" type="url"
                            placeholder="Company's Website"/>
                        </div>
                        {{-- industry of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="industry">Industry</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="industry" name="industry" type="text"
                            placeholder="Industry of the company"/>
                        </div>
                        {{-- founding date of the company --}}
                        <div class="flex flex-col">
                            <label class="mb-2" for="founding_date">Founding Date</label>
                            <input class="mb-3 bg-gray-700 rounded-md border border-gray-600 focus:ring-0 focus:outline-none focus:border-gray-600" id="founding_date" name="founding_date" type="date"/>
                        </div>
                    </form>
                </div>
            </div>
            {{-- content of the company page --}}
            <div class="bg-gray-800 border-gray-700" id="editor">
                <p>Hello World!</p>
                <p>Some initial <strong>bold</strong> text</p>
                <p><br></p>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            modules: {
                toolbar: [
                    ['image', 'code-block']
                ]
            },
            theme: 'snow'
        });
    </script>
</x-app-layout>
