<?php
/**
 * 后台左菜单组件
 */
    namespace app\commands\widgets;
    use yii\base\Widget;
    use yii;
	class LeftWidget extends Widget  {
        public $controller;

        /**
         * 定义函数
         * */
         public function init()
         {
         }


        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('left');
        }
	}
?>