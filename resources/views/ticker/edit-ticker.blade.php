@extends('ticker.layout.default')

@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)

@section('main')
<main class="flundrApp" v-cloak>

<aside style="float:right">
	<fl-dialog
		action="/ticker/{{ $ticker->id }}"
		method="delete"
		submit="Ja, löschen"
		cancel="Nein, abbrechen"
		redirect="/ticker">
		<template v-slot:button>
			<button class="mt button light danger">Ticker löschen</button>
		</template>
		<h2>Löschen bestätigen:</h2>
		<p>Möchten Sie <b>{{ $ticker->name }}</b> tatsächlich löschen?</p>
	</fl-dialog>
</aside>


<h1>ID: {{ $ticker->id }} - {{ $ticker->name }} editieren</h1>
<form action="/ticker/{{ $ticker->id }}" method="post">
@csrf
@method('patch')

<fieldset class="mb">
<label>Ticker-Status:
	<select name="status">
		<option {{ $ticker->status ? 'selected ' : ''}}value="1">Aktiv</option>
		<option {{ $ticker->status ? '' : 'selected '}}value="0">Beendet</option>
	</select>
</label>
</fieldset>


<fieldset class="mb">
<label>Überschrift:
	<input type="text" name="headline" value="{{ $ticker->headline ?? old('headline')}}">
</label>

<label>Ortsmarke / Location:
	<input type="text" name="location" value="{{ $ticker->location ?? old('location') }}">
</label>

<label>Mehrere Autoren:
	<select name="multiauthor">
		<option {{ $ticker->multiauthor ? 'selected ' : ''}}value="1">Autorenfotos Anzeigen</option>
		<option {{ $ticker->multiauthor ? '' : 'selected '}}value="0">Autorenfotos deaktivieren</option>
	</select>
</label>

</fieldset>
<!--
<label>Startzeit:
	<input type="date" name="start" value="{{ !is_null($ticker->start) ? $ticker->start->format('Y-m-d') : '' }}">
</label>
-->


<fieldset>

<label>Interner Name:
	<input type="text" name="name" value="{{ $ticker->name ?? old('name')}}">
</label>


<label>Ticker-Typ:
	<select name="typ">
		<option {{ ($ticker->typ == 'Standard') ? 'selected ' : ''}}value="Standard">Standard</option>
		<option {{ ($ticker->typ == 'Fussball') ? 'selected ' : ''}}value="Fussball">Fussball</option>
	</select>
</label>


</fieldset>


<button class="mt" type="submit">Ticker speichern</button>
<a class="ml" href="/ticker/{{ $ticker->id }}">oder zurück</a>
</form>


</main>
@endsection()
