<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{route('home')}}">Home</a></li>
                    <li  class="{{ Request::routeIs('shop') ? 'active' : '' }}" ><a href="{{route('shop')}}">Shop page</a></li>
                    <li class="{{Request::routeIs('cart') ? 'active' : ''}}"><a href="{{route('cart')}}">Cart</a></li>
                    @if (\Cart::instance('cart')->count() >0)
                    <li class="{{Request::routeIs('checkout') ? 'active' : ''}}"><a href="{{route('checkout')}}">Checkout</a></li>
                    @endif
                    <li class="{{Request::routeIs('search') ? 'active' : ''}}"><a href="{{route('search')}}"><i class="fa fa-search"></i> Search</a></li>
                    @if(Auth::check())
                        <li class="{{Request::routeIs('view.order') ? 'active' : ''}}">
                            <a href="{{route('view.order')}}">View Order</a>
                        </li>
                    @endif
                    <li class="{{Request::routeIs('wishlist.index') ? 'active' : ''}}"><a href="{{route('wishlist.index')}}"><i class="fa fa-heart"></i> Wishlist  <span class="product-count">{{\Cart::instance('wishlist')->count()}}</span> </a></li>


                </ul>
            </div>
        </div>
    </div>
</div>
