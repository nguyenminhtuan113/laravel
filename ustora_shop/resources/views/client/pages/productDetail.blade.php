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
                        @if($products->isEmpty())
                            <p class="text-danger">Không tìm thấy kết quả!</p>
                        @endif
                        @foreach($products as $item)
                            <div class="searchResults"></div>
                            <div class="thubmnail-recent">
                                <img src="{{$item->img}}" class="recent-thumb" alt="">
                                <h2><a href="{{route('productDetail',$item->id)}}">{{$item->name}}</a></h2>
                                <div class="product-sidebar-price">
                                    <ins>${{number_format(salePrice($item->price,$item->discount))}}</ins> <del>${{number_format($item->price)}}</del>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Home</a>
                            <a href="">{{$product->category ? $product->category->name : ''}}</a>
                            <a href="">{{$product->name}}</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
{{--                                        {{asset('fe/img/product-2.jpg')}}--}}
                                        <img src="{{$product->img}}" alt="">
                                    </div>

                                    <div class="product-gallery">
                                        @foreach($images as $item )
                                            <img src="{{$item->img}}" alt="{{$item->name}}">

                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$product->name}}</h2>
                                    <div class="product-inner-price">
                                        <ins>${{number_format(salePrice($product->price,$product->discount),2)}}</ins> <del>${{number_format($product->price),2}}</del>
                                    </div>
                                    <div class="d-flex" style="display: flex;justify-content: space-around;">
                                        <form action="{{route('cart.add')}}" method="post" class="cart">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$product->id}}"/>
                                            <input type="hidden" name="name" value="{{$product->name}}"/>
                                            <input type="hidden" name="img" value="{{$product->img}}"/>
                                            <input type="hidden" name="price" value="{{number_format(salePrice($product->price,$product->discount),2)}}"/>
                                            <div class="quantity">
                                                <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1"/>
                                            </div>
                                            <button class="add_to_cart_button" type="submit">Add to cart</button>
                                        </form>
                                        <form action="{{route('wishlist.add')}}" method="post" class="cart">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$product->id}}"/>
                                            <input type="hidden" name="name" value="{{$product->name}}"/>
                                            <input type="hidden" name="img" value="{{$product->img}}"/>
                                            <input type="hidden" name="price" value="{{salePrice($product->price,$product->discount)}}"/>
                                            <div class="quantity">
                                                <input type="hidden"  size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1"/>
                                            </div>
                                            <button class="add_to_cart_button" type="submit"><i class="fa fa-heart"></i> Wishlist</button>
                                        </form>
                                    </div>


                                    <div class="product-inner-category">
                                        <p>Category: <a href="">{{$product->category->name}}</a>. Tags: <a href="">{{$product->tag}}</a>. </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{$product->description}}</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">

                                @foreach($relatedProducts as $relatedProduct)
                                    <form action="{{route('cart.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{$relatedProduct->id}}"/>
                                            <input type="hidden" name="name" value="{{$relatedProduct->name}}"/>
                                            <input type="hidden" name="price" value="{{salePrice($relatedProduct->price,$relatedProduct->discount)}}"/>
                                            <input type="hidden" name="img" value="{{$relatedProduct->img}}"/>
                                            <input type="hidden" name="qty" min="1"  value="1"/>
                                        </div>
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <img src="{{$relatedProduct->img}}" alt="">
                                            <div class="product-hover">

                                                <button type="submit" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                                <a href="{{route('productDetail',$relatedProduct->id)}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                            </div>
                                        </div>

                                        <h2><a href="">{{$relatedProduct->name}}</a></h2>

                                        <div class="product-carousel-price">
                                            <ins>${{salePrice($relatedProduct->price,$relatedProduct->discount)}}</ins> <del>${{$relatedProduct->price}}</del>
                                        </div>
                                    </div>
                                    </form>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
