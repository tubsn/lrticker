@extends('ticker.layout.default')

@section('title', 'Neuen Ticker anlegen')
@section('description', 'Neuer Ticker')

@section('main')
<main>


<h1>Neuer Ticker</h1>

<form action="/ticker" method="post">
@csrf

@include('ticker/elements/errorhandler')

<label>Interner Name:
	<input type="text" name="name" value="{{ old('name')}}">
</label>

<label>Überschrift:
	<input type="text" name="headline" value="{{ old('headline')}}">
</label>

<label>Startzeit:
	<input type="date" name="start" value="{{ old('start') }}">
</label>

<button type="submit">Speichern</button> <a class="block ml" href="/ticker">oder zurück</a>
</form>

{{--
Name: {{ $ticker->name }}<br />
Typ: {{ $ticker->typ }}<br />
Start: {{ $ticker->start }}<br />
Titel: {{ $ticker->headline }}<br />
Status: {{ $ticker->status }}<br />
Erstellt von: {{ ($ticker->author) ? $ticker->author->username : 'Redaktion' }}<br />
--}}




</main>
@endsection()
