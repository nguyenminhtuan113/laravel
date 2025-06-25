@extends('client.index')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="{{route('search')}}" method="GET">
                            <input type="text" placeholder="Search products..." name="query">
                            <input type="submit" value="Search" class="searchQuery">
                        </form>
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        @foreach($products as $product)
                            <div class="thubmnail-recent">
                                <img src="{{'storage/images/'.$product->img}}" class="recent-thumb" alt="{{$product->name}}">
                                <h2><a href="{{route('productDetail',$product->id)}}">{{$product->name}}</a></h2>
                                @if ($product->discount)
                                    <div class="product-carousel-price">
                                        <ins>{{ number_format(salePrice($product->price, $product->discount)) }}đ</ins>
                                        <del>{{ number_format($product->price) }}đ</del>
                                    </div>
                                @else
                                        <div class="product-carousel-price">
                                        <ins>{{ number_format(salePrice($product->price, $product->discount)) }}đ</ins>
                                        </div>
                                @endif
                            </div>
                        @endforeach


                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">

                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($carts->count() > 0)
                                        @foreach($carts as $item)
                                        
                                                <td class="product-remove">
                                                    <form action="{{route('cart.item.remove',['rowId'=>\Cart::instance('cart')->content()->where('id',$item->id)->first()->rowId])}}" method="post" class="form-submit">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a title="Remove this item" class="remove" href="javascript:void(0)">×</a>
                                                    </form>
                                                </td>

                                                <td class="product-thumbnail">

                                                    <a href="{{route('productDetail',$item->id)}}">
                                                        <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{asset('storage/images/'.$item->options['img'])}}"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="">{{$item->name}}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">{{number_format(salePrice($item->price,$item->discount))}}đ</span>
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity">

                                                        <form action="{{route('cart.decrease-qty',$item->rowId)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="minus">-</div>
                                                        </form>

                                                        <input type="number" name="qty" class="input-text qty text" title="Qty" value="{{$item->qty}}" min="1" >

                                                        <form action="{{route('cart.increase-qty',$item->rowId)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="plus">+</div>
                                                        </form>

                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">{{ number_format($item->price * $item->qty)}}đ</span>
                                                </td>
                                            </tr>

                                    @endforeach
                                    @else

                                        <tr class="cart_item no-items">
                                            <td colspan="6" class="text-danger">No items carts!</td>
                                        </tr>


                                    @endif

                                @if(\Cart::instance('cart')->content()->count()>0)
                                    <tr>
                                        <td class="action" colspan="6" >
                                            <h3>
                                                <b>Total payment: {{\Cart::instance('cart')->subtotal()}} đ</b>
                                            </h3>
                                            <div style="display: flex; justify-content: end; gap: 1px;">
                                                <a href="{{route('checkout')}}"   class="btn btn-primary" style="display:flex; justify-content:center ; align-items: center ;">Checkout</a>
                                                <form action="{{route('cart.removeAllCart')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Clear Cart</button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endif
                                    </tbody>
                                </table>

                            <div class="cart-collaterals">


                                <div class="cross-sells">
                                    <h2>You may be interested in...</h2>
                                    <ul class="products">
                                        @foreach($interestProduct as $interPro)
                                            <li class="product">
                                                <a href="{{route('productDetail',$interPro->id)}}">
                                                    <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="{{'storage/images/'.$interPro->img}}">
                                                    <h3>{{$interPro->name}}</h3>
                                                    <span class="price"><span class="amount"> {{number_format(salePrice($interPro->price,$interPro->discount))}}</span></span>
                                                </a>

                                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="{{route('productDetail',$interPro->id)}}">Detail</a>
                                            </li>

                                        @endforeach


                                    </ul>
                                </div>


                                <div class="cart_totals ">
                                    <h2>Cart Totals</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">{{\Cart::instance('cart')->subtotal()}} đ</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">{{\Cart::instance('cart')->total()}} đ</span></strong> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
