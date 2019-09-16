@extends('ticker.layout.default')

@section('title', 'Userprofile')
@section('description', 'Blub')

@section('main')
<main>

<h1>Userprofil: {{ $user->username }}</h1>

<table class="fancy" style="width:100%; margin-bottom:2em;">

	<tr>
		<td>ID:</td>
		<td>{{$user->id}}</td>
	</tr>
	<tr>
		<td>Benutzername:</td>
		<td>{{$user->username}}</td>
	</tr>
	<tr>
		<td>E-Mail:</td>
		<td>{{$user->email}}</td>
	</tr>
	<tr>
		<td>Vorname:</td>
		<td>{{$user->vorname}}</td>
	</tr>
	<tr>
		<td>Nachname:</td>
		<td>{{$user->nachname}}</td>
	</tr>

	<tr>
		<td>Infos:</td>
		<td>{{$user->info}}</td>
	</tr>

	<tr>
		<td>Rechtegruppen:</td>
		<td>{{$user->rights}}</td>
	</tr>

</table>

<aside>
<img style="max-width:300px" src="{{$user->thumbnail}}">
</aside>

<a class="button block" href="/profil/edit">Profil bearbeiten</a>
<a class="button block" href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
</a>


</main>
@endsection()
