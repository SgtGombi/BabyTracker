@extends('user.layout.main')

@section('content')
<h2>Regisztráció</h2>

<form method="POST" action="{{ route('user.register.submit') }}">
    @csrf
    
    <label for="first_name">Keresztnév</label>
    <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required autofocus>
    @error('first_name')
        <span>{{ $message }}</span>
    @enderror

    <label for="last_name">Vezetéknév</label>
    <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required>
    @error('last_name')
        <span>{{ $message }}</span>
    @enderror

    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
    @error('email')
        <span>{{ $message }}</span>
    @enderror

    <label for="phone">Telefon (opcionális)</label>
    <input id="phone" name="phone" type="text" value="{{ old('phone') }}">
    @error('phone')
        <span>{{ $message }}</span>
    @enderror

    <label for="password">Jelszó</label>
    <input id="password" name="password" type="password" required>
    @error('password')
        <span>{{ $message }}</span>
    @enderror

    <label for="password_confirmation">Jelszó megerősítése</label>
    <input id="password_confirmation" name="password_confirmation" type="password" required>

    <button type="submit">Regisztráció</button>
</form>

<p>
    Már van fiókod? 
    <a href="{{ route('user.login') }}">Jelentkezz be itt!</a>
</p>
@endsection
