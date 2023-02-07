@extends('ticker.layout.default')
@section('main')
<main class="layout-index">

<header class="area-logo">
	<h1>Liveticker Übersicht</h1>
</header>

<aside class="area-ressorts">
	<nav class="ressorts">
		<h2>Infos:</h2>
		<ul>
			<li>Ticker v2.1</li>
			<li class="small">Neue Funktion: Sticky Note</li>
		</ul>
	</nav>
</aside>

<div class="area-button">
	<!--<input class="searchfield" type="text" disabled placeholder="Suchen &hellip;">-->
	<a class="button" href="/ticker/create">Neuen Ticker anlegen</a>
</div>

<section class="area-uebersicht mb">


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
	<td><a href="{{env('API_STORAGE_URL')}}/view/{{ $tickerinfo->id }}" target="_blank" class="vorschau">Link</a></td>
	<td>{{ ($tickerinfo->author) ? $tickerinfo->author->username : 'Redaktion' }}</td>
	<td>{{ ($tickerinfo->status) ? 'aktiv' : 'beendet' }}</td>
	<td>{{ $tickerinfo->typ }}</td>
	<td class="nowrap">{{ $tickerinfo->updated_at->format('d. M H:i') }}&thinsp;<small>Uhr</small></td>
</tr>
@endforeach
</table>

</section>

<br><br>


</main>
@endsection()
