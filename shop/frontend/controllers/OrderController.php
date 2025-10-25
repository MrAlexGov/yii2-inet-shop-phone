<?php

namespace frontend\controllers;

use frontend\models\OrderForm;
use common\models\Order;
use common\models\OrderItem;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Order controller
 */
class OrderController extends Controller
{
    public function actionCreate()
    {
        $cart = Yii::$app->cart->getItems();

        if (empty($cart)) {
            Yii::$app->session->setFlash('error', 'Ваша корзина пуста.');
            return $this->redirect(['cart/index']);
        }

        $model = new OrderForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Создаем заказ
            $order = new Order();
            $order->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $order->status = 'pending';
            $order->total_amount = Yii::$app->cart->getTotalPrice();

            if ($order->save()) {
                // Сохраняем элементы заказа
                foreach ($cart as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->product_id;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $item->getPrice();
                    $orderItem->save();
                }

                // Очищаем корзину
                Yii::$app->cart->clear();

                // Показываем сообщение об успехе
                Yii::$app->session->setFlash('success', 'Заказ успешно оформлен! Номер заказа: ' . $order->id);

                return $this->redirect(['create']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'cart' => $cart,
        ]);
    }
}