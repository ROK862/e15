@extends('layouts.app')

@section('title', 'Shop-Wise: Aggregated Sales.')

@section('content')
<div class="container">
    <h2>Aggregated Sales Report</h2>
    @component('components.print', [])
    @endcomponent

    <table class="table" id="salesreport">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity Sold</th>
                <th>Total Per Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales_data as $data)
            <tr>
                <td>{{ $data['item_name'] }}</td>
                <td>{{ $data['quantity_sold'] }}</td>
                <td>{{ $data['total_per_order'] }}</td>
            </tr>
            @endforeach
            <tr>
                <td><strong>Total:</strong></td>
                <td><strong>{{ $total_quantity_sold }}</strong></td>
                <td><strong>{{ $total_sales }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection