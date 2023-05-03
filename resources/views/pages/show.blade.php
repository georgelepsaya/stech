<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$page->name}}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <ul class="text-gray-200">
                    <li>Description: {{$page->description}}</li>
                    <li>Website: {{$page->website}}</li>
                    <li>Industry: {{$page->industry}}</li>
                    <li>Founded in {{date('M Y', strtotime($page->founding_date))}}</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
