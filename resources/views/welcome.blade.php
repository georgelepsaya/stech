<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="dark:bg-gray-900 bg-gray-100 text-white">
    <div class="container mx-auto lg:px-0">
        <nav class="px-8 py-4 dark:bg-gray-800 bg-white">
            <div class="flex justify-between items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                    <span class="dark:text-gray-200 text-gray-800 ml-4 text-lg font-bold">Stech</span>
                </div>
                <div class="space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/feed') }}" class="dark:text-gray-200 text-gray-800 hover:text-blue-400 transition-all">Feed</a>
                        @else
                            <a href="{{ route('login') }}" class="dark:text-gray-200 text-gray-800 hover:text-blue-400 transition-all">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="dark:text-gray-200 text-gray-800 hover:text-blue-400 transition-all">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <header class="px-8 py-16 dark:bg-gray-800 bg-white rounded-b-lg dark:text-gray-200 text-gray-800 shadow-sm">
            <h1 class="text-5xl font-bold">Discover the Tech World with Stech!</h1>
            <p class="mt-4 text-xl">Connect with tech enthusiasts, explore the latest tech products, contribute to topics you're passionate about.</p>
        </header>

        <main class="px-4 sm:px-0 mt-10 grid grid-cols-1 md:grid-cols-2 gap-6 dark:text-gray-200 text-gray-800">
            <div class="dark:bg-gray-800 bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-3xl font-bold">Tailored Tech Insights</h2>
                <p class="mt-4">Get curated content based on your interests. Stay updated with the latest in tech, bookmark articles, follow content creators, and contribute to pages.</p>
            </div>
            <div class="dark:bg-gray-800 bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-3xl font-bold">Engage & Collaborate</h2>
                <p class="mt-4">Find like-minded tech enthusiasts and collaborate on topics you're passionate about. Influence the content of Stech by contributing to pages and articles.</p>
            </div>
            <div class="dark:bg-gray-800 bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-3xl font-bold">Tailored Tech Insights</h2>
                <p class="mt-4">Get curated content based on your interests. Stay updated with the latest in tech, bookmark articles, follow content creators, and contribute to pages.</p>
            </div>
            <div class="dark:bg-gray-800 bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-3xl font-bold">Engage & Collaborate</h2>
                <p class="mt-4">Find like-minded tech enthusiasts and collaborate on topics you're passionate about. Influence the content of Stech by contributing to pages and articles.</p>
            </div>
        </main>
    </div>
    </body>
</html>
