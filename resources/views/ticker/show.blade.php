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

	<img class="ball" src="/styles/img/ticker-icons/soccer.png"><img class="ball" src="/styles/img/ticker-icons/rot.png"><img class="ball" src="/styles/img/ticker-icons/gelb.png">
	<p style="text-align:center; font-size:14px; margin-top:4px">(drag&drop)</p>
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
	<a class="button block" href="{{ $ticker->id }}/preview/" target="_blank">Vorschau</a>
</aside>

</main>

@endsection()
