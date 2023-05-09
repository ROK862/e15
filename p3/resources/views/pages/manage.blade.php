@extends('layouts.app')

@section('title', 'Shop-Wise: Manage Items.')

@section('content')
@if(count($products) > 0)
<div class="shop-items-wrapper">
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
</div>
@else
<div class="shop-items-wrapper">
    <form class="general-form" method="post" action="{{ route('store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p class="message-info">You do not have any products listed.</p>
        <h4>Create your first listing.</h4>

        @component('components.item-creator', ['partial'=>false])
        @endcomponent
    </form>
    </form>
</div>
@endif
@endsection