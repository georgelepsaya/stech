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
                    <form action="" method="post" class="flex flex-col">
                        {{-- name of the company --}}
                        <label for="name">Name of the Company</label>
                        <input id="name" name="name" type="text"/>
                        {{-- description of the company --}}
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                        {{-- website of the company --}}
                        <label for="website">Website</label>
                        <input id="website" name="website" type="text"/>
                        {{-- industry of the company --}}
                        <label for="industry">Industry</label>
                        <input id="industry" name="industry" type="text"/>
                        {{-- content of the company page --}}
                        <div id="editor">
                            <p>Hello World!</p>
                            <p>Some initial <strong>bold</strong> text</p>
                            <p><br></p>
                        </div>
                        {{-- founding date of the company --}}
                        <label for="founding_date">Founding Date</label>
                        <input id="founding_date" name="founding_date" type="date"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
</x-app-layout>
