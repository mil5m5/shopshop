<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m200805_110511_admin
 */
class m200805_110511_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin123';
        $user->email = 'milena.nasibyan@gmail.com';
        $user->setPassword('admin123');
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $user->generateEmailVerificationToken();
        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200805_110511_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_110511_admin cannot be reverted.\n";

        return false;
    }
    */
}
