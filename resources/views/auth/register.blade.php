@extends('default.html')

@section('body')

<main class="layout-login">

<header class="area-logo">
	<h1>Registrieren</h1>
</header>

<form method="POST" action="{{ route('register') }}">
    @csrf

	<label>Username:
    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus></label>

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


	<label>E-Mail:
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
	</label>

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


	<label>Passwort:
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
	</label>

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


	<label>Password bestätigen
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
	</label>

    <button type="submit" class="btn btn-primary">
        Registrieren
    </button>

	@if ($errors->any())
	<div class="box mb red">
	<ul class="clean">
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
	@endif



</form>

@endsection
