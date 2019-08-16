@extends('FlundrCMS.layout.default')

@section('title', 'Admin Area')
@section('description', 'Admin Area')

@section('body')

@include('FlundrCMS.navigation.main')

<main>
<h1>Admin Area</h1>
<p>User Bearbeiten:</p>

<table class="fancy">
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>Rechte</th>
		<th>E-Mail</th>
		<th>Bearbeiten</th>
	</tr>
	@foreach ($users as $user)

	<tr style="position:relative">

		<td>{{ $user->id }}</td>
		<td><a href="admin/user/{{ $user->id }}/edit">{{ $user->username }}</a></td>
		<td>{{ $user->vorname }}</td>
		<td>{{ $user->nachname }}</td>
		<td>{{ $user->rights }}</td>
		<td>{{ $user->email }}</td>
		<td><a href="admin/user/{{ $user->id }}/edit">Edit</a></td>
	</tr>
	@endforeach
</table>

<a href="/admin/user/create" class="button">Neuen User Anlegen</a>

</main>
@endsection()







