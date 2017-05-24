<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>在线约车系统_用户登录</title>
    <link rel="stylesheet" type="text/css" href="/Order/Public/Css/login.css"/>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <form method="post" action="/index.php/Index/login">
                <table class="loginbox" width="300" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="tip" colspan="3">除管理员外其他用户请用身份证号登录</td>
                    </tr>
                    <tr>
                        <td>
                            <div align="right"><span class="style1">用户</span></div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="text" name="user">
                            </div>
                        </td>
                        <td>
                            <select name="usertype">
                                <option value="student">
                                    学员
                                </option>
                                <option value="teacher">
                                    教练
                                </option>
                                <option value="admin">
                                    管理
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="right"><span class="style1">密码</span></div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="password" name="password">
                            </div>
                        </td>
                        <td>
                            <div align="left">
                                <input class="btn-login" type="submit" name="login" class="but_dl" value="登 录 ">
                            </div>
                        </td>
                    </tr>
                    <tr class="tip">
                        <td colspan="3">公司名称:<?php echo ($info["name"]); ?> 联系方式:<?php echo ($info["tel"]); ?></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>

</table>

</body>
</html>