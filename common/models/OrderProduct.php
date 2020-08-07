<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_products".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $order_id
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'order_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'order_id' => Yii::t('app', 'Order ID'),
        ];
    }
}
