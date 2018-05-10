<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 11:21
 */
namespace app\modules\cn\controllers;

use yii\web\Controller;
use yii;
use app\modules\cn\models\Article;
class EditorController extends Controller{
    public $enableCsrfValidation = false;
    public $layout = false;
    public function actionAdd(){

        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%article}} where id=" . $id)->queryOne();
                return $this->render('index', ['data' => $data]);
            }
        } else {
            $model=new Article;
            $data['title']= Yii::$app->request->post('title', '');
            $data['keywords'] = Yii::$app->request->post('keywords', '');
            $data['content'] = Yii::$app->request->post('content', '');
            $data['id'] = Yii::$app->request->post('id', '');
            $data['uid'] = Yii::$app->session->get('uid', '14329');
            // 添加时不带id
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%article}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('/index/index');
            } else {
                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }

        return $this->renderPartial('/index/index');
    }

    public function actionDetails()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%article}} where id=" . $id)->queryOne();
        return $this->render('details', ['data' => $data]);
    }

}