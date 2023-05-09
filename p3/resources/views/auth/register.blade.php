@extends('layouts/main')

@section('content')
<h1>Register</h1>

Already have an account? <a href='/login'>Login here...</a>

<div class="shop-items-wrapper">
    <form class="general-form" method='POST' action='/register'>
        {{ csrf_field() }}

        <h4>New user account form.</h4>
        <div class="general-input-wrapper">
            <label for='name'>Name</label>
            <input id='name' type='text' name='name' value='{{ old('name') }}' autofocus>
            @include('components.error-field', ['fieldName' => 'name'])
        </div>
        <div class="general-input-wrapper">
            <label for='email'>E-Mail Address</label>
            <input id='email' type='email' name='email' value='{{ old('email') }}'>
            @include('components.error-field', ['fieldName' => 'email'])
        </div>
        <div class="general-input-wrapper">
            <label for='password'>Password (min: 8)</label>
            <input id='password' type='password' name='password'>
            @include('components.error-field', ['fieldName' => 'password'])
        </div>
        <div class="general-input-wrapper">
            <label for='password-confirm'>Confirm Password</label>
            <input id='password-confirm' type='password' name='password_confirmation'>
        </div>
        <button type='submit' class='btn btn-primary'>Register</button>
    </form>
</div>
@endsection