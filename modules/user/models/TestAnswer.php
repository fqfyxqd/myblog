<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class TestAnswer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%test_answer}}';
    }
}