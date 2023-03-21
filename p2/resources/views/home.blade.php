@extends('layouts.app')

@section('title', 'Investment Calculator')

@section('content')
<div class="application-wrapper">
    <h1>Investment Calculator</h1>

    <p class="message-info">
        The Investment Calculator takes in a Purchase Date, Purchase Shares, and Stock Symbol to calculate the
        amount of profit or loss you gained or lost from the closing price on the purchase date compared to the
        current
        price.
        <img src="{{ asset('images/investment-calculator.webp') }}" alt="stock calculator" />
    </p>
    
    <form action="/process" method="POST">
        @csrf
        <!-- form inputs here -->
        <label for="purchase-date">Stock Purchase Date:</label>
        <input value="{{ old('purchase-date') }}" type="date" id="purchase-date" name="purchase-date"><br><br>

        <label for="purchase-shares">Purchase Shares:</label>
        <input value="{{ old('purchase-shares') }}" type="number" id="purchase-shares" name="purchase-shares"><br><br>

        <label for="stock-symbol">Stock Symbol:</label>
        <select value="{{ old('stock-symbol') }}" id="stock-symbol" name="stock-symbol">
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

    @if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p class="message-error">
            {{ $error }}
        </p>
        @endforeach
    </div>
    @endif
</div>
@endsection('content')