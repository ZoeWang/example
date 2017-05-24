<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-学员列表</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript" charset="utf-8">
function check(){
  return confirm("确认删除？");
}
</script>
</head>
<body>
  <div class="middle_list">
   <div class="position"><span>你现在的位置：学员列表</span>
        <div style="float:right;margin-right:10px;">
        <form action="/index.php/Admin/student_list" method="post">
          <input type="text" name="name" style="width:80px;">
          <input type="submit" value="查找" name="chazhao">
        </form></div>
   </div>
    <table class="main_yy" cellspacing="0" cellpadding="0">
      <tr>
    	<td width="5%">学员编号</td>
    	<td width="5%">用户名</td>
    	<td width="15%">身份证号</td>
    	<td width="5%">性别</td>
    	<td width="10%">手机</td>
    	<td width="20%">地址</td>
    	<td width="5%">车型</td>
    	<td width="12%">入学时间</td>
    	<td width="13%">操作</td>	
      </tr>
      <?php if(is_array($student)): foreach($student as $key=>$st): ?><tr>
       	<td><?php echo ($st["user_id"]); ?></td>
       	<td><?php echo ($st["true_name"]); ?></td>
       	<td><?php echo ($st["user_card"]); ?></td>
       	<td><?php echo ($st["sex"]); ?></td>
       	<td><?php echo ($st["moble"]); ?></td>
       	<td><?php echo ($st["address"]); ?></td>
       	<td><?php echo ($st["class"]); ?></td>
       	<td><?php echo ($st["addtime"]); ?></td>
       	<td><a href="/index.php/Admin/student_cha/?stid=<?php echo ($st["user_id"]); ?>">查看</a> &nbsp;<a href="/index.php/Admin/student_edit/?action=stedit&stid=<?php echo ($st["user_id"]); ?>">修改</a>&nbsp; <a href="/index.php/Admin/student_edit/?action=stdel&stid=<?php echo ($st["user_id"]); ?>" onclick="return check()">删除</a></td>
       </tr><?php endforeach; endif; ?>
       <tr>
        <td colspan="10" class="page"><?php echo ($page); ?></td>
      </tr>
    </table>

  </div>
</body>
</html>