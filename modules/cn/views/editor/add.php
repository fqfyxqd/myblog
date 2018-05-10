<?php
$htmlData = '';
if (!empty($_POST['content1'])) {
    if (get_magic_quotes_gpc()) {
        $htmlData = stripslashes($_POST['content1']);
    } else {
        $htmlData = $_POST['content1'];
    }
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="../kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="../kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="../kindeditor/plugins/code/prettify.js"></script>
    <script>

        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="content1"]', {
                cssPath : '../kindeditor/plugins/code/prettify.css',
                uploadJson : '../kindeditor/php/upload_json.php',
                fileManagerJson : '../kindeditor/php/file_manager_json.php',
                allowFileManager : true,
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                }
            });
            prettyPrint();
        });
    </script>
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
<body>
    <div>
        <div  style="text-align: right">
            <p class="grey" style="color：#333">
                <span style="float:left"><a href="/index.html">首页</a></span>
<!--                <img src="/cn/images/login.png" alt="头像" style="float:right;padding-left: 20px" >-->
<!--                <span>--><?php //echo isset($user)?($user['nickname']!=false?$user['nickname']:$user['username']):'游客'?><!--</span>-->
                <span style="float:right"><a style="clear: both" href="/edit.html">添加文章</a></span>
            </p>
        </div >
        <div  class="background" style="height:1000px;text-align: center; boder:1px">
            <div class="left" style="float:left;height:500px;text-align: left;padding: 50px;border-right:5px solid #666">
                <?php use app\commands\widgets\LeftWidget;?>
                <?php LeftWidget::begin();?>
                <?php LeftWidget::end();?>
            </div>
            <div class="content" style="float:left;text-align: left;padding: 50px">
                <h1>我的树洞</h1>
                <?php echo $htmlData; ?>
                <form name="example" method="post" action="/edit.html">
                    <laber>标题：</laber>

                    <input name="title" type="text"/> </br></br>
                    <laber>标签：</laber>

                    <input name="keywords" type="text"/> </br></br>
                    <laber>内容：</laber>

                    <textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
                    <br />
                    <input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
                </form>
            </div>
        </div>
</body>
</html>

