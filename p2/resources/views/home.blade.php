<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Investment Calculator</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
    <div class="application-wrapper">
        <h1>Investment Calculator</h1>

        <p class="message-info">
            The Investment Calculator takes in a Purchase Date, Purchase Shares, and Stock Symbol to calculate the
            amount
            of profit/loss you gained/lost from the closing price on the purchase date and the current price.
            <img src="{{ asset('images/investment-calculator.webp') }}" alt="stock calculator" />
        </p>

        @if(isset($error) && $error == true)
        <p class="message-error">
            {{ $message }}
        </p>
        @endif

        <form action="/app/results" method="POST">
            @csrf
            <!-- form inputs here -->
            <label for="purchase-date">Stock Purchase Date:</label>
            <input @if (isset($error) && $error==true) value={{$date}} @endif type="date" id="purchase-date"
                name="purchase-date" required><br><br>

            <label for="purchase-shares">Purchase Shares:</label>
            <input @if (isset($error) && $error==true) value={{$shares}} @endif type="number" id="purchase-shares"
                name="purchase-shares" required><br><br>

            <label for="stock-symbol">Stock Symbol:</label>
            <select @if (isset($error) && $error==true) value={{$symbol}} @endif id="stock-symbol" name="stock-symbol">
                <option value="AAPL">Apple Inc.</option>
                <option value="AMZN">Amazon.com Inc.</option>
                <option value="GOOG">Alphabet Inc.</option>
                <option value="FB">Facebook Inc.</option>
                <option value="NFLX">Netflix Inc.</option>
                <option value="TSLA">Tesla Inc.</option>
                <option value="MSFT">Microsoft Corporation</option>
                <option value="NVDA">NVIDIA Corporation</option>
                <option value="JPM">JPMorgan Chase &amp; Co.</option>
                <option value="V">Visa Inc.</option>
                <option value="PG">Procter &amp; Gamble Co.</option>
                <option value="JNJ">Johnson &amp; Johnson</option>
                <option value="WMT">Walmart Inc.</option>
                <option value="UNH">UnitedHealth Group Inc.</option>
                <option value="XOM">Exxon Mobil Corporation</option>
            </select><br><br>

            <button type="submit">Calculate Profit/List</button>
        </form>
    </div>
</body>

</html>