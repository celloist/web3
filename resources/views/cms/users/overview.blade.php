@extends('cms.layout.backend')
@section('title', 'Gebruikers')
@section('fcontent')
	<a href="{{ URL::Route('beheer.users.create') }}" class="button success">Nieuwe gebruiker</a>
	<table>
		<thead>
			<tr>
				<th>Acties</th>
				<th>Naam</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>
						<a href="{{ URL::Route('beheer.users.edit', ['id' => $user->id]) }}" class="button tiny">Bewerk</a>
						<a href="{{ URL::Route('beheer.users.destroy', ['id' => $user->id]) }}" class="button tiny alert">Verwijder</a>
					</td>
					<td>{{ $user->name . ' ' . $user->last_name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection