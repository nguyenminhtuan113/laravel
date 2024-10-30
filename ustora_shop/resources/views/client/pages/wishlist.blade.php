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
                                <table cellspacing="0" class="shop_table cart table">
                                    <thead>
                                    <tr>
                                        <th class="product-name col-6">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity ">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th>Action</th>
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

                                                <td class="product-price">
                                                    <span class="amount">£{{number_format(salePrice($item->price,$item->discount),2)}}</span>
                                                </td>

                                                <td class="product-quantity">
                                                    {{$item->qty}}
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">£{{ $item->subtotal()}}</span>
                                                </td>
                                                <td style="display: flex; gap: 5px; justify-content: center">
                                                    <form id="form-removeWishlist"
                                                          action="{{ route('wishlist.itemRemove', ['rowId' => \Cart::instance('wishlist')->content()->where('id', $item->id)->first()->rowId]) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
{{--                                                        <a href="javascript:void(0);" onclick="document.getElementById('form-removeWishlist').submit();"><i class="fa fa-trash"></i></a>--}}
                                                        <button type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <br/>
                                                    <form action="{{route('wishlist.moveToCart',$item->rowId)}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="{{$item->img}}">
                                                        <button type="submit">Move to cart</button>
                                                    </form>

                                                </td>
                                            </tr>

                                        @endforeach
                                    @else

                                        <tr class="cart_item no-items">
                                            <td colspan="6" class="text-danger">No items!</td>
                                        </tr>


                                    @endif
                                    @if(\Cart::instance("wishlist")->content()->count() > 0)
                                        <tr>
                                            <td class="action" colspan="6" >
                                                <form action="{{route('wishlist.removeAll')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Clear Wishlist</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>


                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
