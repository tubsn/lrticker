@extends('ticker.layout.default')
{{--
@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)
@section('navtitle', '<a href="preview" target="_blank">'.$ticker->name . ' (ID: ' . $ticker->id . ')</a>')
--}}
@section('main')
<main>

<pre>
{{ print_r($ticker) }}
</pre>


</main>
@endsection()
