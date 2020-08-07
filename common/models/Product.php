<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use zxbodya\yii2\galleryManager\GalleryManager;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $title
 * @property string|null $description
 * @property int|null $price
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ProductCategory[] $productsCategories
 */
class Product extends Main
{
    public $imageFile;
    public $categories;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'created_at', 'updated_at'], 'integer'],
            [['image', 'title', 'description'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['categories'], 'safe'],
            [['price', 'categories', 'title', 'description'], 'required']
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'galleryBehavior' => [
                    'class' => GalleryBehavior::class,
                    'type' => 'product',
                    'extension' => 'jpg',
                    'directory' => Yii::getAlias('@webroot') . '/images/product/gallery',
                    'url' => Yii::getAlias('@web') . '/images/product/gallery',
                    'versions' => [
                        'small' => function ($img) {
                            /** @var \Imagine\Image\ImageInterface $img */
                            return $img
                                ->copy()
                                ->thumbnail(new \Imagine\Image\Box(200, 200));
                        },
                        'medium' => function ($img) {
                            /** @var \Imagine\Image\ImageInterface $img */
                            $dstSize = $img->getSize();
                            $maxWidth = 800;
                            if ($dstSize->getWidth() > $maxWidth) {
                                $dstSize = $dstSize->widen($maxWidth);
                            }
                            return $img
                                ->copy()
                                ->resize($dstSize);
                        },
                    ]
                ]

            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getImageUrl()
    {
        return Url::to('/frontend/web/products/' . $this->image);
    }

    public function getProductPage()
    {
        return Url::toRoute(['site/single-product', 'id' => $this->id]);
    }
    /**
     * Gets query for [[ProductsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCategories()
    {
        return $this->hasMany(ProductCategory::class, ['product_id' => 'id']);
    }
}
