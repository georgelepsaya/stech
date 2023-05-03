<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=1">
    <title>Pages</title>
</head>

<body>
<!-- Navbar -->
<nav class="navbar_container">
    <div class="navbar_container__list">
        <div class="side">
            <div class="navbar_container__list-item"><a href="{{route('pages.index')}}"><i class="fa-regular fa-newspaper"></i>&nbsp;
                    Pages</a>
            </div>
        </div>
        <div class="side">
            <div class="navbar_container__list-item login_link"><a href="{{route('pages.index')}}"><i
                        class="fa-regular fa-user"></i>&nbsp;
                    Login</a></div>
            <div class="navbar_container__list-item register_link"><a href="{{route('pages.index')}}"><i
                        class="fa-solid fa-right-to-bracket"></i> &nbsp;Sign Up</a></div>
        </div>
    </div>
</nav>

{{ $slot }}

</body>

</html>
