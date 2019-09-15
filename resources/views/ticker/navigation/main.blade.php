<nav class="nav-top flundrApp">
	<ul class="left">
		<li><a href="/ticker">LR - Liveticker</a></li>
	</ul>

	<div class="nav-headline">@yield('navtitle', '')</div>

	<fl-menu class="right" direction="left" background="var(--lrblau)" v-cloak>
		<menu-item href="/ticker/create">Neuer Ticker</menu-item>
		<menu-item href="/profil">Profil</menu-item>
		<menu-item href="/admin">Admin</menu-item>
		@auth
		<menu-item href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
			Logout
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
		</menu-item>
		@endauth
	</fl-menu>

</nav>