<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-学员修改</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
  <div class="position"><span>你现在的位置：学员修改</span></div>
    <div class="add" style="margin-top:80px;">
    <?php if(is_array($student)): foreach($student as $key=>$st): ?><form method="post" action="/index.php/Admin/student_edit">
  	   <table cellspacing="0" cellpadding="0">
  	   	 <tr>
  	   	 	<td width="30%" align="right">真实姓名：</td>
  	   	 	<td width="70%" align="left"><input type="text" name="trueuser" value="<?php echo ($st["true_name"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	  <tr>
  	   	 	<td align="right">密 码：</td>
  	   	 	<td align="left"><input type="text" name="password" value="<?php echo ($st["user_password"]); ?>" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">性别：</td>
  	   	 	<td align="left">
            <input type="text" name="sex" value="<?php echo ($st["sex"]); ?>" class="add_input2">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">身份证：</td>
  	   	 	<td align="left"><input type="text" name="card" value="<?php echo ($st["user_card"]); ?>" class="add_input1"></td>
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
  	   	 	<td align="right">业务类型：</td>
  	   	 	<td align="left">
  	   	 	<select name="class" style="width:80px;height:25px;padding-top:5px;padding-left:25px;border: 1px solid #7EB0C7;">
<option value="<?php echo ($st["class"]); ?>" style="height:20px;padding-left:30px;"><?php echo ($st["class"]); ?></option>
<option value="A1" style="height:20px;padding-left:30px;">A1</option>
<option value="A2" style="height:20px;padding-left:30px;">A2</option>
<option value="B2" style="height:20px;padding-left:30px;">B2</option>
<option value="C1" style="height:20px;padding-left:30px;">C1</option>
<option value="C2" style="height:20px;padding-left:30px;">C2</option>
			</select>
			</td>
  	   	 </tr>
         <tr>
           <td align="right">科目二学时：</td>
           <td align="left"> <span class="hongse"><?php echo ($st["xueshi_k2"]); ?></span> </td>
         </tr>
         <tr>
           <td align="right">科目三学时：</td>
           <td align="left"> <span class="hongse"><?php echo ($st["xueshi_k3"]); ?></span> </td>
         </tr>
  	   	 <tr>
  	   	    <input type="hidden" name="stid" value="<?php echo ($st["user_id"]); ?>">
  	   	 	<td colspan="2" align="center">
  	   	 	<input type="submit" value="修改" name="user_edit" class="tianjia">
            <input type="button" value="返回" onclick="window.history.back(-1);" class="add_cz">
  	   	 	</td>
  	   	 </tr>
  	   </table>  	  
  	</form><?php endforeach; endif; ?>
      </div>
  </div>
</body>
</html>