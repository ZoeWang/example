<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-系统公告</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：系统主页</span></div>
  <div class="info_title">欢迎使用驾校约车管理系统</div>
    <div class="add_config" style="margin-top:10px;height:300px;">
     <table cellpadding="0" cellspacing="0" class="info_tab" >
       <tr>
         <td colspan="4" align="center"><b>系统信息</b></td>
       </tr>
       <tr>
         <td width="15%">系统版本</td>
         <td width="35%">驾校约车管理系统 V1.0 </td>
         <td width="15%">操作系统</td>
         <td width="35%">Mac OS XYosemite</td>
       </tr>
        <tr>
         <td>服务器版本</td>
         <td><?php echo ($sever); ?></td>
         <td>浏览器版本</td>
         <td><?php echo ($liulq); ?></td>
       </tr>
       <tr>
         <td colspan="4"><b>系统公告</b></td>
       </tr>
       <td colspan="4">
         <div class="info_msg"><?php echo ($message); ?></div>
       </td>
     </table>  
    </div>
  </div>
</body>
</html>