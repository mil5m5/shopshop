<?php

use yii\helpers\Url;

?>

<div class="col-md-2">
    <div style="padding: 10px;">
        <img style="width: 100%; height: 100px;" src="<?= $model->imageUrl?>" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title"><a href="product.html" title="View Product"><?= $model->title?></a></h4>
            <p class="card-text"><?= $model->description?></p>
            <div class="row">
                <p class="text-center"><?= $model->price?></p>
                <div class="col">
                    <a href="<?= Url::toRoute(['product/view', 'id' => $model->id])?>" class="btn btn-block " >Product Page</a>
                </div>
            </div>
        </div>
    </div>
</div>