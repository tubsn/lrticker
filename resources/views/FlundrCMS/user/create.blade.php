@extends('FlundrCMS.layout.default')

@section('title', 'Admin Area')
@section('description', 'Admin Area')

@section('body')

@include('FlundrCMS.navigation.main')

<main>
<h1>User anlegen</h1>

<form method="post" action="/admin/user">
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
	<input type="text" name="username" placeholder="Ihr Benutzername" value="{{ old('username') }}">
</label>
<label>E-Mail:
	<input type="text" name="email" placeholder="z.B. max@muster.de" value="{{ old('email') }}">
</label>
<label>Passwort:
	<input type="password" name="password" placeholder="Ihr Passwort">
</label>
</div>

<h3>Weitere Angaben</h3>
<div class="box">

<label>Vorname:
	<input type="text" name="vorname" placeholder="z.B. Max" value="{{old('vorname')}}">
</label>
<label>Nachname:
	<input type="text" name="nachname" placeholder="z.B. Schuster" value="{{old('nachname')}}">
</label>

<label>Infos:
	<input type="text" name="info" placeholder="z.B. Abteilung" value="{{$user->info ?? old('info')}}">
</label>

<label>Rechtegruppen:
	<input type="text" name="rights" placeholder="Kommasepariert z.B. Recht1,Recht2,Recht3 ..." value="{{old('rights')}}">
</label>
</div>



<button type="submit">Nutzer anlegen</button> <a href="/admin" class="ml">oder abbrechen</a>


</form>



</main>
@endsection()







