<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?=Yii::getAlias('@web') ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($searchModel){
                    return "<img src='/frontend/web/products/$searchModel->image' style='width: 100px'>";
                }

            ],
            'title',
            'description',
            'price',
            [   'attribute' => 'created_at',
                'value' => 'created_at',
                'format' => 'dateTime',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'value' => \yii\helpers\ArrayHelper::getValue($_GET, "ProductSearch.created_at"),
                    'pluginOptions' => [
                        'dateFormat' => 'yyyy-MM-dd',
                    ]
                ]),

            ],
            [   'attribute' => 'updated_at',
                'value' => 'updated_at',
                'format' => 'dateTime',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'value' => \yii\helpers\ArrayHelper::getValue($_GET, "ProductSearch.updated_at"),
                    'pluginOptions' => [
                        'dateFormat' => 'yyyy-MM-dd',
                    ]
                ]),

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
