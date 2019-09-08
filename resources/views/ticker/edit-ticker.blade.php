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

<label>Interner Name:
	<input type="text" name="name" value="{{ $ticker->name ?? old('name')}}">
</label>

<label>Überschrift:
	<input type="text" name="headline" value="{{ $ticker->headline ?? old('headline')}}">
</label>

<label>Startzeit:
	<input type="date" name="start" value="{{ !is_null($ticker->start) ? $ticker->start->format('Y-m-d') : '' }}">
</label>

<button type="submit">Speichern</button>
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
