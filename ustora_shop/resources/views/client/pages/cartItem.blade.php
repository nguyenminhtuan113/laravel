@if ($newCart)
    <tr class="cart_item">
        <td class="product-remove">
            <a title="Remove this item" class="remove" href="#">×</a>
        </td>

        <td class="product-thumbnail">

            <a href=""><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail"
                    src="{{ $item['product']->img }}"></a>
        </td>

        <td class="product-name">
            <a href="">{{ $item['product']->name }}</a>
        </td>

        <td class="product-price">
            <span class="amount">£{{ $item['product']->price }}</span>
        </td>

        <td class="product-quantity">
            <div class="quantity buttons_added">
                <input type="button" class="minus" value="-">
                <input type="number" size="4" class="input-text qty text" title="Qty" value="1"
                    min="0" step="1">
                <input type="button" class="plus" value="+">
            </div>
        </td>

        <td class="product-subtotal">
            <span class="amount">£{{ $newCart->totalPrice }}</span>
        </td>
    </tr>
@endif
