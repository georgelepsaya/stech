<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="color-scheme: dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <style>
            /* quill-dark-theme.css */
            .ql-container {
                background-color: #111827; /* Your preferred background color */
            }

            .ql-container.ql-snow {
                border: 1px solid #2e3546;
                border-radius: 0 0 7px 7px;
            }

            .ql-toolbar.ql-snow {
                border: 1px solid #2e3546;
                border-radius: 7px 7px 0 0;
            }

            .ql-editor {
                color: #ccc; /* Your preferred text color */
                font-size: 16px;
            }

            .ql-snow .ql-stroke {
                stroke: #ccc; /* Your preferred toolbar icon color */
            }

            .ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill {
                fill: #ccc; /* Your preferred toolbar icon fill color */
            }

            .ql-snow .ql-picker-label {
                color: #ccc; /* Your preferred toolbar dropdown label color */
            }

            .ql-snow .ql-picker-options {
                background-color: #333; /* Your preferred toolbar dropdown options background color */
                color: #ccc; /* Your preferred toolbar dropdown options color */
            }

            .ql-snow .ql-picker.ql-expanded .ql-picker-label {
                color: #ccc; /* Your preferred toolbar dropdown label color when expanded */
            }

            .ql-snow .ql-picker.ql-expanded .ql-picker-options {
                background-color: #333; /* Your preferred toolbar dropdown options background color when expanded */
            }

            .ql-snow .ql-tooltip {
                background-color: #333; /* Your preferred tooltip background color */
                border-color: #333; /* Your preferred tooltip border color */
                color: #ccc; /* Your preferred tooltip color */
            }

        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
