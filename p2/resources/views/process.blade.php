@extends('layouts.app')

@section('title', 'Stock Lookup Results')

@section('content')
<h1>Results for: <strong>{{ $symbol }}</strong></h1>

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
@endsection('content')