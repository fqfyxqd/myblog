<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">测评记录</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">测评记录</a>
        </li>
    </ul>
    <legend>所有记录</legend>
    <form action="<?php echo baseUrl?>/user/assessment-record/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    用户名：
                </td>
                <td>
                    <input name="userName" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['userName'])?$_GET['userName']:''?>"/>
                </td>
                <td>
                    考托时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
    <form action="/user/report/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>测评用户</th>
                <th>高考</th>
                <th>CET4</th>
                <th>CET6</th>
                <th>TEM4</th>
                <th>目标托福分数</th>
                <th>预计考托时间</th>
                <th>邮箱</th>
                <th>词汇正确数</th>
                <th>听力正确数</th>
                <th>阅读正确数</th>
                <th>作文</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><span><?php echo $v['userName']?></span></td>
                    <td><span><?php echo $v['ncee']?></span></td>
                    <td><span><?php echo $v['cet4']?></span></td>
                    <td><span><?php echo $v['cet6']?></span></td>
                    <td><span><?php echo $v['cem4']?></span></td>
                    <td><span><?php echo $v['score']?></span></td>
                    <td><span><?php echo date("Y-m-d H:i:s",$v['testTime'])?></span></td>
                    <td><span><?php echo $v['email']?></span></td>
                    <td><span><?php echo $v['words']?></span></td>
                    <td><span><?php echo $v['listen']?></span></td>
                    <td><span><?php echo $v['read']?></span></td>
                    <td><span><?php echo isset($v['write'])?$v['write']:'' ?></span></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="control-group">
            <div class="controls">
                <?php
                foreach($block as $v) {
                    ?>
                    <?php if($v['value'] == "publish") { ?>
                        <button class="push btn btn-primary" type="button"><?php echo $v['name'] ?></button>
                        <?php
                    }elseif($v['value'] == "no-publish") {
                        ?>
                        <button class="noPush btn btn-primary" type="button"><?php echo $v['name'] ?></button>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </div>
        <input type="hidden" name="url" value="<?php echo Yii::$app->request->getUrl()?>" />
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page
        ])?>
    </div>
</div>
<script>
    $(function() {
        $(".checkAll").change(function () {
            var sss = $(this).is(":checked");
            if(sss){
                $(".childCheck").prop("checked", true);
            }else{
                $(".childCheck").prop("checked", false);
            }
        })

        $(".push").on('click',function(){
            $("#checkPush").attr('action','/user/discuss/publish');
            $("#checkPush").submit();
        })
        $(".noPush").on('click',function(){
            $("#checkPush").attr('action','/user/discuss/no-publish');
            $("#checkPush").submit();
        })
    })
</script>