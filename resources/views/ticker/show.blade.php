@extends('ticker.layout.default')

@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)
@section('navtitle', $ticker->name . ' (ID: ' . $ticker->id . ')')

@section('main')

<main class="layout-detail">

<ticker-app id="{{ $ticker->id }}" v-cloak>{{ $ticker->headline }}</ticker-app>

<aside class="autor-area">
	<img class="autor-image" src="{{ auth()->user()->thumbnail }}">
	<h3 class="autor-headline">{{ auth()->user()->username }}</h3>
	<p class="autor-desc">({{ auth()->user()->description }})</p>
</aside>

<aside class="fav-area">
	<h3 class="fav-headline">Favoriten</h3>
	<p>www.energie.de<br />
	www.youtube.com/lr
	</p>
	<p>
	Name: {{ $ticker->name }}<br />
	Typ: {{ $ticker->typ }}<br />
	Start: {{ !is_null($ticker->start) ? $ticker->start->format('d.m.Y') : 'keine Angabe' }}<br />
	Titel: {{ $ticker->headline }}<br />
	Status: {{ $ticker->status }}<br />
	Erstellt von: {{ $ticker->author->username }}<br />
	</p>
	<a class="button block mb" href="{{ $ticker->id }}/edit">Einstellungen</a>
	<a class="button block mb" href="{{ $ticker->id }}/preview/">Preview</a>
</aside>

</main>

@endsection()
