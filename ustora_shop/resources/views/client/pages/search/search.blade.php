@extends('client.index')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Search product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="{{route('search')}}" method="GET">
                        <input type="text" placeholder="Search products..." name="query">
                        <input type="submit" value="Search" class="searchQuery">
                    </form>
                </div>
                @if($products->isEmpty())
                    <p class="text-danger">Không tìm thấy kết quả !</p>
                @else
                    @foreach($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img src="{{$product->img}}" alt="">
                                </div>
                                <h2><a href="{{route('productDetail',$product->id)}}">{{$product->name}}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>${{number_format(salePrice($product->price,$product->discount),2)}}</ins> <del>${{number_format($product->price,2)}}</del>
                                </div>

                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{route('cart.add',$product->id)}}">Add to cart</a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                @endif


            </div>


        </div>
    </div>



@endsection
