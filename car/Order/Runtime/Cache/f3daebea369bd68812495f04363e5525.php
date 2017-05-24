<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-学员添加</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
      <div class="position"><span>你现在的位置：学员添加</span></div>
      <div class="add_title">学员添加</div>
     <div class="add">
  	<form method="post" action="/index.php/Admin">
  	   <table cellspacing="0" cellpadding="0" >
  	   	 <tr>
  	   	 	<td align="right">用户名：</td>
  	   	 	<td align="left"><input type="text" name="trueuser" class="add_input1"><span class="hongse">*</span></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">性别：</td>
  	   	 	<td align="left">
男性：<input type="radio" checked="checked" name="sex" value="男">
女性：<input type="radio" name="sex" value="女">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">身份证：</td>
  	   	 	<td align="left"><input type="text" name="card" class="add_input1"><span class="hongse">*</span></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">联系电话：</td>
  	   	 	<td align="left"><input type="text" name="moble" class="add_input1"><span class="hongse">*</span></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">暂住地址：</td>
  	   	 	<td align="left"><input type="text" name="address" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">车型：</td>
  	   	 	<td align="left"><select name="class" style="width:80px;height:25px;padding-top:5px;padding-left:25px;border: 1px solid #7EB0C7;">
<option value="C1" style="height:20px;padding-left:30px;">C1</option>
<option value="A1" style="height:20px;padding-left:30px;">A1</option>
<option value="A2" style="height:20px;padding-left:30px;">A2</option>
<option value="B2" style="height:20px;padding-left:30px;">B2</option>
<option value="C2" style="height:20px;padding-left:30px;">C2</option>
			</select>
			</td>
  	   	 </tr>
         <tr>
           <td align="right">学时1：</td>
           <td align="left"><input type="text" name="xueshi_k2" style="width: 80px;height: 25px;border: 1px solid #7EB0C7;"><span class="hongse">（科目二学时）</span></td>
         </tr>
         <tr>
           <td align="right">学时2：</td>
           <td align="left"><input type="text" name="xueshi_k3" style="width: 80px;height: 25px;border: 1px solid #7EB0C7;"><span class="hongse">（科目三学时）</span></td>
         </tr>
  	   	 <tr>
  	   	 	<td colspan="2" align="center">
  	   	 	<input type="submit" value="添加" name="adduser" class="tianjia">
          <input type="reset" class="add_cz">
  	   	 	</td>
  	   	 </tr>
  	   </table>  	  
  	</form>
    </div>
  </div>
</body>
</html>