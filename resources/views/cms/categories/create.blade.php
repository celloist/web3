@extends('cms.layout.backend')
@section('title', 'Nieuwe categorie')
@section('fcontent')
	@if (count($errors) > 0)
		<div data-alert="" class="alert-box alert">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	        
	    </div>
	@endif
	<form action="{{ URL::Route('beheer.categories.store') }}" method="post">
		<div class="row">
		    <div class="large-12 columns">
		      <label>Naam
		        <input type="text" placeholder="..." name="name" />
		      </label>
		    </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<button type="submit" role="button" aria-label="submit form" class="button">Verstuur</button>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
@endsection