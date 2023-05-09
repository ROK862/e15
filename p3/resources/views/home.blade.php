@extends('layouts.app')

@section('title', 'Shop-Wise: Online Store.')

@section('content')

<!-- Render a banner with welcome message -->
@if(Auth::user())
@component('components.banner', [])
@endcomponent
@endif
<!-- Render a banner with welcome message -->


<!-- Render a search component -->
@component('components.search', [])
@endcomponent
<!-- Render a search component -->

<div class="shop-items-wrapper">
    @foreach($products as $product)
    @component('components.item', [
    'product_name' => $product['name'],
    'product_price' => $product['price'],
    'product_image' => $product['image'],
    'product_id' => $product['id'],
    'mode' => 'view',
    'user_name' => $product['user_name'],
    'is_owner' => $product['is_owner'],
    ])
    @endcomponent
    @endforeach
</div>
@endsection