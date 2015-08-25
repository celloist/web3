@extends('layout.frontend')

@section('fcontent')
    <div class="row">
    <div class="large-12 columns">
    @if (count($errors) > 0)
        <div data-alert="" class="alert-box alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            
        </div>
    @endif
    <form method="POST" action="/login">
        {!! csrf_field() !!}

        <div class="large-3 rows">
            Username
            <input type="text" name="username" value="{{ old('username') }}">
        </div>

        <div class="large-3 rows">
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    </div>
    </div>
@endsection    