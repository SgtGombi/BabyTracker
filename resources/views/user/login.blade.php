@extends('user.layout.main')

@section('content')
<h2>Bejelentkezés</h2>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('user.login.submit') }}">
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

    <label>
        <input type="checkbox" name="remember"> Emlékezz rám
    </label>

    <button type="submit">Bejelentkezés</button>
</form>

<p>
    Nincs még fiókod? 
    <a href="{{ route('user.register') }}">Regisztrálj itt!</a>
</p>
@endsection
