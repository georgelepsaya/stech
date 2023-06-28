<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-200 text-gray-800">
            <div>
                <h2 class="font-semibold text-xl leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-800 dark:text-gray-200' }}">
                    {{ $user->name . (($user->blocked)? ' [blocked]' : '') }}
                </h2>
                <p class="mt-3 text-md">
                    <a href="{{route('users.followers', ['id' => $user->id])}}" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 328 328" xml:space="preserve">
                            <g id="XMLID_496_">
                                <path id="XMLID_497_" d="M115,126.75c34.601,0,62.751-28.149,62.751-62.749C177.751,29.4,149.601,1.25,115,1.25   c-34.601,0-62.751,28.15-62.751,62.751C52.249,98.601,80.399,126.75,115,126.75z M115,31.25c18.059,0,32.751,14.692,32.751,32.751   c0,18.058-14.692,32.749-32.751,32.749c-18.059,0-32.751-14.691-32.751-32.749C82.249,45.942,96.941,31.25,115,31.25z"/>
                                <path id="XMLID_501_" d="M238.606,181.143c-5.858-5.857-15.356-5.857-21.213,0.001l-30,30.002   c-2.813,2.814-4.393,6.629-4.393,10.607c0,3.978,1.581,7.794,4.394,10.607l30,29.998c2.929,2.929,6.768,4.393,10.606,4.393   c3.839,0,7.678-1.465,10.607-4.394c5.858-5.858,5.857-15.356-0.001-21.213l-19.393-19.392l19.393-19.395   C244.465,196.498,244.464,187.001,238.606,181.143z"/>
                                <path id="XMLID_502_" d="M223,116.75c-34.488,0-65.144,16.716-84.297,42.47c-7.763-1.628-15.694-2.47-23.703-2.47   c-63.411,0-115,51.589-115,115c0,8.284,6.716,15,15,15h125.596c19.247,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105   S280.897,116.75,223,116.75z M31.325,256.75c7.106-39.739,41.923-70,83.675-70c2.966,0,5.914,0.165,8.841,0.467   c-3.779,10.82-5.841,22.44-5.841,34.533c0,12.268,2.122,24.047,6.006,35H31.325z M223,296.75c-41.355,0-75-33.645-75-75   s33.645-75,75-75s75,33.645,75,75S264.355,296.75,223,296.75z"/>
                            </g>
                        </svg>
                        Followers:
                        <span id="follow-count" class="ml-2">{{count($user->followers()->get()->toArray())}}</span>
                    </a>
                </p>
                <p class="mt-3 text-md">
                    <a href="{{route('users.following', ['id' => $user->id])}}" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 328 328" xml:space="preserve">
                            <g id="XMLID_486_">
                                <path id="XMLID_487_" d="M115,126.75c34.601,0,62.751-28.149,62.751-62.749C177.751,29.4,149.601,1.25,115,1.25   c-34.601,0-62.75,28.15-62.75,62.751C52.25,98.601,80.399,126.75,115,126.75z M115,31.25c18.059,0,32.751,14.692,32.751,32.751   c0,18.058-14.692,32.749-32.751,32.749c-18.059,0-32.75-14.691-32.75-32.749C82.25,45.942,96.941,31.25,115,31.25z"/>
                                <path id="XMLID_490_" d="M228.607,181.144c-5.858-5.858-15.355-5.859-21.213-0.001c-5.858,5.857-5.858,15.355-0.001,21.213   l19.393,19.395l-19.393,19.392c-5.858,5.857-5.858,15.355-0.001,21.213c2.929,2.929,6.768,4.394,10.607,4.394   c3.838,0,7.678-1.464,10.607-4.393l30-29.998c2.813-2.813,4.393-6.628,4.393-10.606c0-3.978-1.58-7.793-4.393-10.607   L228.607,181.144z"/>
                                <path id="XMLID_491_" d="M223,116.75c-34.488,0-65.144,16.716-84.297,42.47c-7.763-1.628-15.695-2.47-23.703-2.47   c-63.411,0-115,51.589-115,115c0,8.284,6.716,15,15,15h125.596c19.247,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105   S280.897,116.75,223,116.75z M31.325,256.75c7.106-39.739,41.923-70,83.675-70c2.965,0,5.914,0.165,8.841,0.467   c-3.779,10.82-5.841,22.44-5.841,34.533c0,12.268,2.122,24.047,6.006,35H31.325z M223,296.75c-41.355,0-75-33.645-75-75   s33.645-75,75-75s75,33.645,75,75S264.355,296.75,223,296.75z"/>
                            </g>
                        </svg>
                        Following:
                        <span class="ml-2">{{count($user->following()->get()->toArray())}}</span>
                    </a>
                </p>
                <p class="mt-2 text-md">Articles: {{count($articles)}}</p>
            </div>
            {{-- Buttons for manipulationg Accounts --}}
            <div class="flex items-center">
                <form action="{{ route('users.access', ['id' => $user->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                    @csrf
                    @method('put')
                    <input type="submit" name="{{ ($user->blocked)? 'unblock' : 'block' }}" class="rounded-md bg-gray-500 {{ ($user->blocked)? 'hover:bg-green-500' : 'hover:bg-red-500' }} text-gray-900 px-3 text-md ml-6" value="{{ ($user->blocked)? 'Unblock' : 'Block' }}">
                </form>
                <form method="POST" action="{{ route('users.follow', ['id' => $user->id]) }}">
                    @csrf
                    <button type="submit" class="rounded-md dark:bg-gray-500 bg-white border border-gray-200 shadow-sm text-gray-900 px-4 py-1 text-md ml-6 flex items-center">
                        @if(auth()->user()->following->contains($user->id))
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 328 328" xml:space="preserve">
                                <g id="XMLID_782_">
                                    <path id="XMLID_783_" d="M223,116.75c-34.488,0-65.144,16.716-84.297,42.47c-7.763-1.628-15.695-2.47-23.703-2.47   c-63.411,0-115,51.589-115,115c0,8.284,6.716,15,15,15h125.596c19.247,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105   S280.897,116.75,223,116.75z M31.325,256.75c7.106-39.739,41.923-70,83.675-70c2.965,0,5.914,0.165,8.841,0.467   c-3.779,10.82-5.841,22.44-5.841,34.533c0,12.268,2.122,24.047,6.006,35H31.325z M223,296.75c-41.355,0-75-33.645-75-75   s33.645-75,75-75s75,33.645,75,75S264.355,296.75,223,296.75z"/>
                                    <path id="XMLID_787_" d="M253,206.75h-60c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15   C268,213.466,261.284,206.75,253,206.75z"/>
                                    <path id="XMLID_788_" d="M115,126.75c34.601,0,62.751-28.149,62.751-62.749C177.751,29.4,149.601,1.25,115,1.25   c-34.601,0-62.75,28.15-62.75,62.751C52.25,98.601,80.399,126.75,115,126.75z M115,31.25c18.059,0,32.751,14.692,32.751,32.751   c0,18.058-14.692,32.749-32.751,32.749c-18.059,0-32.75-14.691-32.75-32.749C82.25,45.942,96.941,31.25,115,31.25z"/>
                                </g>
                            </svg>
                            Unfollow
                        @else
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 328 328" xml:space="preserve">
                                <g id="XMLID_526_">
                                    <path id="XMLID_527_" d="M223,116.75c-34.488,0-65.145,16.716-84.298,42.47c-7.762-1.628-15.694-2.47-23.702-2.47   c-63.411,0-115,51.589-115,115c0,8.284,6.716,15,15,15h125.596c19.246,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105   S280.897,116.75,223,116.75z M31.325,256.75c7.106-39.739,41.923-70,83.675-70c2.966,0,5.914,0.165,8.841,0.467   c-3.779,10.82-5.841,22.44-5.841,34.533c0,12.268,2.122,24.047,6.006,35H31.325z M223,296.75c-41.355,0-75-33.645-75-75   s33.645-75,75-75s75,33.645,75,75S264.355,296.75,223,296.75z"/>
                                    <path id="XMLID_533_" d="M115,126.75c34.601,0,62.75-28.149,62.75-62.749C177.75,29.4,149.601,1.25,115,1.25   c-34.601,0-62.751,28.15-62.751,62.751C52.249,98.601,80.399,126.75,115,126.75z M115,31.25c18.059,0,32.75,14.692,32.75,32.751   c0,18.058-14.691,32.749-32.75,32.749c-18.059,0-32.751-14.691-32.751-32.749C82.249,45.942,96.941,31.25,115,31.25z"/>
                                    <path id="XMLID_536_" d="M253,206.75h-15v-15c0-8.284-6.716-15-15-15s-15,6.716-15,15v15h-15c-8.284,0-15,6.716-15,15   s6.716,15,15,15h15v15c0,8.284,6.716,15,15,15s15-6.716,15-15v-15h15c8.284,0,15-6.716,15-15S261.284,206.75,253,206.75z"/>
                                </g>
                            </svg>
                            Follow
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- article header --}}
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                <form action="{{ route('users.show', ['id' => $user->id]) }}" method="GET">
                    <label class="text-gray-200 text-xl text-bold" for="search-articles">{{ $user->name }}&apos;s articles</label>
                    <div class="pt-4 flex items-center">
                        <input class="w-full dark:bg-gray-700 px-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an Article" id="search-articles" />
                        <button class="ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($articles as $article)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('feed.show_article', ['id' => $article->id]) }}" class="font-bold">{{ $article->title }}</a>
                            <span class="text-gray-400">by <a href="" class="text-gray-400 font-bold hover:text-blue-500">{{ $user->name . (($user->blocked)? ' [blocked]' : '') }}</a></span>
                        </h4>
                        <p>Description: {{ $article->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
