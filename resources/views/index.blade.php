@extends('default.html')

@section('body')
<main class="layout-home">

<a href="/ticker">Zu den Tickern</a>
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
