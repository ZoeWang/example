<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练添加</title>
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
   <div class="position"><span>你现在的位置：教练添加</span></div>
  <div class="add_title">教练添加</div>
  <div class="add_tc" style="height:600px;">
  	<form method="post" action="/index.php/Admin/add_teacher" enctype="multipart/form-data">
  	   <table cellspacing="0" cellpadding="0" >
  	   	 <tr>
  	   	 	<td width="30%" align="right">用户名：</td>
  	   	 	<td width="70%" align="left"><input type="text" name="trueuser" class="add_input1"> <span class="hongse"> * </span></td>
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
  	   	 	<td align="left"><input type="text" name="card" class="add_input1"><span class="hongse"> * </span></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">联系电话：</td>
  	   	 	<td align="left"><input type="text" name="moble" class="add_input1"></td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">暂住地址：</td>
  	   	 	<td align="left"><input type="text" name="address" class="add_input1"></td>
  	   	 </tr>
         <tr>
           <td align="right">教练照片：</td>
           <td align="left"><input type="file"  name="photo"></td>
         </tr>
  	   	 <tr>
  	   	 	<td align="right">车牌号码：</td>
  	   	 	<td align="left"><input type="text" name="carnum" style="width: 80px;height: 25px;border: 1px solid #7EB0C7;"><span class="hongse"> * （号码不可重复）</span>
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">车型：</td>
  	   	 	<td align="left"><input type="text" name="chexing" style="width: 80px;height: 25px;border: 1px solid #7EB0C7;">
			</td>
  	   	 </tr>
  	   	 <tr>
  	   	 	<td align="right">科目：</td>
  	   	 	<td align="left">
          <select name="kemu">
             <option value="2">科目二</option>
             <option value="3">科目三</option>
             <option value="1">科目模拟</option>
          </select>
			</td>
  	   	 </tr>
        <tr>
         <td align="right">教练简介：</td>
         <td align="left"></td>
         </tr>
         <tr>
         <td colspan="2">
           <textarea name="jianjie"></textarea>
         </td>
        </tr>
  	   	 <tr>
  	   	 	<td colspan="2" align="center">
  	   	 	<input type="submit" value="添加" name="addtc" class="tianjia">
            <input type="reset" class="add_cz"> <br/>
            <span class="hongse">模拟车辆只需要添加车牌号码，选择科目为科目模拟即可</span>
  	   	 	</td>
  	   	 </tr>
  	   </table>  	  
  	</form>
    </div>
  </div>
</body>
</html>