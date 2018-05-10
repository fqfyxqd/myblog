<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--    让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核-->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <!--    让360双核浏览器用webkit内核渲染页面-->
    <meta name="renderer" content="webkit">
    <script src="/js/jquery-1.7.2.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            background-image:url('/image/background.jpg');
            background-repeat:no-repeat;
            background-position:center 0;
            background-size:100% ;
            color : #f33;
        }
        p.grey {background-color: gray; padding: 20px;}

    </style>
</head>
<body >
<div>
    <!--    <h1 style="text-align: center">我的网页</h1>-->
    <div  style="text-align: right">
        <p class="grey" style="color：#333">
            <img src="/cn/images/login.png" alt="头像" style="float:right;padding-left: 20px" >
            <span><?php echo isset($user)?($user['nickname']!=false?$user['nickname']:$user['username']):'游客'?></span>
            <a style="clear: both" href="/edit.html">添加文章</a>
        </p>
    </div >
    <div  class="background" style="width: 1000px;height:1000px;text-align: center; boder:1px">
        <div class="left" style="float:left;height:500px;text-align: left;padding: 50px;border-right:5px solid #666">
            <?php use app\commands\widgets\LeftWidget;?>
            <?php LeftWidget::begin();?>
            <?php LeftWidget::end();?>
        </div>
        <div class="content" style="float:left;text-align: left;padding: 50px">
            <h1>我的树洞</h1>
            <?= $content ?>
        </div>
    </div>
</div>
</body>
</html>
