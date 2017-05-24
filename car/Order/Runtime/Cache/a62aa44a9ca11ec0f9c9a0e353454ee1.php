<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>网上约车系统-网站设置</title>
    <link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
    <script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
    <script type="text/javascript" charset="utf-8">
        function check() {
            return confirm("确认删除记录？");
        }
    </script>
</head>
<body>
<div class="middle">
    <div class="position"><span>你现在的位置：放假设置</span></div>
    <div class="add_title">放假设置</div>
    <div class="add_config" style="margin-top:10px;height:300px;">
        <form action="/index.php/Admin/fangjia" method="post">
            按日期放假：
            <select name="teac" style="width:80px;">
                <option value="0">选择教练</option>
                <?php if(is_array($teacher)): foreach($teacher as $key=>$t): ?><option value="<?php echo ($t["t_id"]); ?>"><?php echo ($t["true_name"]); ?></option><?php endforeach; endif; ?>
            </select>
            <input class="Wdate" type="text" onClick="WdatePicker()" name="riqi_fj">
            <input type="submit" value="确定" name="fangjia" class="queding">
        </form>
        <span style="color:#f00;">选择日期进行放假操作，如果放假多天请重复操作 (如果教练不做选择则是对所有教练放假)。</span>
        <form action="/index.php/Admin/fangjia" method="post">
            按时间段放假：
            <select name="teac" style="width:80px;">
                <option value="0">选择教练</option>
                <?php if(is_array($teacher)): foreach($teacher as $key=>$t): ?><option value="<?php echo ($t["t_id"]); ?>"><?php echo ($t["true_name"]); ?></option><?php endforeach; endif; ?>
            </select>
            <input class="Wdate" type="text" onClick="WdatePicker()" name="time_fjrq"> <br/>
            <?php if(is_array($timeduan)): foreach($timeduan as $key=>$td): echo ($td["time_duan"]); ?> &nbsp;<input type="checkbox" name="time_<?php echo ($key); ?>" value="<?php echo ($td["time_duan"]); ?>"/> &nbsp; &nbsp;<?php endforeach; endif; ?>
            <br/>
            <input type="submit" value="确定" name="time_fj" class="queding"><br/>
        </form>
        <span style="color:#f00;">选择某天的特定时间段进行放假操作。(如果教练不做选择则是对所有教练放假)</span>
    </div>
    <div class="chaxunlist">
        <table cellpadding="0" cellspacing="0" class="main_yy">
            <tr>
                <td>编号</td>
                <td>放假日期</td>
                <td>放假时段</td>
                <td>教练</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($fangjia)): foreach($fangjia as $key=>$fj): ?><tr>
                    <td><?php echo ($fj["id"]); ?></td>
                    <td><?php echo ($fj["time_fj"]); ?></td>
                    <td><?php echo ($fj["time_duan"]); ?></td>
                    <td><?php echo ($fj["true_name"]); ?></td>
                    <td><a href="/index.php/Admin/fangjia/?action=delfj&fjid=<?php echo ($fj["id"]); ?>" onclick="return check()">取消放假</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <tr>
                <td colspan="5" class="page"><?php echo ($page); ?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>