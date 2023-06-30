<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-200 text-gray-800">
            <div>
                <div class="flex items-center">
                    @if($user->profile_image_path)
                        <img class="w-24 rounded-3xl mr-3" src="{{ asset('storage/' . $user->profile_image_path) }}" alt="Profile Image">
                    @else
                        <img class="w-24 rounded-3xl mr-3" src="{{ asset('storage/images/no-profile.png') }}" alt="No Profile Image">
                    @endif
                    <div class="ml-2">
                        <h2 class="font-semibold text-2xl leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-800 dark:text-gray-200' }}">
                            {{ $user->name . (($user->blocked)? ' [blocked]' : '') }}
                        </h2>
                        <h2 class="font-semibold text-lg leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-500 dark:text-gray-200' }}">
                           {{ '@' . $user->username }}
                        </h2>
                    </div>
                </div>
                <div class="my-3 text-md">
                    <div>
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                            </svg>
                            <span class="mr-2">Interests</span>
                        </div>
                        <div>
                            @foreach($interests as $tag)
                                <span class="dark:text-gray-200 dark:bg-gray-600 bg-white px-3 py-1 dark:border-none border border-gray-200 mr-3 rounded-full text-sm">{{$tag}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
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
                <p class="mt-2 text-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                    Articles: {{count($articles)}}
                </p>
                <a href="{{route('users.contributions', ['id' => $user->id])}}">Contributions</a>
            </div>
            {{-- Buttons for manipulationg Accounts --}}
            <div class="flex items-center">
                <form action="{{ route('users.access', ['id' => $user->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                    @csrf
                    @method('put')
                    @if($user->blocked)
                        <button type="submit" name="unblock" class="rounded-md dark:bg-gray-500 bg-white border border-gray-200 shadow-sm text-gray-900 px-4 py-1 text-md ml-6 flex items-center">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 330 330" xml:space="preserve">
                                <path id="XMLID_816_" d="M215,100c-15.961,0-31.171,3.271-45,9.174V85c0-46.869-38.131-85-85-85C38.131,0,0,38.13,0,85V145  c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-30.327,24.673-55,55-55c30.327,0,55,24.673,55,55v42.894  c-24.478,21.105-40,52.327-40,87.107c0,63.411,51.589,115,115,115s115-51.589,115-115S278.411,100,215,100z M215,300  c-46.869,0-85-38.131-85-85s38.131-85,85-85c46.869,0,85,38.131,85,85S261.869,300,215,300z"/>
                            </svg>
                            Unblock
                        </button>
                    @else
                        <button type="submit" name="block" class="rounded-md dark:bg-gray-500 bg-white border border-gray-200 shadow-sm text-gray-900 px-4 py-1 text-md ml-6 flex items-center">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 330 330" xml:space="preserve">
                                <g id="XMLID_823_">
                                    <path id="XMLID_824_" d="M265,130h-15V84.999C250,38.13,211.869,0,165,0S80,38.13,80,84.999V130H65c-8.284,0-15,6.716-15,15v170   c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V145C280,136.716,273.284,130,265,130z M110,84.999   C110,54.673,134.673,30,165,30s55,24.673,55,54.999V130H110V84.999z M250,300H80V160h15h140h15V300z"/>
                                    <path id="XMLID_828_" d="M196.856,198.144c-5.857-5.858-15.355-5.858-21.213,0L165,208.787l-10.644-10.643   c-5.857-5.858-15.355-5.858-21.213,0c-5.858,5.858-5.858,15.355,0,21.213L143.787,230l-10.643,10.644   c-5.858,5.858-5.858,15.355,0,21.213c2.929,2.929,6.768,4.394,10.606,4.394s7.678-1.464,10.606-4.394L165,251.213l10.644,10.644   c2.929,2.929,6.768,4.394,10.606,4.394s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L186.213,230l10.643-10.644   C202.715,213.499,202.715,204.001,196.856,198.144z"/>
                                </g>
                            </svg>
                            Block
                        </button>
                    @endif
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800">
            {{-- article header --}}
            <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200">
                <form action="{{ route('users.show', ['id' => $user->id]) }}" method="GET">
                    <label class="dark:text-gray-200 text-xl text-bold" for="search-articles">{{ $user->name }}&apos;s articles</label>
                    <div class="pt-4 flex items-center">
                        <input class="dark:text-gray-200 text-gray-700 w-full dark:bg-gray-700 px-4 py-2 border dark:border-gray-800 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400" name="search" type="search" placeholder="Search for an Article" id="search-articles" />
                        <button class="flex items-center ml-2 px-4 text-sm h-10 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-5 mt-5">
                @foreach($articles as $article)
                    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200">
                        <h4 class="flex flex-row justify-between text-lg font-medium">
                            <a href="{{ route('feed.show_article', ['id' => $article->id]) }}" class="font-bold">{{ $article->title }}</a>
                            <span class="text-gray-400">by <a href="" class="text-gray-400 font-bold hover:text-blue-500">{{ $user->name . (($user->blocked)? ' [blocked]' : '') }}</a></span>
                        </h4>
                        <p>{{ $article->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
