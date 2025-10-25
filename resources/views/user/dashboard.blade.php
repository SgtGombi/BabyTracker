@extends('user.layout.main')

@section('content')
<h2>Dashboard</h2>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

<p>Üdvözöllek, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>!</p>
<p>Email: {{ $user->email }}</p>
@if($user->phone)
    <p>Telefon: {{ $user->phone }}</p>
@endif

<form method="POST" action="{{ route('user.logout') }}">
    @csrf
    <button type="submit">Kijelentkezés</button>
</form>
@endsection
