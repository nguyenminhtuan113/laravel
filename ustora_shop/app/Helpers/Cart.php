<?php
namespace App\Helpers;
class Cart{
    public $products = null;
    public $totalPrice = 0;
    public $totalQty = 0;
    public function __construct($cart){
        if($cart){
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQty = $cart->totalQty;
        }


    }
    public function addCart($product,$id){
        $newProduct = ['qty' => 0, 'price' => $product->price, 'product' => $product];
        if($this->products){
            if(array_key_exists($id,$this->products)){
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['qty']++;
        $newProduct['price'] = $product->price * $newProduct['qty'];
        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQty++;
    }
}
