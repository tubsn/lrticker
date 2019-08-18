<nav class="nav-top">
	<ul class="left">
		<li><a href="/ticker">LR - Liveticker</a></li>
	</ul>

	<div class="nav-headline">@yield('navtitle', '')</div>

	<ul class="right">
		<li><a href="/profil">Profil</a></li>
		<li><a href="/admin">Admin</a></li>
		@auth
		<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
		</li>
		@endauth
	</ul>


</nav>