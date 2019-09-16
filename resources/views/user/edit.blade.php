@extends('ticker.layout.default')

@section('title', 'Userprofile')
@section('description', 'Blub')

@section('main')
<main>

<h1>Userprofil: {{ $user->username }} (ID: {{ $user->id }})</h1>

<form action="/profil" method="post">
@csrf
@method('patch')

{{--<input type="text" name="name" value="{{ $user->name ?? old('name')}}">--}}



@if ($errors->any())
<div class="box mb red">
<ul class="clean">
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
	@endforeach
</ul>
</div>
@endif

<h3>Angaben zum Account</h3>
<div class="box">

<label>Username:
	<input type="text" name="username" placeholder="Ihr Benutzername" value="{{$user->username ?? old('username')}}">
</label>
<label>E-Mail:
	<input type="text" name="email" placeholder="z.B. max@muster.de" value="{{$user->email ?? old('email')}}">
</label>
<label>Passwort:
	<input type="password" name="password" placeholder="zum ändern neues Passwort eingeben" autocomplete="new-password">
</label>
</div>

<h3>Weitere Angaben</h3>
<div class="box">

<label>Vorname:
	<input type="text" name="vorname" placeholder="z.B. Max" value="{{$user->vorname ?? old('vorname')}}">
</label>
<label>Nachname:
	<input type="text" name="nachname" placeholder="z.B. Schuster" value="{{$user->nachname ?? old('nachname')}}">
</label>


<label>Infos:
	<input type="text" name="info" placeholder="Beschreibung" value="{{$user->info ?? old('info')}}">
</label>
</div>





<button type="submit">Speichern</button> <a class="button" href="{{ url()->previous() }}">oder zurück</a>
</form>

</main>
@endsection()
