<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('src/css/app.css') }}">
</head>

<body>

    @component('components.nav', [])
    @endcomponent

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; Shop-Wise, Inc. {{ config('mail.contact_email') }}
    </footer>
</body>

</html>