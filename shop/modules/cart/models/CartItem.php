<?php

namespace modules\cart\models;

use common\models\Product;

/**
 * CartItem represents a single item in the shopping cart
 */
class CartItem
{
    public $product_id;
    public $quantity;

    public function __construct($product_id, $quantity = 1)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return Product::findOne($this->product_id);
    }

    public function getPrice()
    {
        $product = $this->getProduct();
        return $product ? $product->price : 0;
    }

    public function getTotal()
    {
        return $this->getPrice() * $this->quantity;
    }
}