@extends('cms.layout.backend')
@section('title', 'Products')
@section('fcontent')
	<table>
		<thead>
			<tr>
				<th>Acties</th>
				<th>Naam</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($products as $product)
				<tr>
					<td>
						<a href="{{ URL::Route('beheer.products.edit', ['id' => $product->id]) }}" class="button tiny">Bewerk</a>
						<a href="{{ URL::Route('beheer.products.destroy', ['id' => $product->id]) }}" class="button tiny alert">Verwijder</a>
					</td>
					<td>{{ $product->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection