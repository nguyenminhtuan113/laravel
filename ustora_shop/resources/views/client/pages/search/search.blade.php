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
                            <form action="{{route('cart.add') }}" method="POST">

                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img src="{{asset('storage/images/'.$product->img)}}" alt="{{$product->img}}">

                                </div>
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
                            @csrf
                            <div class="form-control">
                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                <input type="hidden" name="name" value="{{ $product->name }}" />
                                <input type="hidden" name="price"
                                    value="{{ salePrice($product->price, $product->discount) }}" />
                                <input type="hidden" name="img" value="{{ $product->img }}" />
                                <input type="hidden" name="qty" min="1" value="1" />
                            </div>
                            <button type="submit" class="add_to_cart_button">Add to cart</button>
                                
                            </div>
                            
                            </form>
                            
                        </div>

                    @endforeach

                @endif


            </div>


        </div>
    </div>



@endsection
