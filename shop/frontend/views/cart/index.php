<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $items modules\cart\models\CartItem[] */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (empty($items)): ?>

        <p>Ваша корзина пуста.</p>
        <p><?= Html::a('Перейти к каталогу', ['/catalog/index'], ['class' => 'btn btn-primary']) ?></p>

    <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <strong><?= Html::encode($item->getProduct()->name) ?></strong><br>
                                <small><?= Html::encode($item->getProduct()->brand->name) ?></small>
                            </td>
                            <td><?= Html::encode($item->getPrice()) ?> руб.</td>
                            <td>
                                <?= Html::beginForm(['cart/update', 'id' => $item->product_id], 'post') ?>
                                <?= Html::input('number', 'quantity', $item->quantity, ['min' => 1, 'style' => 'width: 60px;']) ?>
                                <?= Html::submitButton('Обновить', ['class' => 'btn btn-sm btn-default']) ?>
                                <?= Html::endForm() ?>
                            </td>
                            <td><strong><?= Html::encode($item->getTotal()) ?> руб.</strong></td>
                            <td>
                                <?= Html::a('Удалить', ['cart/remove', 'id' => $item->product_id], [
                                    'class' => 'btn btn-sm btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот товар из корзины?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Итого</th>
                        <th><?= Html::encode(Yii::$app->cart->getTotalPrice()) ?> руб.</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="cart-actions">
            <?= Html::a('Очистить корзину', ['cart/clear'], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите очистить корзину?',
                    'method' => 'post',
                ],
            ]) ?>

            <?= Html::a('Оформить заказ', ['/order/create'], ['class' => 'btn btn-success']) ?>

            <?= Html::a('Продолжить покупки', ['/catalog/index'], ['class' => 'btn btn-default']) ?>
        </div>

    <?php endif; ?>

</div>