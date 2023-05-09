@extends('layouts.app')

@section('title', 'Shop-Wise: Create new Item.')

@section('content')
<div class="shop-items-wrapper">
    <form class="general-form" method="post" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        {{ csrf_field() }}

        <h4>Create a new Item.</h4>

        @component('components.item-creator', ['partial'=>false])
        @endcomponent
    </form>
</div>
@endsection