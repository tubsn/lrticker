@extends('FlundrCMS.layout.default')

@section('title', 'Admin Area')
@section('description', 'Admin Area')

@section('body')

@include('FlundrCMS.navigation.main')

<main>

<aside style="float:right">
	<fl-dialog
		action="/admin/user/{{$user->id}}"
		method="delete"
		submit="Ja, löschen"
		cancel="Nein, abbrechen"
		redirect="/admin"
		v-cloak
		>
		<template v-slot:button>
			<button class="mt button light danger">Account löschen</button>
		</template>
		<h2>Löschen bestätigen:</h2>
		<p>Möchten Sie {{$user->username}} tatsächlich löschen?</p>
	</fl-dialog>
</aside>

<h1>User Editieren</h1>

<form method="post" action="/admin/user/{{$user->id}}">
@method('patch')
@csrf

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

<label>Rechtegruppen:
	<input type="text" name="rights" placeholder="Kommasepariert z.B. Recht1,Recht2,Recht3 ..." value="{{$user->rights ?? old('rights')}}">
</label>
</div>



<button type="submit">Daten speichern</button> <a href="/admin" class="ml">oder abbrechen</a>

</form>



</main>
@endsection()







