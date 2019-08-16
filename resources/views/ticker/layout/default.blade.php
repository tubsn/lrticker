@extends('default.html')
@section('title', 'Liveticker')
@section('description', 'LR Liveticker Datenbank')

@section('body')

@include('ticker.navigation.main')

@yield('main')

@endsection()
