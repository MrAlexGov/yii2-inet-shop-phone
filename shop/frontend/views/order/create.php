<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrderForm */
/* @var $cart array */

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Форма оформления заказа -->
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'phone')->textInput(['placeholder' => '+7 (999) 999-99-99']) ?>
                </div>
            </div>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'delivery_method')->dropDownList($model->getDeliveryOptions()) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'payment_method')->dropDownList($model->getPaymentOptions()) ?>
                </div>
            </div>

            <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>

            <div class="form-group">
                <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success btn-lg']) ?>
                <?= Html::a('Вернуться в корзину', ['cart/index'], ['class' => 'btn btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-4">
            <!-- Сводка заказа -->
            <div class="order-summary">
                <h3>Ваш заказ</h3>

                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <div class="row">
                            <div class="col-md-8">
                                <strong><?= Html::encode($item->getProduct()->name) ?></strong><br>
                                <small><?= Html::encode($item->getProduct()->brand->name) ?></small>
                            </div>
                            <div class="col-md-4 text-right">
                                <strong><?= Html::encode($item->quantity) ?> × <?= Html::encode($item->getPrice()) ?> руб.</strong><br>
                                <small>Итого: <?= Html::encode($item->getTotal()) ?> руб.</small>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>

                <div class="total">
                    <h4>Итого: <?= Html::encode(Yii::$app->cart->getTotalPrice()) ?> руб.</h4>
                </div>
            </div>
        </div>
    </div>

</div>