<x-layout>
    <h2>Pages</h2>
    @foreach($pages as $page)
        <div class="page-card">
            <h4><a href="pages/{{$page->id}}">{{$page->name}}</a></h4>
            <p>Description: {{$page->description}}</p>
        </div>
    @endforeach
</x-layout>
