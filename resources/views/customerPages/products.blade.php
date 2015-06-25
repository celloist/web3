@extends('layout.frontend')

@section('fcontent')
    <div class="row">
        <div class="large-12 columns">
            <div class="row">

                <div class="large-4 small-12 columns">

                    <img src="http://placehold.it/500x500&text=Logo">

                    <div class="hide-for-small panel">

                        <h3>{{$first->name}}</h3>
                        <h5 class="subheader">{{$first->detail}}</h5>
                        <h5>&#8364;{{$first->price}}</h5>
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
                                <h6 class="subheader">&#8364;{{$product->price}}</h6>
                            </div>
                        </div>
                            @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>

</script>