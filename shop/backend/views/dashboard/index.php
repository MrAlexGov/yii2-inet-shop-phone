<?php

/** @var yii\web\View $this */
/** @var int $userCount */
/** @var int $orderCount */
/** @var int $productCount */
/** @var float $totalRevenue */
/** @var array $recentOrders */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Пользователи</h5>
                <p class="card-text"><?php echo $userCount; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Заказы</h5>
                <p class="card-text"><?php echo $orderCount; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Товары</h5>
                <p class="card-text"><?php echo $productCount; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Выручка</h5>
                <p class="card-text"><?php echo number_format($totalRevenue, 2); ?> руб.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Последние заказы</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td><?php echo $order->id; ?></td>
                            <td><?php echo $order->user->username; ?></td>
                            <td><?php echo $order->total_amount; ?></td>
                            <td><?php echo $order->created_at; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>