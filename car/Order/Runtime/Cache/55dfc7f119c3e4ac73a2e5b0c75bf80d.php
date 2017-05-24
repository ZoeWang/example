<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练信息管理</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
<script type="text/javascript" src="/Order/Public/Js/daohang.js"></script>
<script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
<script type="text/javascript" charset="utf-8">
function check(){
	return confirm("确认删除记录？");
}
</script>
</head>
<body>
    <div class="middle">
    <div class="position"><span>你现在的位置：教练加班设置</span></div>
    <div class="add" style="margin-top:70px;">
    <?php if(is_array($tctime)): foreach($tctime as $key=>$t): ?><form action="/index.php/Teacher" method="post">
    <table cellspacing="0" cellpadding="0" >
        <tr>
            <td align="right">加班时间：</td>
            <td colspan="2"><input class="Wdate" type="text" onClick="WdatePicker()" name="time_jia" ></td>
        </tr>
        <tr>
            <td align="right">加班时段：</td>
            <td>6:00-7:00
<input type="checkbox" name="time_1" value="<?php echo ($t["0"]); ?>"></td>
            <td>7:00-8:00
<input type="checkbox" name="time_2" value="<?php echo ($t["1"]); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>18：00-19:00 
<input type="checkbox" name="time_3" value="<?php echo ($t["11"]); ?>"></td>
            <td>19：00-20:00 
<input type="checkbox" name="time_4" value="<?php echo ($t["12"]); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>20：00-21:00 
<input type="checkbox" name="time_5" value="<?php echo ($t["13"]); ?>"></td>
            <td>21：00-22:00 
<input type="checkbox" name="time_6" value="<?php echo ($t["14"]); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>22：00-23:00 
        <input type="checkbox" name="time_7" value="<?php echo ($t["15"]); ?>"></td>
            <td></td>
        </tr>

    </table>
		<center><input type="submit" value="提交" name="addjiaban" class="tianjia">
        <input type="reset" class="add_cz"> </center>	
    </form>
    <span class="hongse">在此处设置加班信息，如果多天加班请重复操作设置！</span><?php endforeach; endif; ?>
    <table class="main_yy" cellpadding="0" cellspacing="0">
    <tr>
    	<td>编号</td>
    	<td>加班日期</td>
    	<td>加班时段</td>
    	<td>操作</td>
    </tr>
    <?php if(is_array($jiaban)): foreach($jiaban as $key=>$j): ?><tr>
       <td><?php echo ($j["id"]); ?></td>
       <td><?php echo ($j["addtime"]); ?></td>
       <td><?php echo ($j["time_duan"]); ?></td>
       <td><a href="/index.php/Teacher/jiaban_del/?id=<?php echo ($j["id"]); ?>" onclick="return check()">取消</a></td>
    </tr><?php endforeach; endif; ?>
    </table>
    </div>
    </div>
</body>
</html>