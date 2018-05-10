<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 9:57
 */
namespace app\libs;
use yii;
class GetData {
    /*
     * 接收表单数据，并判断完整性
     * @$must,为必填项目
     * $postion,上传图片保存位置
     */

    public function upXls(){
        require_once 'UploadFile.php';
        $config=array('arr_allow_exts'=>  array('xls'));  // 允许上传的图片格式
        $up=new \UploadFile($config);
        $savePath="./Upload/file/";
        $file=$_FILES['pic'];
        $data= $up->uploadOne($file,$savePath);
        // 包含错误信息
        if($data['arr_data']['int_error']){
            die('<script>alert("上传文件失败");history.go(-1);</script>');
        }else{
            $a=$data['arr_data']['arr_data'][0];
            $path=ltrim($a['savepath'].$a['savename'],'.');
            return $path;
        }

    }


}