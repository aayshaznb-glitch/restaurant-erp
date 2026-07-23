@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <h5 class="mb-3 text-center">Sign in to your account</h5>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-danger w-100">Login</button>
    </form>
   
    <hr>
    <p class="small text-muted mb-0">Demo accounts (password: <code>password</code>):</p>
    <ul class="small text-muted mb-0">
        <li>admin@restaurant.test</li>
        <li>manager@restaurant.test</li>
        <li>waiter@restaurant.test</li>
        <li>kitchen@restaurant.test</li>
        <li>cashier@restaurant.test</li>
    </ul>
@endsection
