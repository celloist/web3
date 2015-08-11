@extends('layout.main')

@section('content')
    <div class="container">
        <header>
            <h1>CMS</h1>
            <nav>
                <ul>
                    <li><a href="{{ URL::route('beheer.dashboard.index') }}">Dashboard</a></li>
                    <li><a href="{{ URL::route('beheer.categories.index') }}">Categories</a></li>
                    <li><a href="{{ URL::route('beheer.products.index') }}">Products</a></li>
                    <li><a href="{{ URL::route('beheer.users.index') }}">Gebruikers</a></li>
                </ul>
            </nav>


        </header>
        <div class="content">
            <h2>@yield('title')</h1>
            <div class="content">
                @yield('fcontent')
            </div>
        </div>
        <footer class="row">
            <div class="large-12 columns"><hr/>
                <div class="panel">
                    <div class="row">

                        <div class="large-2 small-6 columns">
                            <img src="{{ asset('images/cthulu.jpg') }}">
                        </div>

                        <div class="large-10 small-6 columns">
                            <strong>This Site Is Managed By</strong>

                            Our overlord Cthulu
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns">
                        <p>&copy; Copyright Cthulu productions  </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>    
@endsection

