@extends('layouts/main')

@section('content')

<h1>Login</h1>

Don’t have an account? <a href='/register'>Register here...</a>

<div class="shop-items-wrapper">
    <form class="general-form" method='POST' action='/login'>
        {{ csrf_field() }}

        <h4>Login to your account.</h4>
        <div class="general-input-wrapper">
            <label for='email'>E-Mail Address</label>
            <input id='email' type='email' name='email' value='{{ old('email') }}' autofocus>
            @include('components.error-field', ['fieldName' => 'email'])
        </div>
        <div class="general-input-wrapper">
            <label for='password'>Password</label>
            <input id='password' type='password' name='password'>
            @include('components.error-field', ['fieldName' => 'password'])
        </div>
        <button type='submit' class='btn btn-primary'>Login</button>
    </form>
</div>

@endsection