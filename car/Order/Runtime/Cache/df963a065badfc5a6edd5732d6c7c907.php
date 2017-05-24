<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-系统公告</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<link rel="stylesheet" href="/order/public/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/order/public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/order/public/kindeditor/lang/zh_CN.js"></script>
<script>
      var editor;
      KindEditor.ready(function(K) {
        editor = K.create('textarea[name="message"]', {
          allowFileManager : true
        });
      });
    </script>
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：系统公告</span></div>
  <div class="add_title">系统公告</div>
    <div class="add_config" style="margin-top:10px;height:300px;">
      <form action="/index.php/Admin/message_edit/" method="post">
      <textarea rows="4" cols="40" style="border:1px solid #7EB0C7;" name="message"><?php echo ($config["message"]); ?></textarea>
       <br/> 
       <center><input type="submit" name="news" class="queding" value="确定"></center><center><span style="color:#f00;">在此处修改网站上显示的提示信息。</span></center>
     </form>    
      </div>
  </div>
</body>
</html>