<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php if (!$model->isNewRecord) {
        echo $form->field($model, 'imageFile', ['inputOptions' => ['value' => 'frontend/web/products/' . $model->image]])->fileInput();
        echo \zxbodya\yii2\galleryManager\GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => 'product/galleryApi'
            ]
        );
    }else {
        echo $form->field($model, 'imageFile')->fileInput();
    }?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'categories')->widget(Select2::class, [
        'data' => $categories,
        'language' => 'ru',
        'options' => ['placeholder' => 'Select a state ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'description')->widget(\bajadev\ckeditor\CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full',
                'inline' => false,
                'filebrowserBrowseUrl' => 'browse-images',
                'filebrowserUploadUrl' => 'upload-images',
                'extraPlugins' => 'imageuploader',
            ],
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
