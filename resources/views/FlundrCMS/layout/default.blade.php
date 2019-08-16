<!DOCTYPE html>
<html lang="de">
<head>
	<title>@yield('title', 'Admin Area')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Tub" />
	<meta name="description" content="@yield('description', 'Admin Area')" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" media="all" href="/styles/css/admin.css" />
	<link rel="shortcut icon" href="/styles/img/flundr.svg" />
	<script type="text/javascript" src="/styles/js/app.js"></script>
</head>
<body>
@yield('body')
@yield('footer')
</body>
</html>

