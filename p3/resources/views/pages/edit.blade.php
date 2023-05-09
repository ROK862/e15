@extends('layouts.app')

@section('title', 'Shop-Wise: Create new Item.')

@section('content')
<div class="shop-items-wrapper">
    <form class="general-form" method="POST" action="{{ route('items.update', $item->id) }}">
        @csrf
        @method('PUT')

        <h4>Edit {{ $item['name'] }}.</h4>

        @component('components.item-creator', ['partial'=>true, 'item' => $item])
        @endcomponent
    </form>
</div>
@endsection