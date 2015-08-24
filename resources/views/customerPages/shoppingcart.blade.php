@extends('layout.frontend')

@section('fcontent')
    <div class="row">
        <div class="large-12 columns">
            <div class="row">
                <table class="t-shoppingcart">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Product Name</th>
                        <th>Remove</th>
                        <th>Image</th>
                    </tr>
                    </thead>

                    <tbody class="tb-cart">
                    @foreach($shoppingcart as $item)
                    <tr>
                        <td class="td-quantity">Quantity {{$item->quantity}}</td>
                        <td>{{$item->name}}</td>
                        <td><a href="#"><i class="fi-x remove-item" data-id="{{$item->id}}"></i></a></td>
                        <td><a class="th" href="#"><img src="{{$item->small_image_link}}"></a></td>
                    </tr>
                        @endforeach
                    <h2 class="h2-state">{{$state}}</h2>
                    </tbody>
                </table>
                <div class="checkout"><a href="{{url('checkout')}}" class="button bt-checkout">Check out</a></div>
                </div>
            </div>
        </div>


@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){
            $('.tb-cart').on('click','i.remove-item' ,function(){
                var id = $(this).data('id');
                $.ajax({
                            url: '/ajax/removeitem/'+id,
                            method: "get",
                            dataType: 'json',
                            success: function(data) {
                                $('.li-cart').text(""+data.pCount+ " items in your cart");
                                $('.tb-cart').html("");
                                $('.h2-state').text(data.state);
                                var products = data.products;
                                console.log(products.length);
                                if(products.length>0) {
                                    $('.bt-checkout').bind('click');
                                }
                                else
                                {

                                    $('.bt-checkout').unbind('click');
                                }
                                for(var i=0;i<products.length;i++)
                                {
                                    check = true;
                                    $('.tb-cart').html( $('.tb-cart').html() + ' <tr>'
                                        +'<td class="td-quantity">Quantity '+products[i].quantity+'</td>'
                                        +'<td>'+products[i].name+'</td>'
                                        +'<td><a href="#"><i class="fi-x remove-item" data-id="'+products[i].id+'"></i></a></td>'
                                        +'<td><a class="th" href="#"><img src="'+products[i].small_image_link+'"></a></td>'
                                        +'</tr>')
                                }



                            }

                        }
                );


            });
        });
    </script>
@endsection