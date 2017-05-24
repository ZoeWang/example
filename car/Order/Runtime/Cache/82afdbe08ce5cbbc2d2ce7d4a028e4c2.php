<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-预约信息</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
<!--<script type="text/javascript" src="/Order/Public/Js/daohang.js"></script>-->
<script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
<script type="text/javascript">
  function cha(i){
    var adds=document.getElementById("cha");
    window.open("/index.php/Teacher/get_student/?userid="+i,"cha","status=0,menubar=0,toolbar=0,width=400,height=300,top=200,left=450")
  }
  </script>
</head>
<body>
    <div class="middle">
    <div class="position"><span>你现在的位置：教练约车统计</span></div>
    <div class="add_config" style="margin-top:60px;">
        <form action="/index.php/Teacher/yuyueinfo" method="post">
        按日期查询： <input class="Wdate" type="text" onClick="WdatePicker()" name="riqi_cha" value="<?php echo ($riqi); ?>">
        <input type="submit" value="查看" class="queding" name="shijian">
        <span class="hongse">（可查询特定时间内的约车情况）</span>
        </form>

    	<table class="main_yy" cellspacing="0" cellpadding="0">
    		<tr>
                <td>编号</td>
    			<td>预约日期</td>
    			<td>预约时段</td>
    			<td>学员姓名</td>
    			<td>学员电话</td>
                <td>预约科目</td>
    		</tr>
    		<?php if(is_array($yuyue)): foreach($yuyue as $key=>$y): ?><tr>
            <td><?php echo ($y["id"]); ?></td>
    		<td><?php echo ($y["time"]); ?></td>
    		<td><?php echo ($y["time_duan"]); ?></td>
    		<td><a href="#" onclick="cha('<?php echo ($y["user_id"]); ?>')"><?php echo ($y["true_name"]); ?></a></td>
    		<td><?php echo ($y["moble"]); ?></td>
            <td><?php echo ($y["kemu"]); ?></td>
    		</tr><?php endforeach; endif; ?>
            <tr>
                <td colspan="6" class="page"><?php echo ($page); ?></td>
            </tr>
    	</table>
     </div>
    </div>
</body>
</html>