@extends('default.html')

@section('body')
<main class="layout-auth">

<div class="centered-box">
<h1>Passwort zurücksetzen</h1>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
	@error('email')<div class="box mb red">{{ $message }}</div>@enderror
	<label>E-Mail Adresse
		<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
	</label>
	<button type="submit" class="mt">Link senden</button>
</form>

</div>
</main>

@endsection
