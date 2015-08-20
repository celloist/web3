@extends('cms.layout.backend')
@section('title', 'Orders')
@section('fcontent')
	<table>
		<thead>
			<tr>
				<th>Acties</th>
				<th>Totaal prijs</th>
				<th>Geplaatst op</th>
				<th>Leveren op</th>
				<th>Status</th>
				<th>Klant</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($orders as $order)
				<tr>
					<td>
						<a href="{{ URL::Route('beheer.orders.edit', ['id' => $order->id]) }}" class="button tiny">Bewerk</a>
						<a href="{{ URL::Route('beheer.orders.destroy', ['id' => $order->id]) }}" class="button tiny alert">Verwijder</a>
					</td>
					<td>&euro; {{ number_format($order->total, 2, ',', '.') }}</td>
					<td>{{ $order->formatted_create_date }}</td>
					<td>{{ $order->formatted_deliver_date }}</td>
					<td>{{ $orderStates[$order->status] }}</td>
					<td>{{ $order->user->name . ' ' . $order->user->last_name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection