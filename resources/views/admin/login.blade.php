@extends('admin.layout.main')

@section('content')
<h2>Admin Bejelentkezés</h2>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
    @error('email')
        <span>{{ $message }}</span>
    @enderror

    <label for="password">Jelszó</label>
    <input id="password" name="password" type="password" required>
    @error('password')
        <span>{{ $message }}</span>
    @enderror

    <button type="submit">Bejelentkezés</button>
</form>
@endsection
