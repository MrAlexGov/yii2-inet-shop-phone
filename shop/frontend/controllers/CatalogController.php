<?php

namespace frontend\controllers;

use frontend\models\ProductSearch;
use common\models\Category;
use common\models\Brand;
use common\models\Product;
use Yii;

class CatalogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categories = Category::find()->where(['status' => 1])->all();
        $brands = Brand::find()->where(['status' => 1])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionView($id)
    {
        $model = Product::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Товар не найден.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
