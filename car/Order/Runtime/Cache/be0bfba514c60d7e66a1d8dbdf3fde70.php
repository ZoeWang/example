<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-学员信息</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
<!--<script type="text/javascript" src="/Order/Public/Js/daohang.js"></script>-->
</head>
<body>
    <div class="middle_info">
      <table class="t_info" cellpadding="0" cellspacing="0">
      <?php if(is_array($user)): foreach($user as $key=>$t): ?><tr>
      	 	<td align="right">学员名称：</td><td align="left" style="padding-left:10px;"><?php echo ($t["true_name"]); ?></td>
      	 </tr>
         <tr>
         	<td align="right">性  别：</td><td align="left" style="padding-left:10px;"><?php echo ($t["sex"]); ?></td>
         </tr>
         <tr>
         	<td align="right">联系电话：</td><td align="left" style="padding-left:10px;"><?php echo ($t["moble"]); ?></td>
         </tr>
          <tr>
         	<td align="right">学习类型：</td><td align="left" style="padding-left:10px;"><?php echo ($t["class"]); ?></td>
         </tr>
         <tr>
         	<td align="right">入学时间：</td><td align="left" style="padding-left:10px;"><?php echo ($t["addtime"]); ?></td>
         </tr><?php endforeach; endif; ?>
      </table>
    </div>
   
</body>
</html>