<nav class="nav-top">
	<ul class="left">
		<li><a href="/ticker">LR - Liveticker</a></li>
	</ul>

	@if (isset($ticker))
	<div class="nav-headline"><a target="_blank" href="{{env('API_STORAGE_URL')}}/view/{{ $ticker->id }}">@yield('navtitle', '')</a></div>
	@endif

	<fl-menu class="right" direction="left" background="var(--lrblau)" v-cloak>
		<menu-item href="/ticker/create">Neuer Ticker</menu-item>
		@if (isset($ticker))
		<menu-item href="/ticker/{{ $ticker->id }}/edit">Einstellungen</menu-item>
		@endif
		@auth
		<menu-item href="/profil">Profil</menu-item>
		<menu-item href="/admin">Admin</menu-item>
		<menu-item href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
			Logout
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
		</menu-item>
		@endauth
	</fl-menu>
</nav>