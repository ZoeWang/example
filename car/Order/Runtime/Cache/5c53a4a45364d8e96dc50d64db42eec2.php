<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练信息</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
    <div class="middle_info">
      <table class="t_info" cellpadding="0" cellspacing="0">
      <?php if(is_array($teacher)): foreach($teacher as $key=>$t): ?><tr>
      	 	<td align="right" width="30%"><b>教练名称：</b></td><td align="left" style="padding-left:10px;" width="30%"><?php echo ($t["true_name"]); ?></td>
          <td rowspan="4" width="40%" align="center"><img src="/Uploads/<?php echo ($t["photo"]); ?>" width="100px" height="120px"></td>
      	 </tr>
         <tr>
         	<td align="right"><b>性  别：</b></td><td align="left" style="padding-left:10px;"><?php echo ($t["sex"]); ?></td>
         </tr>
         <tr>
         	<td align="right"><b>科 目：</b></td><td align="left" style="padding-left:10px;"><?php echo ($t["kemu"]); ?></td>
         </tr>
         <tr>
          <td align="right"><b>车牌号码：</b></td><td align="left" style="padding-left:10px;"><?php echo ($t["carnum"]); ?></td>
         </tr>
          <?php if($moble_zt == 2 ): ?><tr>
          <td align="right"><b>教练手机：</b></td><td align="left" style="padding-left:10px;" colspan="2"><?php echo ($t["moble"]); ?></td>
          </tr><?php endif; ?>
         <tr>
         	<td align="right"><b>注册时间：</b></td><td align="left" style="padding-left:10px;" colspan="2"><?php echo ($t["addtime"]); ?></td>
         </tr>
         <tr>
           <td colspan="3" align="center"><h3>教练简介</h3></td>
         </tr>
         <tr>
           <td colspan="3" align="left"><?php echo ($t["jianjie"]); ?></td>
         </tr><?php endforeach; endif; ?>
      </table>
    </div>
   
</body>
</html>