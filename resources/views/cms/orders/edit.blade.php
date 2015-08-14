@extends('cms.layout.backend')
@section('title', 'Bewerk order')
@section('fcontent')
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="/js/vendors/jquery-ui.js"></script>
	@if (count($errors) > 0)
		<div data-alert="" class="alert-box alert">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	        
	    </div>
	@endif

	{!! Form::model($order, ['route' => ['beheer.orders.update', $order->id], 'method' => 'put']) !!}
		<div class="row">
		    <div class="large-12 columns">
		      <label>Land
		        {!! Form::text('country') !!}
		      </label>
		    </div>
		</div>

		<div class="row">
		    <div class="large-12 columns">
		      <label>Woonplaats
		        {!! Form::text('city') !!}
		      </label>
		    </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
		      <label>Adres 
		        {!! Form::text('adres') !!}
		      </label>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
		      <label>Zip 
		        {!! Form::text('zip') !!}
		      </label>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
		      <label>Leverdatum 
		        {!! Form::text('adres') !!}
		      </label>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<button type="submit" role="button" aria-label="submit form" class="button">Verstuur</button>
			</div>
		</div>
	{!! Form::close() !!}
@endsection