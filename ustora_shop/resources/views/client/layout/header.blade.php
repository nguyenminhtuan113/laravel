<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>

                        @if (Auth::check() && Auth::user())
                            <li><i class="fa fa-user"></i>{{Auth::user()->name}}</li>
                           <li>
                               <a href="{{route('logout')}}" class="dropbtn" onclick="return confirm('Bạn có chắc chắn?')"><i class="fa fa-share-square"></i> Logout</a>
                           </li>
                        @else
                            <li>
                                <a href="{{route('login')}}" class="dropbtn"><i class="fa fa-user"></i> Login</a>
                            </li>
                        @endif
                        <li><a href="{{route('wishlist.index')}}"><i class="fa fa-heart"></i> Wishlist</a></li>

                        <li><a href="{{route('cart')}}"><i class="fa fa-user"></i> My Cart</a></li>

                        <li><a href="{{route('checkout')}}"><i class="fa fa-user"></i> Checkout</a></li>

                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="{{asset('fe/img/logo.png')}}"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
{{--                    @if(\Cart::instance('cart')->content()->count()>0)--}}
                        <a href="{{route('cart')}}">Cart - <span class="cart-amunt">${{\Cart::instance('cart')->subtotal()}}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{\Cart::instance('cart')->content()->count()}}</span></a>
{{--                    @else--}}
{{--                        <a href="{{route('cart')}}">Cart - <span class="cart-amunt">${{\Cart::instance('cart')->subtotal()}}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">0</span></a>--}}

{{--                    @endif--}}

                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->
