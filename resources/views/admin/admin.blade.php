@extends('admin.layout.main')

@section('content')
<h2>Admin Dashboard</h2>

<p>Üdvözöllek, <strong>{{ $admin->name }}</strong>!</p>
<p>Email: {{ $admin->email }}</p>
<p>Szint: {{ $admin->level }}</p>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Kijelentkezés</button>
</form>
@endsection
