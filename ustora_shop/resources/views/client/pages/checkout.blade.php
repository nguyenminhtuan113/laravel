@extends('client.index')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shipping Detail</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            {{--                            @if ($address) --}}
                            {{--                                <div class="row"> --}}
                            {{--                                    <div class="col-md-12"> --}}
                            {{--                                        <div class="my-account_address-list"> --}}
                            {{--                                            <div class="my-account_address-list-item"> --}}
                            {{--                                                <div class="my-account_address-list-item_detail"> --}}
                            {{--                                                    <h3>Customer Infomation</h3> --}}
                            {{--                                                    <p>Name: {{$address->name}}</p> --}}
                            {{--                                                    <p>Phone number: {{$address->phone}}</p> --}}
                            {{--                                                    <p>Address: {{$address->address}}</p> --}}
                            {{--                                                    <p>Landmark: {{$address->landmark}}</p> --}}
                            {{--                                                    <p>House no, Buiding Name: {{$address->city}}, {{$address->state}}, {{$address->country}}</p> --}}
                            {{--                                                    <p>Zip code: {{$address->zip}}</p> --}}

                            {{--                                                </div> --}}
                            {{--                                            </div> --}}
                            {{--                                        </div> --}}
                            {{--                                    </div> --}}
                            {{--                                </div> --}}
                            {{--                            @else --}}
                            <form enctype="multipart/form-data" action="{{ route('cart.place.an.order') }}"
                                id="checkout-place" method="post" name="checkout">
                                @csrf
                                <div id="customer_details" class="col2-set">
                                    <div class="col-8">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing Details</h3>

                                            <p id="billing_first_name_field"
                                                class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">Full Name <abbr
                                                        title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('name') }}" placeholder=""
                                                    id="billing_first_name" name="name" class="input-text ">
                                                @error('name')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_phone_field"
                                                class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required"
                                                        class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('phone') }}" placeholder=""
                                                    id="billing_phone" name="phone" class="input-text " required>
                                                @error('phone')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>
                                            <div class="clear"></div>
                                            <p id="billing_pincode"
                                                class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="">Pincode/zip <abbr title="required"
                                                        class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('zip') }}" placeholder=""
                                                    id="billing_pincode" name="zip" class="input-text ">
                                                @error('zip')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_State" class="form-row form-row-wide">
                                                <label class="" for="billing_State">State</label>
                                                <input type="text" value="{{ old('state') }}" placeholder=""
                                                    id="billing_State" name="state" class="input-text ">
                                                @error('state')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>

                                            <p id="billing_city_field"
                                                class="form-row form-row-wide address-field validate-required"
                                                data-o_class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_city">Town / City <abbr title="required"
                                                        class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('city') }}" placeholder="Town / City"
                                                    id="billing_city" name="city" class="input-text ">
                                                @error('city')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>

                                            <p id="billing_address_field"
                                                class="form-row form-row-first address-field validate-state"
                                                data-o_class="form-row form-row-first address-field validate-state">
                                                <label class="" for="billing_address">House no, Buiding Name</label>
                                                <input type="text" id="billing_address" name="address"
                                                    placeholder="House no, Buiding Name" value="{{ old('address') }}"
                                                    class="input-text ">
                                                @error('address')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>
                                            <p id="billing_postcode_field"
                                                class="form-row form-row-last address-field validate-required validate-postcode"
                                                data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                                <label class="" for="billing_postcode">Road Name, Area, Colony <abbr
                                                        title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('locality') }}"
                                                    placeholder="Postcode / Zip" id="billing_postcode" name="locality"
                                                    class="input-text ">
                                                @error('locality')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_landmark"
                                                class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_landmark">Landmark <abbr
                                                        title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{ old('landmark') }}" placeholder=""
                                                    id="billing_landmark" name="landmark" class="input-text ">
                                                @error('landmark')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </p>



                                        </div>
                                    </div>



                                </div>
                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked"
                                                value="cod" name="mode" class="input-radio"
                                                id="payment_method_bacs">
                                            <label for="payment_method_bacs">Ship code </label>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cheque"
                                                name="mode" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">Cheque Payment </label>

                                        </li>
                                        <li class="payment_method_paypal">
                                            <input type="radio" data-order_button_text="Proceed to PayPal"
                                                value="paypal" name="mode" class="input-radio"
                                                id="payment_method_paypal">
                                            <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark"
                                                    src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a
                                                    title="What is PayPal?"
                                                    onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"
                                                    class="about_paypal"
                                                    href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is
                                                    PayPal?</a>
                                            </label>
                                            <div style="display:none;" class="payment_box payment_method_paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                    PayPal account.</p>

                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-row place-order" style="display: flex;gap: 5px">

                                        <input type="submit" data-value="Place order" value="Place order"
                                            onclick="document.getElementById('checkout-place').submit();" id="place_order"
                                            name="woocommerce_checkout_place_order" class="button alt">

                                        <form action="{{ route('cart.order.confirmation') }}" method="Get">
                                            @csrf
                                            <button type="submit">View Order</button>
                                        </form>
                                        
                                    </div>

                                    <div class="clear"></div>
                                </div>


                            </form>
                            {{--                            @endif --}}


                        </div>
                    </div>


                </div>
                <div class="col-md-4">
                    <h3 id="order_review_heading">Your order</h3>

                    <div id="order_review" style="position: relative;">
                        <table class="shop_table">
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\Cart::instance('cart')->content() as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item->name }} <strong class="product-quantity">×
                                                {{ $item->qty }}</strong> </td>
                                        <td class="product-total">
                                            <span class="amount">{{ formatToVND($item->subtotal()) }}đ</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr class="cart-subtotal">
                                    <th> Subtotal</th>
                                    <td><span class="amount">{{formatToVND(\Cart::instance('cart')->subtotal())}}đ</span>
                                    </td>
                                </tr>

                                <tr class="shipping">
                                    <th>Shipping and Handling</th>
                                    <td>

                                        Free Shipping
                                        <input type="hidden" class="shipping_method" value="free_shipping"
                                            id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                    </td>
                                </tr>


                                <tr class="order-total">
                                    <th>Total</th>
                                    <td><strong><span
                                                class="amount">{{formatToVND(\Cart::instance('cart')->subtotal())}}đ</span></strong>
                                    </td>
                                </tr>

                            </tfoot>


                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
