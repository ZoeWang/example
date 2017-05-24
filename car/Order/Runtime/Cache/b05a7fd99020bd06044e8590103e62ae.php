<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网上约车系统-充值记录</title>
<link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
</head>
<body>
  <div class="middle">
   <div class="position"><span>你现在的位置：充值记录</span>
   </div>
    <div style="margin-top:70px;">
    <table class="main_st" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4">
          <form action="/index.php/Admin/chongzhi_list" method="post">
        输入学员姓名查询：<input type="text" name="name" style="width:80px;height:20px;border:1px solid #7EB0C7;" value="<?php echo ($stname); ?>">
          <input type="submit" value="查找" name="cz_cha" class="add_cz">
          <input type="submit" value="导出" name="cz_excel" class="queding">
        </form>
        </td>
      </tr>
      <tr>
        <td>学员名称</td>
        <td>充值科目</td>
        <td>充值学时</td>
        <td>充值日期</td>
      </tr>
      <?php if(is_array($czlist)): foreach($czlist as $key=>$cz): ?><tr>
        <td><?php echo ($cz["true_name"]); ?></td>
        <td><?php echo ($cz["kemu"]); ?></td>
        <td><?php echo ($cz["num"]); ?></td>
        <td><?php echo ($cz["riqi"]); ?></td>
      </tr><?php endforeach; endif; ?>
      <tr><td colspan="4" class="page"><?php echo ($page); ?></td></tr>
    </table>
    </div>
  </div>
</body>
</html>