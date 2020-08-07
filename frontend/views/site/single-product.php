<div class="about-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-frame"> <img class="img-fluid" src="<?= $product->imageUrl?>" alt="" />
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="noo-sh-title-top"><?= $product->title?></h2>
                <p class="h3">$ <?= $product->price?></p>
                <?= $product->description?>
            </div>
        </div>
    </div>
</div>
