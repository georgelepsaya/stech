<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl leading-tight {{ ($user->blocked)? 'text-red-500' : 'text-gray-800 dark:text-gray-200' }}">
                    {{ $user->name . (($user->blocked)? ' [blocked]' : '') }} <span class="{{ ($user->blocked)? 'text-red-800' : 'text-gray-800 dark:text-gray-400' }}">{{ $user->email }}</span>
                </h2>
                <p class="mt-2 text-lg">
                    <a href="{{route('users.followers', ['id' => $user->id])}}">Followers:</a>
                    <span id="follow-count">{{count($user->followers()->get()->toArray())}}</span>
                </p>
                <p class="mt-2 text-lg">Articles: {{count($articles)}}</p>
            </div>
            {{-- Buttons for manipulationg Accounts --}}
            <div class="flex items-center">
            <form action="{{ route('users.access', ['id' => $user->id]) }}" method="post" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('put')
                <input type="submit" name="{{ ($user->blocked)? 'unblock' : 'block' }}" class="rounded-md bg-gray-500 {{ ($user->blocked)? 'hover:bg-green-500' : 'hover:bg-red-500' }} text-gray-900 px-3 text-md ml-6" value="{{ ($user->blocked)? 'Unblock' : 'Block' }}">
            </form>
            <button data-user-id="{{$user->id}}"
                    id="follow_btn"
                    class="ml-3 bg-gray-500 text-gray-900 px-3 rounded-md">
                {{(auth()->user()->following->contains($user->id)) ? 'Unfollow' : 'Follow'}}
            </button>
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

    <script>
        const btn = document.getElementById('follow_btn');
        const followCount = document.getElementById('follow-count');
        btn.addEventListener('click', function (event) {
            const currTarget = event.currentTarget;
            const userId = currTarget.getAttribute('data-user-id');
            fetch(`${userId}/follow`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                if (data.followed === 0) {
                    btn.textContent = 'Follow';
                    followCount.textContent = (parseInt(followCount.textContent) - 1).toString();
                } else {
                    btn.textContent = 'Unfollow';
                    followCount.textContent = (parseInt(followCount.textContent) + 1).toString();
                }
            });
        });
    </script>
</x-app-layout>
