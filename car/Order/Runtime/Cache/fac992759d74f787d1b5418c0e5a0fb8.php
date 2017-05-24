<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练预约信息统计</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
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
        <div class="yeyue_list" style="margin-top:60px;">
        <form action="/index.php/Admin/get_teacher_yy" method="post">
        请输入日期进行查询： <input class="Wdate" type="text" onClick="WdatePicker()" name="riqi_cha" value="<?php echo ($riqi); ?>">
        <input type="submit" value="查看" name="shijian" class="queding">
        <input type="submit" value="导出" name="riqi_excel" class="queding"><br/>
        <span class="hongse"> (查询特定日期内的约车记录,时间为空时显示当天记录。)</span>
        </form>
        <form action="/index.php/Admin/get_teacher_yy" method="post">
        按教练查询：
        <input type="text" name="t_name" class="add_input1" value="<?php echo ($cond["t_name"]); ?>"> <span class="hongse">* （请输入教练名称）</span> <br/>
        查询时间段： 
        <input class="Wdate" type="text" onClick="WdatePicker()" name="start" value="<?php echo ($cond["start"]); ?>"> - 
        <input class="Wdate" type="text" onClick="WdatePicker()" name="end" value="<?php echo ($cond["end"]); ?>">
        <input type="submit" value="查看" name="shiduan" class="queding">
        <input type="submit" value="导出" name="shiduan_excel" class="queding">
        </form> 
        <span class="hongse">（查询教练在特定时间段内的约车记录）</span>
    	<table class="main_yy" cellspacing="0" cellpadding="0">
    		<tr>
    			<td>教练姓名</td>
    			<td>学员姓名</td>
    			<td>预约时段</td>
    			<td>预约日期</td>
    			<td>预约科目</td>
    		</tr>
    		<?php if(is_array($yueche)): foreach($yueche as $key=>$y): ?><tr>
    		<td><?php echo ($y["teacher"]); ?></td>
    		<td><a href="#" onclick="cha('<?php echo ($y["user_id"]); ?>')"><?php echo ($y["true_name"]); ?></a></td>
    		<td><?php echo ($y["time_duan"]); ?></td>
    		<td><?php echo ($y["time"]); ?></td>
    		<td><?php echo ($y["kemu"]); ?></td>
    		</tr><?php endforeach; endif; ?>
    		<tr>
            <td colspan="5" class="page"><?php echo ($page); ?></td>
            </tr>
    	</table>
        </div>
    </div>
</body>
</html>