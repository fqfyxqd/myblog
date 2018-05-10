<?php
/**
 * 测评记录
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\AppControl;
use app\libs\Method;
use app\modules\user\models\Evaluation;
use app\modules\user\models\TestAnswer;

class AssessmentRecordController extends AppControl {
    public $enableCsrfValidation = false;
    //测评列表
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $userName = Yii::$app->request->get('userName','');
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $where = " 1=1";
        if($beginTime){
            $where .= " AND e.testTime>$beginTime";
        }
        if($endTime){
            $where .= " AND e.testTime<$endTime";
        }
        if($userName){
            $where .= " AND u.userName like '%$userName%'";
        }
        $model = new Evaluation();
        $data = $model->getAllEvaluation($where,10,$page);
        foreach($data['data'] as $k=>$v){
            $data['data'][$k]['words'] = count(TestAnswer::find()->asArray()->where("belong='words' and type=1 and userId=".$v['userId'])->all());
            $data['data'][$k]['listen'] = count(TestAnswer::find()->asArray()->where("belong='listen' and type=1 and userId=".$v['userId'])->all());
            $data['data'][$k]['read'] = count(TestAnswer::find()->asArray()->where("belong='read' and type=1 and userId=".$v['userId'])->all());
            $res = TestAnswer::find()->asArray()->where("belong='write' and type=1 and userId=".$v['userId'])->one();
            $data['data'][$k]['write'] = $res['answer'];
        }
        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>10, 'rows'=>'models']);
        return $this->render('index',['page' => $page,'data' => $data['data'],'block' => $this->block]);
    }
}