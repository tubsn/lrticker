<!DOCTYPE html>
<html lang="de">
<head>
	<title> Page Title </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Tub" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" media="all" href="/embed/lrticker.css" />
	<link rel="shortcut icon" href="" />


	<script>window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		t._e = [];
		t.ready = function(f) {
		t._e.push(f);
		};

		return t;
		}(document, "script", "twitter-wjs"));
	</script>


<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

</head>
<body>
	
	<main class="main-wrapper">

		<div class="ticker-container" >
			<lr-liveticker ticker-id="{{$ticker['ticker']['id']}}"></lr-liveticker>
		</div>

	</main>


	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script type="text/javascript" src="/embed/lrtickerVUE.js"></script>

</body>
</html>