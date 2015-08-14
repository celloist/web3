@extends('layout.frontend')
@section('fcontent')
    <div class="row">
        <div class="large-12 columns">
            <div class="row">

                <div id = detail-page class="large-4 small-12 columns">

                    <img src="http://placehold.it/500x500&text=Logo">

                    <div class="hide-for-small panel">

                        <h3 id="name">{{$first->name}}</h3>
                        <h5 id="detail" class="subheader">{{$first->detail}}</h5>
                        <h5 id="price">&#8364;{{$first->price}}</h5>
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

                        <div class="large-4 small-6 columns detail" data-id="{{$product->id}}">
                            <img src="http://placehold.it/1000x1000&text=Thumbnail">
                            <div class="panel">

                                <h5>{{$product->name}}</h5>
                                <h6 class="subheader">&#8364;{{$product->price}}</h6>
                                <h6>  <i class="fi-shopping-cart small"></i></h6>
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
@section('scripts')
    @parent
<script>
    $(document).ready(function(){
        $('.detail').on('click' ,function(){
            var product = null;
            var id = $(this).data('id');
            $.ajax({
                url: '/ajax/products/'+id,
                method: "get",
                dataType: 'json',
                 success: function(data){
                     product = data.product;
                     $('#name').text(product['name']);
                     $('#detail').text(product['detail']);;
                     $('#price').text(product['price'])
                }
            }
            );

        });
    });
</script>
    @endsection