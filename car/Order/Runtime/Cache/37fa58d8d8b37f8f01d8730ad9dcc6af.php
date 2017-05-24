<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>网上约车系统-预约信息</title>
    <link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
    <script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
    <!--<script type="text/javascript" src="/Order/Public/Js/daohang.js"></script>-->
    <script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
    <script>
        function cha(i) {
            var adds = document.getElementById("cha");
            window.open("/index.php/Main/teacher_info/?tid=" + i, "cha", "status=0,menubar=0,toolbar=0,width=400,height=300,top=200,left=450")
        }
    </script>
</head>
<body>
<div class="middle">
    <div class="position"><span>你现在的位置：学员约车统计</span></div>
    <div class="yeyue_list" style="margin-top:60px;">
        <form action="/index.php/Main/yuyueinfo" method="post">
            按日期查询：
            <input class="Wdate" type="text" onClick="WdatePicker()" name="start" value="<?php echo ($cond["start"]); ?>"> -
            <input class="Wdate" type="text" onClick="WdatePicker()" name="end" value="<?php echo ($cond["end"]); ?>">
            <input type="submit" value="查看" class="queding" name="cha_riqi">
            <input type="submit" value="导出" name="riqi_excel" class="queding">
        </form>
        <span class="hongse">（按日期查询您的约车记录，默认显示为当天以后的记录。如果时间为空则显示所有记录）</span>
        <form action="/index.php/Main/yuyueinfo" method="post">
            按科目查询：<select name="kemu" style="width:100px;">
            <?php if($kemu == ''): ?><option value="">选择科目查询</option>
                <?php else: ?>
                <option value="<?php echo ($kemu); ?>"><?php echo ($kemu); ?></option><?php endif; ?>
            <option value="科目二模拟">科目二模拟</option>
            <option value="科目二实车">科目二实车</option>
            <option value="科目三模拟">科目三模拟</option>
            <option value="科目三实车">科目三实车</option>
        </select>
            <input type="submit" class="queding" value="查看" name="cha_kemu">
            <input type="submit" value="导出" name="kemu_excel" class="queding">
        </form>
        <table class="main_yy" cellspacing="0" cellpadding="0">
            <tr>
                <td>科目</td>
                <td>车型</td>
                <td>车牌号码</td>
                <td>预约时段</td>
                <td>预约日期</td>
                <td>教练信息</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($yuyue)): foreach($yuyue as $key=>$y): ?><tr>
                    <td><?php echo ($y["kemu"]); ?></td>
                    <td><?php echo ($chexing); ?></td>
                    <td><?php echo ($y["carnum"]); ?></td>
                    <td><?php echo ($y["time_duan"]); ?></td>
                    <td><?php echo ($y["time"]); ?></td>
                    <td><a href="javascript:;" onclick="cha('<?php echo ($y["t_id"]); ?>')">[ 查看 ]</a></td>
                    <td><a href="/index.php/Main/quxiao/?id=<?php echo ($y["id"]); ?>&riqi=<?php echo ($y["time"]); ?>">[ 取消 ]</a></td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td colspan="7" class="page"><?php echo ($page); ?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>