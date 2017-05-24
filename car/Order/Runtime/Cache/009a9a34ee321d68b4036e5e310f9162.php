<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-网站设置</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：系统设置</span></div>
  <div class="add_title">系统设置</div>
    <div class="add_config" style="margin-top:10px;height:450px;">
     <form action="/index.php/Admin/show_date" method="post">
     	请输入网站显示预约天数：<input type="text" name="num" class="add_input1" value="<?php echo ($config["num_date"]); ?>">
     	<input type="submit" value="确定" name="show" class="queding"><br/>
     	<span style="color:#f00;">(建议设置天数在3-8天。)</span>
     </form>

     <form action="/index.php/Admin/mobel_zt" method="post">
      是否显示教练手机：
      <?php if($config["moble_zt"] == 1 ): ?><input type="radio" name="show" value="2" /> 显示
      <input type="radio" name="show" value="1" checked="checked"/> 隐藏
      <?php else: ?> 
      <input type="radio" name="show" value="2" checked="checked" /> 显示
      <input type="radio" name="show" value="1" /> 隐藏<?php endif; ?>
      <input type="submit" value="确定" name="show_mb" class="queding"><br/>
     </form>

     <form action="/index.php/Admin/yuyuetime" method="post">
       约车开始时间：<input type="text" name="start" class="add_input1" value="<?php echo ($config["start_time"]); ?>"> <br/>
       约车结束时间：<input type="text" name="end" class="add_input1" value="<?php echo ($config["end_time"]); ?>">
    <input type="submit" value="确定" name="yuyuetime" class="queding"><br/>
    <span style="color:#f00;">时间请严格使用24小时标准时间格式：18:00:00</span>
     </form>

     <form action="/index.php/Admin/yuyuetime" method="post">
       学员单日约车次数：<input type="text" name="yueche_num" class="add_input1" value="<?php echo ($config["yuyue_num"]); ?>">
       <input type="submit" value="确定" name="yueche_shu" class="queding"><br/>
     </form>
     <span style="color:#f00;">设置学员单日约车的次数上限，建议设置1—4天。</span>
      <form action="/index.php/Admin/change_zuoxi" method="post">
      选择作息时间：
      <?php if($config["zuoxi"] == 1 ): ?><input type="radio" name="zuoxi" value="2" /> 夏季时间
      <input type="radio" name="zuoxi" value="1" checked="checked"/> 冬季时间
      <?php else: ?> 
      <input type="radio" name="zuoxi" value="2" checked="checked" /> 夏季时间
      <input type="radio" name="zuoxi" value="1" /> 冬季时间<?php endif; ?>
      <input type="submit" value="确定" name="change_zx" class="queding"><br/>
     </form>

     <form action="/index.php/Admin/up_num_mn" method="post">
     	模拟二学时：<input type="text" name="num_mn2" class="add_input1" value="<?php echo ($config["num_mn2"]); ?>"><br/>
     	模拟三学时：<input type="text" name="num_mn3" class="add_input1" value="<?php echo ($config["num_mn3"]); ?>">
     	<input type="submit" name="num_mn" value="确定" class="queding"><br/>
     	<span style="color:#f00;">(在此处设置模拟次数上限)</span>
     </form>
  </div>
  </div>
</body>
</html>