@extends('layout.main')

@section('content')
	<h1>Login</h1>
	<form action="" method="post">
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
	</form>
@endsection