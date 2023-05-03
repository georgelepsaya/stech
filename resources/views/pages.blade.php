<x-layout>
    <form action="{{ route('pages.index') }}" method="GET" class="search_form">
        <label for="search-pages">Search for pages</label>
        <div class="search-group">
            <input name="search" type="search" placeholder="Search for a company/product/topic" id="search-pages" />
            <button type="submit">Search</button>
        </div>
    </form>
    @foreach($pages as $page)
        <div class="page-card">
            <h4><a href="pages/{{$page->id}}">{{$page->name}}</a></h4>
            <p>Description: {{$page->description}}</p>
        </div>
    @endforeach
</x-layout>
