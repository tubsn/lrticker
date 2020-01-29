@extends('ticker.layout.default')

@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)
@section('navtitle', $ticker->name . ' (ID: ' . $ticker->id . ')')

@section('main')

<main class="layout-detail">

<ticker-app id="{{ $ticker->id }}" ticker-status="{{ $ticker->status }}" ticker-typ="{{ $ticker->typ }}" v-cloak>{{ $ticker->headline }}</ticker-app>

<aside class="autor-area">
	<img class="autor-image" src="{{ auth()->user()->thumbnail ?? '/styles/img/icons/no-thumb.svg' }}">
	<h3 class="autor-headline">{{ auth()->user()->username }}</h3>
	<p class="autor-desc">({{ auth()->user()->info ?? 'Editor' }})</p>
</aside>

<aside class="fav-area">

@if ($ticker->typ == 'Fussball')
	<h3 class="fav-headline">Mini-Icons</h3>
	<div class="mini-icons">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/schiri.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/ball.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/pfeife.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/wechsel.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/gelb.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/rot.svg">
		<img class="icon" src="{{env('API_STORAGE_URL')}}/static/gelb-rot.svg">
	</div>
@endif

	<h3 class="fav-headline">Kurzlinks</h3>
	<p><small>
		<a href="https://app5-eu.linkpulse.com/lp/dashboard?id=5c6eaa2a1f05316365282dd1#" target="_blank">Linkpulse</a><br />
		<a href="http://www.lr-online.de" target="_blank">www.lr-online.de</a>
	</small>
	</p>

	<!--Start: {{ !is_null($ticker->start) ? $ticker->start->format('d.m.Y') : 'keine Angabe' }}<br />-->
	<!--<small>Erstellt von: {{ $ticker->author->username }}</small>-->

	<!--<a class="button block mb" href="{{ $ticker->id }}/edit">Einstellungen</a>-->
	<a class="button block" href="{{env('API_STORAGE_URL')}}/view/{{ $ticker->id }}" target="_blank">Vorschau</a>

	<fl-modal class="mt" button="Embed Code">
		<h2>Liveticker einbinden:</h2>
		<p>Code kopieren und in ein HTML-Element im Artikel einfügen</p>
		<textarea class="embed-code"><div class="ticker-container"><lr-liveticker ticker-id="{{ $ticker->id }}"></lr-liveticker><link rel="stylesheet" type="text/css" href="{{env('API_STORAGE_URL')}}/css/lrticker.css"><script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script><script type="text/javascript" src="{{env('API_STORAGE_URL')}}/js/lrtickerVUE.js"></script></div></textarea>
	</fl-modal>

</aside>

</main>

@endsection()
