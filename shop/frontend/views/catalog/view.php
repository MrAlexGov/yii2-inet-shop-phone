<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <!-- Галерея изображений -->
            <?php if ($model->productImages): ?>
                <div class="product-gallery">
                    <?php foreach ($model->productImages as $image): ?>
                        <?= Html::img('/uploads/products/' . $image->image_path, ['class' => 'img-responsive', 'style' => 'margin-bottom: 10px;']) ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-image">Нет изображений</div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <!-- Информация о товаре -->
            <div class="product-info">
                <h3>Описание</h3>
                <p><?= Html::encode($model->description) ?></p>

                <div class="product-details">
                    <p><strong>Бренд:</strong> <?= Html::encode($model->brand->name) ?></p>
                    <p><strong>Категория:</strong> <?= Html::encode($model->category->name) ?></p>

                    <div class="price">
                        <?php if ($model->old_price): ?>
                            <span class="old-price">Старая цена: <?= Html::encode($model->old_price) ?> руб.</span><br>
                        <?php endif; ?>
                        <span class="current-price">Цена: <?= Html::encode($model->price) ?> руб.</span>
                    </div>
                </div>

                <div class="buttons">
                    <?= Html::a('В корзину', ['/cart/add', 'id' => $model->id], ['class' => 'btn btn-success btn-lg']) ?>
                    <?= Html::a('Назад к каталогу', ['index'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
    </div>

</div>