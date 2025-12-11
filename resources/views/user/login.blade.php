@extends('user.layout.main')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="card w-full max-w-md bg-base-200 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Bejelentkezés</h2>

                @if(session('status'))
                    <div class="alert alert-info mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.login.submit') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div class="form-control">
                        <label for="email" class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input id="email" name="email" type="email"
                               value="{{ old('email') }}"
                               class="input input-bordered w-full"
                               required autofocus>
                        @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text">Jelszó</span>
                        </label>
                        <input id="password" name="password" type="password"
                               class="input input-bordered w-full"
                               required>
                        @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember --}}
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="checkbox" name="remember" class="checkbox checkbox-primary">
                        <span class="label-text">Emlékezz rám</span>
                    </label>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-full">
                        Bejelentkezés
                    </button>
                </form>

                <p class="text-center mt-4">
                    Nincs még fiókod?
                    <a href="{{ route('user.register') }}" class="link link-primary">Regisztrálj itt!</a>
                </p>
            </div>
        </div>
    </div>
@endsection
