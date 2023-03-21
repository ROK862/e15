<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <!-- Common header content -->
    </header>

    <nav>
        <!-- Common navigation content -->
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Common footer content -->
    </footer>
</body>

</html>