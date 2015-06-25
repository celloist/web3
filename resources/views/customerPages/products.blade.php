@extends('layout.frontend')

@section('content')
        @include('partials.menu')
    <div class="row">
        <div class="large-12 columns">
            <div class="row">

                <div class="large-4 small-12 columns">

                    <img src="http://placehold.it/500x500&text=Logo">

                    <div class="hide-for-small panel">

                        <h3>{{$first->name}}</h3>
                        <h5 class="subheader">Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum odio ornare sagittis.
                        </h5>
                        <h5>${{$first->price}}</h5>
                    </div>

                    <a href="#">
                        <div class="panel callout radius">
                            <h6>0 items in your cart</h6>
                        </div>
                    </a>

                </div>


                <div class="large-8 columns">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="large-4 small-6 columns">
                            <img src="http://placehold.it/1000x1000&text=Thumbnail">

                            <div class="panel">
                                <h5>{{$product->name}}</h5>
                                <h6 class="subheader">${{$product->price}}</h6>
                            </div>
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
<script>

</script>