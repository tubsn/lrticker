@extends('ticker.layout.default')

@section('title', 'Userprofile')
@section('description', 'Blub')

@section('main')
<main class="layout-profile">



<h1>Userprofil: {{ $user->username }}</h1>

<article class="user-card">

	<figure class="user-thumb">
		<div id="profile-thumb-upload" class="wrapper" title="Bild hochladen"></div>
		<fl-upload trigger="#profile-thumb-upload"></fl-upload>
		<img src="{{$user->thumbnail ?? '/styles/img/icons/no-thumb.svg' }}">
	</figure>

	<div class="user-info">
		<div>
			<span>Benutzername:</span>
			{{$user->username}}
		</div>
		<div>
			<span>ID:</span>
			{{$user->id}}
		</div>
		<div>
			<span>Name:</span>
			{{$user->vorname}} {{$user->nachname}}
		</div>
		<div>
			<span>Rights:</span>
			{{$user->rights}}
		</div>
		<div>
			<span>E-Mail:</span>
			{{$user->email}}
		</div>
		<div>
			<span>Erstellte Ticker/Einträge:</span>
			{{$user->tickercount}} / {{$user->postcount}}
		</div>
		<div class="fullwidth">
			<span>Infos:</span>
			{{$user->info}}
		</div>

	</div>
</article>
		<a class="button block" href="/profil/edit">Profil bearbeiten</a>

		<a class="button block" href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
		</a>

{{--
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

--}}



</main>
@endsection()
