<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 11:21
 */
namespace app\modules\cn\controllers;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\web\Controller;
use yii;
use app\libs\GetData;
//use yii\base;
use app\modules\cn\models\User;
class IndexController extends Controller{
    public $enableCsrfValidation = false;
    public $layout = false;
    public function actionIndex(){
        $data = Yii::$app->db->createCommand("select * from {{%article}} order by id desc limit 5")->queryAll();
//       var_dump($data);die;
        return $this->renderPartial('index',['data'=>$data]);
    }



}