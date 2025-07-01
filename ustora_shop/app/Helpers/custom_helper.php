<?php
function salePrice($price, $discount)
{
    if ($discount > 0) {
        return $price - ($price * $discount / 100);
    }
    return $price;
}

function formatToVND($str)
{
    $number = (float)str_replace(',', '', $str);
    return number_format($number, 0, ',', '.');
}
