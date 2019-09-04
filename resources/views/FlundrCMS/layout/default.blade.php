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
@yield('body')
@yield('footer')

<script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
</html>

