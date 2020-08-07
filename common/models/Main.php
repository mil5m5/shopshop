<?php


namespace common\models;


use yii\behaviors\TimestampBehavior;

class Main extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}