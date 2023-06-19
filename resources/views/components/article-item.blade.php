<div>
    <div class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-200">
        <h4 class="flex flex-row justify-between text-lg font-medium">
            <a href="{{ route('feed.show_article', ['id' => $article->id]) }}" class="font-bold">{{ $article->title }}</a>
            <span class="text-gray-400">by <a href="{{ route('users.show', ['id' => $author->id]) }}" class="text-gray-400 font-bold hover:text-blue-500">{{ $author->name . $access }}</a></span> 
        </h4>
        <p>Description: {{ $article->description }}</p>
    </div>
</div>