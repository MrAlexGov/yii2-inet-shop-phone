<?php

namespace modules\cart\components;

use modules\cart\models\CartItem;
use common\models\Product;
use Yii;
use yii\base\Component;

/**
 * Cart component for managing shopping cart in session
 */
class Cart extends Component
{
    public function add($product_id, $quantity = 1)
    {
        $cart = $this->getCart();

        if (isset($cart[$product_id])) {
            $cart[$product_id]->quantity += $quantity;
        } else {
            $cart[$product_id] = new CartItem($product_id, $quantity);
        }

        $this->saveCart($cart);
    }

    public function update($product_id, $quantity)
    {
        $cart = $this->getCart();

        if ($quantity <= 0) {
            unset($cart[$product_id]);
        } else {
            if (isset($cart[$product_id])) {
                $cart[$product_id]->quantity = $quantity;
            }
        }

        $this->saveCart($cart);
    }

    public function remove($product_id)
    {
        $cart = $this->getCart();
        unset($cart[$product_id]);
        $this->saveCart($cart);
    }

    public function clear()
    {
        Yii::$app->session->remove('cart');
    }

    public function getCart()
    {
        $cart = Yii::$app->session->get('cart', []);
        $result = [];

        foreach ($cart as $product_id => $item) {
            if (is_array($item)) {
                $result[$product_id] = new CartItem($item['product_id'], $item['quantity']);
            } else {
                $result[$product_id] = $item;
            }
        }

        return $result;
    }

    public function getItems()
    {
        return $this->getCart();
    }

    public function getTotalQuantity()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item->quantity;
        }

        return $total;
    }

    public function getTotalPrice()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }

    private function saveCart($cart)
    {
        $data = [];
        foreach ($cart as $product_id => $item) {
            $data[$product_id] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ];
        }

        Yii::$app->session->set('cart', $data);
    }
}