@extends('default.html')

@section('body')
<main class="layout-home">

<h1>Temporäre Startseite</h1>
<h3>Dinge die noch offen sind</h3>
<ol>
	<li>Bild beim hochladen runterrechnen</li>
	<li>Bild heranzoomen</li>
	<li>Bildergalerien</li>
	<li>Fussball Minutencounter</li>
	<li>Rechteverwaltung für Benutzer</li>
	<li>Schnürsenkel</li>
</ol>
<br /><br />


↓

<h2><a href="/ticker">Zu den Tickern</a></h2>
<br />
<br />


@guest
<a href="{{ route('login') }}">{{ __('Login') }}</a><br />

@if (Route::has('register'))<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a><br />@endif
@endguest

@auth
Sie sind eingeloggt
<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
@endauth

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

</main>

@endsection
