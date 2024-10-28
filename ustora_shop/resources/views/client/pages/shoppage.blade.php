@extends('client.index')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <form action="{{route('cart.add')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$product->id}}"/>
                                <input type="hidden" name="name" value="{{$product->name}}"/>
                                <input type="hidden" name="price" value="{{salePrice($product->price,$product->discount)}}"/>
                                <input type="hidden" name="img" value="{{$product->img}}"/>
                                <input type="hidden" name="qty" min="1"  value="1"/>
                            </div>
                            <div class="product-upper">
                                <img src="{{$product->img}}"  alt="">
                            </div>
                            <h2><a href="{{route('productDetail',$product->id)}}">{{$product->name}}</a></h2>
                            <div class="product-carousel-price">
                                <ins>${{number_format(salePrice($product->price,$product->discount),2)}}</ins> <del>${{number_format($product->price),2}}</del>
                            </div>

                            <div class="product-option-shop">
                                <button class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" type="submit">Add to cart</button>
                            </div>
                        </form>

                    </div>
                </div>

            @endforeach

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
