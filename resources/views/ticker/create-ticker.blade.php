@extends('ticker.layout.default')

@section('title', 'Neuen Ticker anlegen')
@section('description', 'Neuer Ticker')

@section('main')
<main>


<h1>Neuer Ticker</h1>

<form action="/ticker" method="post">
@csrf
<input type="hidden" name="author_id" value="{{auth()->user()->id}}">

@include('ticker/elements/errorhandler')

<label>Überschrift:
	<input type="text" name="headline" value="{{ old('headline')}}" placeholder="Überschrift für den Liveticker">
</label>

<label>Ortsmarke / Location:
	<input type="text" name="location" value="{{ old('location')}}" placeholder="z.B. aus dem Energiestadion">
</label>

<!--
<label>Startzeit:
	<input type="date" name="start" value="{{ old('start') }}">
</label>
-->

<label>Ticker mit mehreren Autoren:
	<select name="multiauthor">
		<option value="0">Autorenfotos deaktivieren</option>
		<option value="1">Autorenfotos Anzeigen</option>
	</select>
</label>


<button class="mt" type="submit">Speichern</button>
<a class="ml" href="/ticker">oder zurück</a>
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
