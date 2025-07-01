@extends('client.index')
@section('content')
    <div class="slider-area">
        <!-- Slider -->
{{--        <h1>{{ __('messages.welcome') }}</h1>--}}
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                <li>
                    <img src="{{ asset('fe/img/h4-slide.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            iPhone <span class="primary">6 <strong>Plus</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Dual SIM</h4>
                        <a class="caption button-radius" href="{{ route('shop') }}"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('fe/img/h4-slide2.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            by one, get one <span class="primary">50% <strong>off</strong></span>
                        </h2>
                        <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                        <a class="caption button-radius" href="{{ route('shop') }}"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('fe/img/h4-slide3.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Select Item</h4>
                        <a class="caption button-radius" href="{{ route('shop') }}"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="{{ asset('fe/img/h4-slide4.png') }}" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">& Phone</h4>
                        <a class="caption button-radius" href="{{ route('shop') }}"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            @if ($products)
                                 @foreach ($products as $product)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{asset('storage/images/'.$product->img)}}" alt="{{$product->img}}">
                                        <div class="product-hover">
                                            <form action="{{ route('cart.add') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{ $product->id }}" />
                                                    <input type="hidden" name="name" value="{{ $product->name }}" />
                                                    <input type="hidden" name="price"
                                                        value="{{ salePrice($product->price, $product->discount) }}" />
                                                    <input type="hidden" name="img" value="{{ $product->img }}" />
                                                    <input type="hidden" name="qty" min="1" value="1" />
                                                </div>

                                                <button type="submit" class="add-to-cart-link"><i
                                                        class="fa fa-shopping-cart"></i> Add to cart</button>
                                            </form>

                                            <a href="{{ route('productDetail', $product->id) }}"
                                                class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2 >
                                        <a href="{{ route('productDetail', $product->id) }}">{{ $product->name }}</a>
                                        
                                        @if (\Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                            <form id="form-removeWishlist"
                                                action="{{ route('wishlist.itemRemove', ['rowId' => \Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fa fa-heart" style="cursor: pointer; color: #0dcaf0;"
                                                    onclick="document.getElementById('form-removeWishlist').submit();"></i>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.add') }}" method="post" class="cart "
                                                id="wishlist-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                                <input type="hidden" name="name" value="{{ $product->name }}" />
                                                <input type="hidden" name="img" value="{{ $product->img }}" />
                                                <input type="hidden" name="price"
                                                    value="{{ salePrice($product->price, $product->discount) }}" />
                                                <div class="quantity">
                                                    <input type="hidden" size="4" class="input-text qty text"
                                                        title="Qty" value="1" name="qty" min="1"
                                                        step="1" />
                                                </div>
                                                <i class=" fa fa-heart text-white" style="cursor: pointer; "
                                                    onclick="document.getElementById('wishlist-form').submit();"></i>
                                            </form>
                                        @endif

                                    </h2>
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
                            @else
                                <div class="text-danger text-center">No data!</div>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="{{ asset('fe/img/brand1.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand2.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand3.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand4.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand5.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand6.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand1.png') }}" alt="">
                            <img src="{{ asset('fe/img/brand2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-1') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-2') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new mac book 2015</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-3') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Recently Viewed</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-4') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-1') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-2') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top New</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-3') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-4') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="{{ asset('fe/img/product-thumb-1') }}.jpg"
                                    alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->
   
@endsection
