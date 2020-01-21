@extends('ticker.layout.default')
@section('main')
<main class="layout-index">

<header class="area-logo">
	<h1>Liveticker Übersicht</h1>
</header>

<aside class="area-ressorts">
	<nav class="ressorts">
		<h2>Ressorts:</h2>
		<ul>
			<li>hier könnten Ressorts zur auswahl stehen</li>
			<li>Oder aktuelle Infos...</li>
		</ul>
	</nav>
</aside>

<div class="area-button">
	<input class="searchfield" type="text" placeholder="Suchen &hellip;">
	<a class="button" href="/ticker/create">Neuen Ticker anlegen</a>
</div>

<section class="area-uebersicht">


<table class="styled uebersicht">
<tr>
	<th>ID</th>
	<th>Ticker</th>
	<th>Vorschau</th>
	<th>Autor</th>
	<th>Status</th>
	<th>Typ</th>
	<th>Update</th>
</tr>

@foreach ($tickers as $tickerinfo)
<tr>
	<td>{{ $tickerinfo->id }}</td>
	<td><a href="/ticker/{{ $tickerinfo->id }}">{{ $tickerinfo->name }}</a></td>
	<td><a href="/ticker/{{ $tickerinfo->id }}/preview" target="_blank" class="vorschau">Link</a></td>
	<td>{{ ($tickerinfo->author) ? $tickerinfo->author->username : 'Redaktion' }}</td>
	<td>{{ ($tickerinfo->status) ? 'aktiv' : 'beendet' }}</td>
	<td>{{ $tickerinfo->typ }}</td>
	<td class="nowrap">{{ $tickerinfo->updated_at->format('d. M H:i') }}&thinsp;<small>Uhr</small></td>
</tr>
@endforeach
</table>

</section>




</main>
@endsection()
