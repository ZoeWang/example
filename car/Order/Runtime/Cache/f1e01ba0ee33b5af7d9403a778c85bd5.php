<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-学员信息</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript">
  function check_value1(){
    var a=document.form1.num2.value;
    if(a==''||a=='0'){
      alert('充值学时数不能为空！');
      return false;
    }else{
      return true;
    }    
}
    function check_value2(){
    var b=document.form2.num3.value;
    if(b==''||b=='0'){
      alert('充值学时数不能为空！');
      return false;
    }else{
      return true;
    }    
}
</script>
</head>
<body>
   <div class="middle">
  <div class="position"><span>你现在的位置：学员信息</span></div>
  <div class="add_title">学员信息</div>
    <div class="add_config" style="margin-top:10px;height:450px;">
    <table class="main_yy" cellspacing="0" cellpadding="0">
       <tr>
         <td colspan="2" align="center"><?php echo ($student["true_name"]); ?></td>
       </tr>
       <tr>
         <td width="50%">学员身份证</td>
         <td width="50%"><?php echo ($student["user_card"]); ?></td>
       </tr>
       <tr>
         <td>学员密码</td>
         <td><?php echo ($student["user_password"]); ?></td>
       </tr>
       <tr>
         <td>科目二剩余学时</td><td><?php echo ($student["sy_kemu2"]); ?></td>
       </tr>
      <tr>
         <td>科目二已约学时</td><td><?php echo ($student["yy_kemu2"]); ?></td>
      </tr>
      <tr>
          <td>科目三剩余学时</td><td><?php echo ($student["sy_kemu3"]); ?></td>
      </tr>
      <tr>
          <td>科目三已约学时</td><td><?php echo ($student["yy_kemu3"]); ?></td>
      </tr>
      <tr>
        <td>科目二充值</td>
        <td>
          <form action="/index.php/Admin/chongzhi" method="post" name="form1">
            <input type="text" name="num2" style="width: 80px;height: 20px;border: 1px solid #7EB0C7;">
            <input type="hidden" name="userid" value="<?php echo ($student["user_id"]); ?>" >
            <input type="submit" name="czkemu2" class="add_cz" value="充值" onclick="return check_value1()">
          </form>
        </td>
      </tr>
      <tr>
        <td>科目三充值</td>
        <td>
          <form action="/index.php/Admin/chongzhi" method="post" name="form2">
            <input type="text" name="num3" style="width: 80px;height: 20px;border: 1px solid #7EB0C7;">
            <input type="hidden" name="userid" value="<?php echo ($student["user_id"]); ?>" >
            <input type="submit" name="czkemu3" class="add_cz" value="充值" 
            onclick="return check_value2()">
          </form>
        </td>
      </tr>
       <tr>
         <td colspan="2">
         <input type="button" onclick="window.history.back(-1);" value="返回" class="add_cz" onclick="return check_value()"></td>
       </tr>
    </table>
   </div>
  </div>
</body>
</html>