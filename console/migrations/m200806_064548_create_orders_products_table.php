<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_products}}`.
 */
class m200806_064548_create_orders_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_products}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'order_id' => $this->integer(),
        ]);
        $this->$this->addForeignKey('fk_ord_product', '{{%orders_products}}','product_id','{{%products}}', 'id');
        $this->$this->addForeignKey('fk_order_prod', '{{%orders_products}}','order_id','{{%orders}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders_products}}');
    }
}
