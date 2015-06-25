@extends('layout.main')
@section('content')
    @include('partials.menu')

    @yield('fcontent')
    <footer class="row">
        <div class="large-12 columns"><hr/>
            <div class="panel">
                <div class="row">

                    <div class="large-2 small-6 columns">
                        <img src="{{asset('images/cthulu.jpg')}}">
                    </div>

                    <div class="large-10 small-6 columns">
                        <strong>This Site Is Managed By</strong>

                        Our overlord Cthulu
                    </div>

                </div>
            </div>
            <div class="row">


                <div class="large-6 columns">
                    <p>� Copyright Cthulu productions  </p>
                </div>


            </div>
        </div>
    </footer>
@endsection
