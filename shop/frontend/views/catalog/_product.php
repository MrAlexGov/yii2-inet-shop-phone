<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model common\models\Product */

?>

<div class="product-item">
    <div class="row">
        <div class="col-md-3">
            <?php if ($model->productImages): ?>
                <?= Html::img('/uploads/products/' . $model->productImages[0]->image_path, ['class' => 'img-responsive']) ?>
            <?php else: ?>
                <div class="no-image">Нет изображения</div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h4><?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]) ?></h4>
            <p><?= Html::encode($model->description) ?></p>
            <p><strong>Бренд:</strong> <?= Html::encode($model->brand->name) ?></p>
            <p><strong>Категория:</strong> <?= Html::encode($model->category->name) ?></p>
        </div>
        <div class="col-md-3">
            <div class="price">
                <?php if ($model->old_price): ?>
                    <span class="old-price">Старая цена: <?= Html::encode($model->old_price) ?> руб.</span><br>
                <?php endif; ?>
                <span class="current-price">Цена: <?= Html::encode($model->price) ?> руб.</span>
            </div>
            <div class="buttons">
                <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a('В корзину', ['/cart/add', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <hr>
</div>