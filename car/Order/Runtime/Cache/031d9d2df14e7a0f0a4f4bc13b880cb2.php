<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-网站设置</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script language="javascript" type="text/javascript" src="/order/public/rili/WdatePicker.js"></script>
<script type="text/javascript" charset="utf-8">
function check(){
	return confirm("确认删除记录？");
}
</script>
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：公司信息</span></div>
  <div class="add_title">公司信息</div>
    <div class="add_config" style="margin-top:10px;height:300px;padding-left:120px;">
     <form action="/index.php/Admin/cominfo" method="post">
      名 &nbsp; 称：<input type="text" name="name" class="add_input1" value="<?php echo ($info["name"]); ?>"><br/>
      电 &nbsp; 话：<input type="text" name="tel" class="add_input1" value="<?php echo ($info["tel"]); ?>"><br/>
      传 &nbsp; 真：<input type="text" name="fax" class="add_input1" value="<?php echo ($info["fax"]); ?>"><br/>
      联系人：<input type="text" name="linkman" class="add_input1" value="<?php echo ($info["linkman"]); ?>"><br/>
      邮 &nbsp; 箱：<input type="text" name="email" class="add_input1" value="<?php echo ($info["email"]); ?>"><br/>
       地 &nbsp; 址：<input type="text" name="address" class="add_input1" value="<?php echo ($info["address"]); ?>"><br/>
      <input type="submit" name="cominfo" class="queding" value="确定" style="margin-left:120px;margin-top:10px;">
     </form>
  </div>
  </div>
</body>
</html>