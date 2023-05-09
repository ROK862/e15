@extends('layouts.app')

@section('title', 'Shop-Wise: Manage Items.')

@section('content')
@if(count($products) > 0)
<div class="shop-items-wrapper flex">
    @foreach($products as $product)
    @component('components.item', [
    'product_name' => $product['name'],
    'product_price' => $product['price'],
    'product_image' => $product['image'],
    'product_id' => $product['id'],
    'mode' => 'manage',
    'user_name' => 'You',
    'product_visibility' => $product['visibility'],
    'is_owner' => true,
    ])
    @endcomponent
    @endforeach

    <form class="general-form" method="POST" action="{{ route('orders.store') }}">
        @csrf
        {{ csrf_field() }}
        <p class="message-info">
            You can use the form below to order the product to your left. Adjust the quantity and submit your order.
        </p>
        <h4>Order {{ $products[0]['name'] }}.</h4>
        <div class="general-input-wrapper hidden">
            <input name="item_id" value="{{ $products[0]['id'] }}" id="item_id" type="number" />
        </div>
        <div class="general-input-wrapper">
            <input value="{{ old('quantity') }}" name="quantity" id="quantity" type="number"
                placeholder="Order Quantity" />
            @if ($errors->has('quantity'))
            <div class="message-warning">
                {{ $errors->first('quantity') }}
            </div>
            @endif
        </div>
        <button>Submit Order</button>
    </form>
</div>
@endif

@endsection