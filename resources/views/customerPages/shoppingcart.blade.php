@extends('layout.frontend')

@section('fcontent')
    <div class="row">
        <div class="large-12 columns">
            <div class="row" id="cart-frame">
                <form>
                    <table class="t-shoppingcart">
                        <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Remove</th>
                            <th>Image</th>
                        </tr>
                        </thead>

                        <tbody class="tb-cart">
                        @foreach($shoppingcart as $item)
                        <tr data-id="{{ $item->id }}" class="cart-row-item">
                            <td class="td-quantity">
                                <input type="text" value="{{ $item->quantity }}" class="cart-item-quantity small" style="width: 3em;" />
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>

                            <td>
                                &euro; {{ $item->price }}
                            </td>

                            <td>
                                <a href="#"><i class="fi-x remove-item" data-id="{{ $item->id }}"></i></a>
                            </td>
                            <td>
                                <a class="th" href="#"><img style="max-height: 80px; max-width: 80px;" src="{{ relative_images_path() . '/'. $item->artikelnr . '/' . $item->small_image_link }}"></a>
                            </td>
                        </tr>
                        @endforeach
                        
                        <h2 class="h2-state">{{$state}}</h2>
                    </tbody>
                    </table>
                </form>
                
                <div class="checkout">
                    <a href="{{url('checkout')}}" class="button bt-checkout">Check out</a>
                </div>
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
                        
                    }
                });
            });

            $('.tb-cart').on('change','.cart-item-quantity' ,function(){
                
                var quantity = parseInt($(this).val());
                var id = $(this).parents('.cart-row-item').data('id');

                if (quantity > 1) {
                    $.ajax({
                        url: '/ajax/update-item-quantity/'+id,
                        method: "get",
                        dataType: 'json',
                        success: function(data) {
                            $('.li-cart').text(""+data.pCount+ " items in your cart");
                            
                        }
                    });
                }
            });

            function updateCart () {

            }
        });
    </script>
@endsection