@extends('default.html')
@section('title', 'Liveticker')
@section('description', 'LR Liveticker Datenbank')

@section('body')

<div id="App">
@include('ticker.navigation.main')

@yield('main')
</div>

@endsection()
