<!DOCTYPE html>
<html lang="de">
<head>
	<title> Page Title </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Tub" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" media="all" href="/styles/css/tickerembed.css" />
	<link rel="shortcut icon" href="" />
	<script type="text/javascript" src="/styles/js/lr-ticker.js"></script>
</head>
<body>

<div id="liveticker"><h1 class="tickerTitle">{{$ticker['ticker']['headline']}}</h1>
	<div class="tickerItems">
	@if ($ticker['posts'])
	@foreach ($ticker['posts'] as $post)
		<div class="tickerPost" id="{{$post['id']}}" data-update="2019-06-18 10:36:39">
			<p>
			<figure>{!!$post['media']!!}</figure>
			<span class="tickerTime">{{$post['time']}}<span class="tickerDate">{{$post['date']}}</span></span>{!!$post['content']!!}
			</p>
		</div>
	@endforeach
	@endif
</div>
</div>





</body>
</html>
