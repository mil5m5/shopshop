<?php

namespace backend\controllers;

use common\models\Category;
use common\models\ProductCategory;
use Yii;
use common\models\Product;
use backend\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends MainController
{
    public function actions()
    {

        return [
            'browse-images' => [
                'class' => 'bajadev\ckeditor\actions\BrowseAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '/contents/',
                'path' => '@frontend/web/contents/',
            ],
            'upload-images' => [
                'class' => 'bajadev\ckeditor\actions\UploadAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '/contents/',
                'path' => '@frontend/web/contents/',
            ],
            'galleryApi' => [
                'class' => GalleryManagerAction::class,
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'product' => Product::class
                ]
            ],

        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
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
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Product();
        $categories = Category::getCategories();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate()) {
                $model->imageFile->saveAs('@frontend/web/products/' . time() . '_' . $model->imageFile->baseName . '.' . $model->imageFile->extension);
                $model->image = time() . '_' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
                if ($model->save(false)) {
                    foreach ($model->categories as $category) {
                        $productCategory = new ProductCategory();
                        $productCategory->product_id = $model->id;
                        $productCategory->category_id = $category;
                        $productCategory->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);

    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = Category::getCategories();
        if ($model->load(Yii::$app->request->post())) {
            $productCategory = ProductCategory::deleteAll(['product_id' => $id]);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate() ){
//                unlink(Yii::getAlias('@frontend/web/products/' . $model->image) );
                $model->imageFile->saveAs('@frontend/web/products/' . time() . '_' .  $model->imageFile->baseName . '.' . $model->imageFile->extension);
                $model->image = time() . '_' . $model->imageFile->baseName . '.' . $model->imageFile->extension;

                if ($model->save(false)) {
                    foreach ($model->categories as $category) {
                        $productCategory = new ProductCategory();
                        $productCategory->product_id = $model->id;
                        $productCategory->category_id = $category;
                        $productCategory->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
