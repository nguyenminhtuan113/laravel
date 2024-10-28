@extends('client.index')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Wishlist</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart table">
                                    <thead>
                                    <tr>
                                        <th class="product-name col-6">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity ">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($items->count() > 0)
                                        @foreach($items as $item)

                                            <tr class="cart_item" >


                                                <td class="product-thumbnail">

                                                    <a href="{{route('productDetail',$item->id)}}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{$item->options['img']}}"></a>
                                                    <p>{{$item->name}}</p>
                                                </td>

{{--                                                <td class="product-name">--}}
{{--                                                    <a href="">{{$item->name}}</a>--}}
{{--                                                </td>--}}

                                                <td class="product-price">
                                                    <span class="amount">£{{number_format(salePrice($item->price,$item->discount),2)}}</span>
                                                </td>

                                                <td class="product-quantity">
                                                    {{$item->qty}}
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">£{{ $item->subtotal()}}</span>
                                                </td>
                                                <td>
                                                    <form action="{{route('wishlist.itemRemove',$item->rowId)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" btn-close">x</button>
                                                    </form>
                                                </td>
                                                <td class="c"></td>
                                            </tr>
                                            <tr>
                                                <td class="action" colspan="6" >
                                                    <form action="{{route('wishlist.removeAll')}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">Clear Wishlist</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else

                                        <tr class="cart_item no-items">
                                            <td colspan="6" class="text-danger">No items!</td>
                                        </tr>


                                    @endif


                                    </tbody>
                                </table>
                            </form>


                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
