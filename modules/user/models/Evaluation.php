<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class Evaluation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%evaluation}}';
    }

    /**
     * 获取所有测评记录
     * @param $where
     * @param int $pageSize
     * @param int $page
     * @return array
     * @Obelisk
     */

    public function getAllEvaluation($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "SELECT e.*,u.userName,u.nickname from {{%evaluation}} e left join {{%user}} u on e.userId = u.id where ".$where."  order by e.createTime DESC ";
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return ['data' => $data,'count' => $count];
    }
}