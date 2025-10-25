<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Order;
use common\models\Product;

/**
 * Dashboard controller for the backend.
 */
class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays the dashboard page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userCount = User::find()->count();
        $orderCount = Order::find()->count();
        $productCount = Product::find()->count();
        $totalRevenue = Order::find()->sum('total_amount');

        $recentOrders = Order::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(10)
            ->all();

        return $this->render('index', [
            'userCount' => $userCount,
            'orderCount' => $orderCount,
            'productCount' => $productCount,
            'totalRevenue' => $totalRevenue,
            'recentOrders' => $recentOrders,
        ]);
    }
}