<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练信息修改</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<link rel="stylesheet" href="/order/public/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/order/public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/order/public/kindeditor/lang/zh_CN.js"></script>
<script>
      var editor;
      KindEditor.ready(function(K) {
        editor = K.create('textarea[name="jianjie"]', {
          allowFileManager : true
        });
      });
    </script>
</head>
<body>
  <div class="middle">
    <div class="position"><span>你现在的位置：教练修改</span></div>
    <div class="add_tc" style="margin-top:80px;">
    <?php if(is_array($student)): foreach($student as $key=>$st): ?><form method="post" action="/index.php/Admin/teacher_edit" enctype="multipart/form-data">
  	   <table cellspacing="0" cellpadding="0" >
  	   	 <tr>
  	   	 	<td width="30%" align="right">真实姓名：</td>
  	   	 	<td width="70%" align="left"><input type="text" name="trueuser" value="<?php echo ($st["true_name"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	  <tr>
  	   	 	<td align="right">密 码：</td>
  	   	 	<td align="left"><input type="text" name="password" value="<?php echo ($st["t_password"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">性别：</td>
  	   	 	<td align="left">
          <input type="text" name="sex" value="<?php echo ($st["sex"]); ?>" class="add_input2">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">身份证：</td>
  	   	 	<td align="left"><input type="text" name="card" value="<?php echo ($st["t_card"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">联系电话：</td>
  	   	 	<td align="left"><input type="text" name="moble" value="<?php echo ($st["moble"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">暂住地址：</td>
  	   	 	<td align="left"><input type="text" name="address" value="<?php echo ($st["address"]); ?>" class="add_input1"></td>
  	   	 </tr>
         <tr>
          <td align="right">教练照片：</td>
          <td align="left">
          <?php if($st["photo"] != '' ): ?><a href="/Uploads/<?php echo ($st["photo"]); ?>" target="main"><?php echo ($st["photo"]); ?></a>
          &nbsp; &nbsp;
          <a href="/index.php/Admin/del_photo/?tid=<?php echo ($st["t_id"]); ?>" style="color:#272FEA;">[删除]</a>
          <input type="hidden" name="photo_name" value="<?php echo ($st["photo"]); ?>">
          <?php else: ?>
          <input type="file" name="photo" ><?php endif; ?>
          </td>
         </tr>
  	   	 <tr>
  	   	 	<td align="right">车牌号码：</td>
  	   	 	<td align="left">
  	   	 	<input type="text" name="carnum" value="<?php echo ($st["carnum"]); ?>" class="add_input2">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">车型：</td>
  	   	 	<td align="left">
  	   	 	<input type="text" name="chexing" value="<?php echo ($st["chexing"]); ?>" class="add_input2">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">科目：</td>
  	   	 	<td align="left">
  	   	 <input type="text" name="kemu" value="<?php echo ($st["kemu"]); ?>" class="add_input2">
			   </td>
  	   	 </tr>
         <tr>
          <td align="right">教练简介：</td>
          <td>
        <textarea name="jianjie" ><?php echo ($st["jianjie"]); ?></textarea>
         </td>
         </tr>
  	   	 <tr>
  	   	    <input type="hidden" name="tcid" value="<?php echo ($st["t_id"]); ?>">
  	   	 	<td colspan="2" align="center">
  	   	 	<input type="submit" value="修改" name="teacher_edit" class="tianjia">
            <input type="button" value="返回" onclick="window.history.back(-1);" class="add_cz">
  	   	 	</td>
  	   	 </tr>
  	   </table>  	  
  	</form><?php endforeach; endif; ?>
  	</div>
  </div>
</body>
</html>