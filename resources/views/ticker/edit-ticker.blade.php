@extends('ticker.layout.default')

@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)

@section('main')
<main>

<aside style="float:right">
<form method="post" action="/ticker/{{ $ticker->id }}">
@method('delete')
@csrf
<button type="submit" class="mt light danger">Ticker löschen</button>
</form>
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
