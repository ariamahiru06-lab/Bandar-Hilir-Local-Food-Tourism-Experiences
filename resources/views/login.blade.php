@extends('layout.app')

@section('content')

<h1>Login</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label>Email:</label>
    <input type="email" name="email" required>

    <br><br>
    
    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>

@endsection