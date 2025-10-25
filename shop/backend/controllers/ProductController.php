<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\ProductSearch;
use common\models\Product;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin', 'manager'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Exports products to CSV.
     * @return \yii\web\Response
     */
    public function actionExport()
    {
        $products = Product::find()->all();
        $filename = 'products_' . date('Y-m-d') . '.csv';

        $output = fopen('php://temp', 'w');
        fputcsv($output, ['ID', 'Name', 'Slug', 'Price', 'Old Price', 'Status', 'Created At']);

        foreach ($products as $product) {
            fputcsv($output, [
                $product->id,
                $product->name,
                $product->slug,
                $product->price,
                $product->old_price,
                $product->status,
                $product->created_at,
            ]);
        }

        rewind($output);
        $content = stream_get_contents($output);
        fclose($output);

        return \Yii::$app->response->sendContentAsFile($content, $filename, ['mimeType' => 'text/csv']);
    }

    /**
     * Imports products from CSV.
     * @return \yii\web\Response
     */
    public function actionImport()
    {
        $model = new \yii\base\Model();
        if (\Yii::$app->request->isPost) {
            $uploadedFile = \yii\web\UploadedFile::getInstance($model, 'file');
            if ($uploadedFile) {
                $handle = fopen($uploadedFile->tempName, 'r');
                fgetcsv($handle); // Skip header
                while (($row = fgetcsv($handle)) !== false) {
                    $product = new Product();
                    $product->name = $row[1];
                    $product->slug = $row[2];
                    $product->price = $row[3];
                    $product->old_price = $row[4];
                    $product->status = $row[5];
                    $product->save();
                }
                fclose($handle);
                \Yii::$app->session->setFlash('success', 'Products imported successfully.');
                return $this->redirect(['index']);
            }
        }
        return $this->render('import');
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}