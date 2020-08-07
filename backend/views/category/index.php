<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [   'attribute' => 'created_at',
                'value' => 'created_at',
                'format' => 'dateTime',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
//                    'name' => 'CategorySearch[updated_at]',
                    'value' => \yii\helpers\ArrayHelper::getValue($_GET, "CategorySearch.created_at"),
                    'pluginOptions' => [
                        'dateFormat' => 'yyyy-MM-dd',
//                        'todayHighlight' => true,
                    ]
                ]),

            ],
            [   'attribute' => 'updated_at',
                'value' => 'updated_at',
                'format' => 'dateTime',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
//                    'name' => 'CategorySearch[updated_at]',
                    'value' => \yii\helpers\ArrayHelper::getValue($_GET, "CategorySearch.updated_at"),
                    'pluginOptions' => [
                        'dateFormat' => 'yyyy-MM-dd',
//                        'todayHighlight' => true,
                    ]
                ]),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
