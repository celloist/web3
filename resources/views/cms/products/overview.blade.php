@extends('cms.layout.backend')
@section('title', 'Products')
@section('fcontent')
	<a href="{{ URL::Route('beheer.products.create') }}" class="button success">Nieuw product</a>
	@if (count($products) > 0)
		<table>
			<thead>
				<tr>
					<th>Acties</th>
					<th>Naam</th>
					<th>Artikelnr.</th>
					<th>Price</th>
					<th>Categorie</th>
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
						<td>{{ $product->artikelnr }}</td>
						<td>&euro; {{ number_format($product->price, 2, ',', '.') }}</td>
						<td>{{ $product->categories->name }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{!! $products->render() !!}
	@endif
@endsection