<!DOCTYPE html>
<html lang="de">
<head>
	<title>@yield('title', 'Admin Area')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Tub" />
	<meta name="description" content="@yield('description', 'Admin Area')" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/admin.css') }}" />
	<link rel="shortcut icon" href="{{ asset('img/flundr.svg') }}" />
</head>
<body>

<div id="App">
@yield('body')
@yield('footer')
</div>

<script type="text/javascript" src="{{ asset('js/flundr/manifest.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flundr/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flundr/flundr.js') }}"></script>

</body>
</html>

