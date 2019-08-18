@extends('default.html')

@section('body')

<main class="layout-login">

<header class="area-logo">
	<h1>Login</h1>
</header>

<form method="POST" action="{{ route('login') }}">
    @csrf

	<label>E-Mail
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
	</label>

    @error('email')
	<div class="box mb red">{{ $message }}</div>
    @enderror



	<label>Passwort
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
	</label>
    @error('password')
	<div class="box mb red">{{ $message }}</div>
    @enderror

	<label>
		<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		Login merken
    </label>

	<br />

    <button type="submit" class="mt">Einloggen</button>

    @if (Route::has('password.request'))
        <a class="ml" href="{{ route('password.request') }}">
            Passwort vergessen
        </a>
    @endif


</form>

@endsection
