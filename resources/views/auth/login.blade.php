@extends('default.html')

@section('body')

<main class="layout-auth">

<div class="centered-box">
<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf
    @error('email')<div class="box mb red">{{ $message }}</div>@enderror
	@error('password')<div class="box mb red">{{ $message }}</div>@enderror

	<fieldset>
	<label>E-Mail Adresse:
    	<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
		name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
	</label>
	<label>Passwort:
		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
		name="password" required autocomplete="current-password">
	</label>
	<label class="pointer">
		<input type="checkbox" name="remember" checked {{ old('remember') ? 'checked' : '' }}>
		Login merken
	</label>
	</fieldset>

    <button type="submit" class="mt">Einloggen</button>

    @if (Route::has('password.request'))
    <a class="ml" href="{{ route('password.request') }}">Passwort vergessen</a>
    @endif


</form>
</div>

</main>

@endsection
