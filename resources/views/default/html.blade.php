<!DOCTYPE html>
<html lang="de">
<head>
	<title>@yield('title', config('app.name', 'Flundr'))</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Tub" />
	<meta name="description" content="@yield('description', config('app.description', 'Flundr'))" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/main.css') }}" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:400,400i,700,700i|Fira+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="{{ asset('img/flundr.svg') }}" />
	<script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
@yield('body')
@yield('footer')
</body>
</html>

