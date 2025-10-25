<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\Product;

/**
 * Cart controller for the `cart` module
 */
class CartController extends Controller
{
    public function actionAdd($id, $quantity = 1)
    {
        $product = Product::findOne($id);

        if (!$product) {
            throw new \yii\web\NotFoundHttpException('Товар не найден.');
        }

        Yii::$app->cart->add($id, $quantity);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => true,
                'totalQuantity' => Yii::$app->cart->getTotalQuantity(),
                'totalPrice' => Yii::$app->cart->getTotalPrice(),
            ];
        }

        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
        $items = Yii::$app->cart->getItems();

        return $this->render('index', [
            'items' => $items,
        ]);
    }

    public function actionUpdate($id, $quantity)
    {
        Yii::$app->cart->update($id, $quantity);

        return $this->redirect(['index']);
    }

    public function actionRemove($id)
    {
        Yii::$app->cart->remove($id);

        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        Yii::$app->cart->clear();

        return $this->redirect(['index']);
    }
}