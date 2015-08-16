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

                    <tbody>
                    @foreach($shoppingcart as $item)
                    <tr>
                        <td class="td-quantity">Quantity {{$item->quantity}}</td>
                        <td>{{$item->name}}</td>
                        <td><a href="#"><i class="fi-x remove-item" data-id="{{$item->id}}"></i></a></td>
                        <td><a class="th" href="#"><img src="{{$item->small_image_link}}"></a></td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>


@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){
            $('.remove-item').on('click' ,function(){
                var pCount = 0;
                var id = $(this).data('id');
                $.ajax({
                            url: '/ajax/removeitem/'+id,
                            method: "get",
                            dataType: 'json',
                            success: function(data) {
                                $('.li-cart').text(""+(pCount - 1) + " items in your cart");
                                location.reload();
                            }
                        }
                );


            });
        });
    </script>
@endsection