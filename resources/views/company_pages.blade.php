<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pages</title>
</head>
<body>
    @foreach($pages as $page)
        <h4>{{$page->name}}</h4>
        <ul>
            <li>{{$page->description}}</li>
            <li>{{$page->website}}</li>
            <li>{{$page->industry}}</li>
        </ul>
    @endforeach
</body>
</html>
