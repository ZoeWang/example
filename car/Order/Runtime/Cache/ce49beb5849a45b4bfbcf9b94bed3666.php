<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-教练列表</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
<script type="text/javascript" charset="utf-8">
function check(){
  return confirm("确认删除？");
}
function tihuan(i){
  if(i=='1'){document.write('模拟');}
  else if(i=='2'){document.write('科目二');}
  else {document.write('科目三');}
}
</script>
</head>
<body>
  <div class="middle_list">
  <div class="position"><span>你现在的位置：教练列表</span></div>
    <table class="main_yy" cellspacing="0" cellpadding="0">
      <tr>
    	<td width="5%">教练编号</td>
    	<td width="7%">用户名</td>
    	<td width="15%">身份证号</td>
    	<td width="5%">性别</td>
    	<td width="10%">手机</td>
    	<td width="20%">地址</td>
    	<td width="8%">车牌号码</td>
    	<td width="5%">车型</td>
    	<td width="5%">科目</td>
    	<td width="12%">入学时间</td>
    	<td width="8%">操作</td>	
      </tr>
      <?php if(is_array($teacher)): foreach($teacher as $key=>$st): ?><tr>
       	<td><?php echo ($st["t_id"]); ?></td>
       	<td><?php echo ($st["true_name"]); ?></td>
       	<td><?php echo ($st["t_card"]); ?></td>
       	<td><?php echo ($st["sex"]); ?></td>
       	<td><?php echo ($st["moble"]); ?></td>
       	<td><?php echo ($st["address"]); ?></td>
       	<td><?php echo ($st["carnum"]); ?></td>
       	<td><?php echo ($st["chexing"]); ?></td>
       	<td><script type="text/javascript">tihuan(<?php echo ($st["kemu"]); ?>)</script></td>
       	<td><?php echo ($st["addtime"]); ?></td>
       	<td><a href="/index.php/Admin/teacher_edit/?action=tcedit&tcid=<?php echo ($st["t_id"]); ?>">修改</a> &nbsp;|&nbsp;  
       	<a href="/index.php/Admin/teacher_edit/?action=tcdel&tcid=<?php echo ($st["t_id"]); ?>" onclick="return check()">删除</a></td>
       </tr><?php endforeach; endif; ?>
      <tr>
        <td colspan="11" class="page"><?php echo ($page); ?></td>
      </tr>
    </table>
  
  </div>
</body>
</html>