@extends('default.html')

@section('body')
<main class="layout-auth">

<div class="centered-box">
<h1>Passwort ändern</h1>

<form method="POST" action="{{ route('password.update') }}">
@csrf
<input type="hidden" name="token" value="{{ $token }}">

@error('email')<div class="box mb red">{{ $message }}</div>@enderror
@error('password')<div class="box mb red">{{ $message }}</div>@enderror

    <label>E-Mail Adresse:
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
	</label>

    <label>Neues Passwort:
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
	</label>

    <label>Passwort bestätigen:
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
	</label>

    <button type="submit" class="mt">Passwort zurücksetzen</button>

</form>

@endsection
