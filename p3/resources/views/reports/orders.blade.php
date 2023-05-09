@extends('layouts.app')

@section('title', 'Shop-Wise: Aggregated Sales.')

@section('content')
<div class="container">
    <h2>Sales Orders Report</h2>
    @component('components.print', [])
    @endcomponent

    <table class="table" id="salesreport">
        <thead>
            <tr>
                <th>Order Document No.</th>
                <th>Item Name.</th>
                <th>Item Price.</th>
                <th>Order Quantity.</th>
                <th>Total Price.</th>
                <th>Expected Delivery Date.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_data as $order)
            <tr>
                <td>{{ $order['order_id'] + 10000 }}</td>
                <td>{{ $order['item_name'] }}</td>
                <td>{{ $order['item_price'] }}</td>
                <td>{{ $order['order_quantity'] }}</td>
                <td>{{ $order['total_price'] }}</td>
                <td>{{ $order['expected_delivery'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection