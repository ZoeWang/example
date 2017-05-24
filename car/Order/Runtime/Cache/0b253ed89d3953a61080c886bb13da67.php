<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-管理员密码修改</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：密码修改</span></div>
  <div class="add_title">密码修改</div>
    <div class="add">
     <form method="post" action="/index.php/Admin/psw_edit">
     	<ul>
     		<li>请输入原密码：<input type="text" name="oldpsw" class="add_input1"> </li>
     		<li>请输入新密码：<input type="text" name="newpsw1" class="add_input1"></li>
     		<li>请确认新密码：<input type="text" name="newpsw2" class="add_input1"></li>
     		<li style="text-align:center"><input type="submit" name="pswedit" value="修改" class="tianjia"> 
     		<input type="reset" class="add_cz"></li>
     	</ul>
     </form>
  </div>
  </div>
</body>
</html>