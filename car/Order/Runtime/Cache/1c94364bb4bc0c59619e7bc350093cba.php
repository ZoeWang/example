<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-登陆日志</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：登陆日志</span></div>
  <div style="margin-top:70px;">
    <table class="main_st" cellspacing="0" cellpadding="0">
      <tr>
	      <td width="10%">编号</td>
        <td width="30%">登陆用户</td>
        <td width="30%">登陆时间</td>
        <td width="30%">登陆IP</td>
      </tr>
      <?php if(is_array($log)): foreach($log as $key=>$lg): ?><tr>
       	 <td><?php echo ($lg["id"]); ?></td>
         <td><?php echo ($lg["user"]); ?></td>
         <td><?php echo ($lg["log_time"]); ?></td>
         <td><?php echo ($lg["log_ip"]); ?></td>
       </tr><?php endforeach; endif; ?>
      <tr>
        <td colspan="11" class="page"><?php echo ($page); ?></td>
      </tr>
    </table>
  </div>
  </div>
</body>
</html>