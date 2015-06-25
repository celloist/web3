@extends('layout.frontend')

@section('content')
        @include('partials.menu')
    <div class="row">

        <div class="large-12 columns">
            <div class="row">


                <div class="large-8 columns">
                    <div class="row">
                        @foreach ($categories as $category)

                        <div class="large-4 small-6 columns" id="{{$category->id}}">
                            <a href="{{url('categories/'.$category->id)}}">
                            <img src="http://placehold.it/1000x1000&text=Thumbnail">

                            <div class="panel">
                                <h5>{{$category->name}}</h5>
                            </div>
                                </a>
                        </div>


                        @endforeach

                    </div>

                    <div class="row">
                        <div class="large-12 columns">
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
                        </div>
                    </div>
                </div>
            </div>




            <footer class="row">
                <div class="large-12 columns"><hr/>
                    <div class="row">

                        <div class="large-6 columns">
                            <p>© Copyright Cthulu productions  </p>
                        </div>


                    </div>
                </div>
            </footer>



        </div>
    </div>
@endsection