@extends('default.html')

@section('body')
<main class="layout-home">

<form action="/upl" method="post" enctype="multipart/form-data">
	@csrf
<input name="blub" type="file" >
<button type="submit">bla</button>
</form>

</main>

@endsection
