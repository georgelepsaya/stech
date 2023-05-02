<x-layout>
    <h1>{{$page->name}}</h1>
    <ul>
        <li>Description: {{$page->description}}</li>
        <li>Website: {{$page->website}}</li>
        <li>Industry: {{$page->industry}}</li>
        <li>Founded in {{date('M Y', strtotime($page->founding_date))}}</li>
    </ul>
</x-layout>
