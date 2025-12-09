@extends('layouts.layout')
@section('title', 'Login')

@section('content')
<div>
    <h1>This is the login page</h1> 
    <form action="{{ route('login.post') }}" method="post">
        @csrf <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required> 
        
        <input type="submit" value="Log In">

        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </form>   
</div>
@endsection