@extends('ticker.layout.default')

@section('title', 'Ticker: ' . $ticker->name . ' (ID:' . $ticker->id . ')')
@section('description', $ticker->headline)
@section('navtitle', $ticker->name . ' (ID: ' . $ticker->id . ')')

@section('main')

<main class="layout-detail" id="liveticker" data-tickerID="{{ $ticker->id }}">

<div class="ticker-area">

	<ticker-editor @submitted="refresh_list">{{ $ticker->headline }}</ticker-editor>
	<ticker-list ref="list"></ticker-list>

</div> <!-- end Ticker Area -->

<aside class="autor-area">
	<img class="autor-image" src="{{ auth()->user()->thumbnail }}">
	<h3 class="autor-headline">{{ auth()->user()->username }}</h3>
	<p class="autor-desc">({{ auth()->user()->description }})</p>
</aside>

<aside class="fav-area">
	<h3 class="fav-headline">Favoriten</h3>
	<p>www.energie.de<br />
	www.youtube.com/lr
	</p>
	<p>
	Name: {{ $ticker->name }}<br />
	Typ: {{ $ticker->typ }}<br />
	Start: {{ !is_null($ticker->start) ? $ticker->start->format('d.m.Y') : 'keine Angabe' }}<br />
	Titel: {{ $ticker->headline }}<br />
	Status: {{ $ticker->status }}<br />
	Erstellt von: {{ $ticker->author->username }}<br />
	</p>
	<a class="button block mb" href="{{ $ticker->id }}/edit">Ticker editieren</a>
	<a class="button block mb" href="{{ $ticker->id }}/preview/">Preview</a>
</aside>

</main>




{{--
<section class="posts" v-for="post, postKey in posts">
<div class="post-layout" v-bind:data-post-id="post.id">
	<div @mouseover.once="editPost" @blur="savePost" class="post-content" v-html="post.content"></div>
	<aside class="post-time"><span>@{{post.time}}</span> {{($ticker->typ == 'fussball') ? 'min' : 'Uhr'}}</aside>
	<aside class="post-date">Datum: <span>@{{post.date}}</span></aside>
	<aside class="post-autor">
		Autor: <span>@{{post.author.username}}</span></aside>
	<aside class="post-move">::</aside>
	<aside class="post-delete" v-on:click="delete_post(post,postKey)"></aside>
</div>
</section>
--}}

{{--
<section class="posts">

@foreach ($ticker->posts() as $post)
<div class="post-layout">
	<div class="post-content">{{ $post->content }}</div>
	<aside class="post-time"><span>{{ $post->created_at->format('G:i') }}</span> Uhr</aside>
	<aside class="post-date">Datum: <span>{{ $post->created_at->format('d.M.Y') }}</span></aside>
	<aside class="post-autor">
		Autor: <span>{{ ($post->author) ? $post->author->username : 'Redaktion' }}</span></aside>
	<aside class="post-move">::</aside>
	<aside class="post-delete"></aside>
</div>
@endforeach

</section>
--}}






@endsection()
