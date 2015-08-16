@extends('layout.main')

@section('content')
@if (count($errors) > 0)
	<div data-alert="" class="alert-box alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    </div>
@endif

	<h1>Login</h1>
	{!! Form::open(['route' => ['cmsLoginPost'], 'method' => 'post']) !!}
		<div class="row">
		    <div class="large-12 columns">
		      <label>Username
		        <input type="text" placeholder="username" name="username" />
		      </label>
		    </div>
		</div>

		<div class="row">
		    <div class="large-12 columns">
		      <label>Password
		        <input type="password" name="password" />
		      </label>
		    </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<button type="submit" role="button" aria-label="submit form" class="button">Submit</button>
			</div>
		</div>
	{!! Form::close() !!}
@endsection