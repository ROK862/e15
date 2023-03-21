<!doctype html>
<html lang="en">

<head>
    <title>Too many request to Stock API Services.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <form>
        <h1>Too many request to Stock API Services.</h1>
        <p class="message-error">
            You made too many request to the Stocks API. Please wait at least one minute. The max request for this
            application is limited to 2 per minute.
        </p>
    </form>
</body>