<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories common\models\Category[] */
/* @var $brands common\models\Brand[] */

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <!-- Фильтры -->
            <div class="filters">
                <h3>Фильтры</h3>

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                ]); ?>

                <?= $form->field($searchModel, 'name')->textInput(['placeholder' => 'Поиск по названию']) ?>

                <?= $form->field($searchModel, 'category_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map($categories, 'id', 'name'),
                    ['prompt' => 'Все категории']
                ) ?>

                <?= $form->field($searchModel, 'brand_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map($brands, 'id', 'name'),
                    ['prompt' => 'Все бренды']
                ) ?>

                <?= $form->field($searchModel, 'price_min')->textInput(['placeholder' => 'Мин. цена']) ?>

                <?= $form->field($searchModel, 'price_max')->textInput(['placeholder' => 'Макс. цена']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Применить', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Список товаров -->
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_product',
                'layout' => "{summary}\n{items}\n{pager}",
                'emptyText' => 'Товары не найдены.',
            ]); ?>
        </div>
    </div>

</div>