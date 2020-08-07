<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_categories}}`.
 */
class m200806_064000_create_products_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_categories}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk_product_cat','{{%products_categories}}', 'product_id', '{{%products}}', 'id');
        $this->addForeignKey('fk_prod_category','{{%products_categories}}', 'category_id', '{{%categories}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_categories}}');
    }
}
