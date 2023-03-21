<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trading Profit Calculator</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
    <h1>Results</h1>

    <a href="/home"><button>Go Back</button></a>

    <p class="message-info">
        {{ $message }}
    </p>

    <div class="summary">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Open</td>
                    <td>High</td>
                    <td>Low</td>
                    <td>Close</td>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $row)
                <tr @if ($row["0. date"]==$date) class="highlighted" @endif>
                    <td>{{ $row["0. date"] }}</td>
                    <td>{{ $row["1. open"] }}</td>
                    <td>{{ $row["2. high"] }}</td>
                    <td>{{ $row["3. low"] }}</td>
                    <td>{{ $row["4. close"] }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</body>

</html>