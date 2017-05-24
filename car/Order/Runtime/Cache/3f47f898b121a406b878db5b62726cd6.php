<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>驾校在线约车系统</title>
    <link rel="stylesheet" type="text/css" href="/Order/Public/Css/css.css">
    <script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Order/Public/Js/function.js"></script>
</head>

<body>
<div class="top">
    <div class="top_l"></div>
    <div class="top_m">
        <div class="logo"><img src="/Order/Public/Images/logo.png" alt=""/></div>
        <div class="caozuo">
            <?php if($usertype <= 2): ?><a href="/index.php/Admin/log_list" target="main"><img src="/Order/Public/Images/main_12.gif" alt=""/></a>
                <?php else: ?>
                <a href="/index.php/Main/info" target="main"><img src="/Order/Public/Images/main_12.gif" alt=""/></a><?php endif; ?>
            <a href="/index.php/Index/login_out"><img src="/Order/Public/Images/main_20.gif" alt=""/></a>
            <span><img src="/Order/Public/Images/main_21.gif" alt=""/></span>
            <?php if($usertype == 6): ?><a href="/index.php/Main/password_edit" target="main"><img src="/Order/Public/Images/main_22.gif"
                                                                             alt=""/></a>
                <?php elseif($usertype == 5): ?>
                <a href="/index.php/Teacher/password_edit" target="main"><img src="/Order/Public/Images/main_22.gif"
                                                                                alt=""/></a><?php endif; ?>
        </div>
        <div class="shijian"><span>当前用户：<?php echo (session('user')); ?></span> &nbsp; &nbsp;&nbsp;&nbsp;
            <div id="linkweb">
            </div>
            <script>setInterval("linkweb.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());", 1000);
            </script>
        </div>
    </div>
    <div class="top_r"></div>
</div>
<div class="mid_top">
    <div class="mid_top_l"><?php echo (session('user')); ?></div>
    <div class="mid_top_m">
        <?php if($usertype == 6): ?><p>科目二学时：<span><?php echo ($student["xueshi_k2"]); ?></span> &nbsp;&nbsp;已预约：<span><?php echo ($kemuer); ?></span> &nbsp; &nbsp;科目三学时：<span><?php echo ($student["xueshi_k3"]); ?></span>
                &nbsp; &nbsp;已预约：<span><?php echo ($kemusan); ?></span></p>
            <?php elseif($usertype == 5): ?>
            今日预约：<span><?php echo ($jinriyy); ?></span><?php endif; ?>
    </div>
    <div class="mid_top_r"></div>
</div>
<div class="middle">
    <!--usertype = 1 超级管理员-->
    <!--usertype = 2 管理员-->
    <!--usertype = 3 学员-->
    <!--usertype = 5 教练-->
    <?php if($usertype <= 2): ?><div class="left">
        <div class="left_top">管理菜单</div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(1)" id="lm_1_1">预约情况</div>
            <div class="left_con_y" onclick="dakai(1)" id="lm_2_1">预约情况</div>
            <div class="left_con_m" id="hid_1">
                <ul>
                    <li><a href="/index.php/Main/index?kmid=1" target="main">科目二模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=2" target="main">科目二实车</a></li>
                    <li><a href="/index.php/Main/?kmid=3" target="main">科目三模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=4" target="main">科目三实车</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(2)" id="lm_1_2">学员管理</div>
            <div class="left_con_y" onclick="dakai(2)" id="lm_2_2">学员管理</div>
            <div class="left_con_m" id="hid_2">
                <ul>
                    <li><A href="/index.php/Admin/" target="main" >学员添加</A></li>
                    <li><a href="/index.php/Admin/student_list" target="main">学员列表</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(3)" id="lm_1_3">教练管理</div>
            <div class="left_con_y" onclick="dakai(3)" id="lm_2_3">教练管理</div>
            <div class="left_con_m" id="hid_3">
                <ul>
                    <li><A href="/index.php/Admin/add_teacher" target="main">教练添加</A></li>
                    <li><a href="/index.php/Admin/teacher_list" target="main">教练列表</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(4)" id="lm_1_4">数据统计</div>
            <div class="left_con_y" onclick="dakai(4)" id="lm_2_4">数据统计</div>
            <div class="left_con_m" id="hid_4">
                <ul>
                    <li><A href="/index.php/Admin/get_student_yy" target="main">学员约车统计</A></li>
                    <li><a href="/index.php/Admin/get_teacher_yy" target="main">教练约车统计</a></li>
                    <li><a href="/index.php/Admin/chongzhi_list" target="main">充值记录统计</a></li>
                    <li><a href="/index.php/Admin/log_list" target="main">登陆日志查看</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(5)" id="lm_1_5">系统设置</div>
            <div class="left_con_y" onclick="dakai(5)" id="lm_2_5">系统设置</div>
            <div class="left_con_m" id="hid_5">
                <ul>
                    <li><A href="/index.php/Admin/show_date" target="main">系统显示设置</A></li>
                    <li><A href="/index.php/Admin/fangjia" target="main">教练放假设置</A></li>
                    <li><a href="/index.php/Admin/message_edit" target="main">系统公告设置</a></li>
                    <li><a href="/index.php/Admin/cominfo" target="main">公司信息设置</a></li>
                    <li><a href="/index.php/Admin/password_edit" target="main">管理密码修改</a></li>
                </ul>
            </div>
        </div>
    <div class="left_bottom">版本：2016V1.0</div>
    <span id="anniu_h"></span>
    </div>
        <?php elseif($usertype == 5): ?>
            <div class="left">
        <div class="left_top">管理菜单</div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(1)" id="lm_1_1">预约情况</div>
            <div class="left_con_y" onclick="dakai(1)" id="lm_2_1">预约情况</div>
            <div class="left_con_m" id="hid_1">
                <ul>
                    <li><a href="/index.php/Main/index?kmid=1" target="main">科目二模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=2" target="main">科目二实车</a></li>
                    <li><a href="/index.php/Main/?kmid=3" target="main">科目三模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=4" target="main">科目三实车</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(2)" id="lm_1_2">预约查询</div>
            <div class="left_con_y" onclick="dakai(2)" id="lm_2_2">预约查询</div>
            <div class="left_con_m" id="hid_2">
                <ul>
                    <li><A href="/index.php/Teacher/yuyueinfo" target="main" >预约查询</A></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(3)" id="lm_1_3">加班设置</div>
            <div class="left_con_y" onclick="dakai(3)" id="lm_2_3">加班设置</div>
            <div class="left_con_m" id="hid_3">
                <ul>
                    <li><A href="/index.php/Teacher/" target="main">添加加班</A></li>
                </ul>
            </div>
        </div>
                <div class="left_con">
            <div class="left_con_t" onclick="guanbi(4)" id="lm_1_4">系统公告</div>
            <div class="left_con_y" onclick="dakai(4)" id="lm_2_4">系统公告</div>
            <div class="left_con_m" id="hid_4">
                <ul>
                    <li><A href="/index.php/Main/message" target="main">系统公告</A></li>
                </ul>
            </div>
        </div>
    <div class="left_bottom">版本：2016V1.0</div>
    <span id="anniu_h"></span>
    </div>
        <?php else: ?>
            <div class="left">
        <div class="left_top">管理菜单</div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(1)" id="lm_1_1">预约情况</div>
            <div class="left_con_y" onclick="dakai(1)" id="lm_2_1">预约情况</div>
            <div class="left_con_m" id="hid_1">
                <ul>
                    <li><a href="/index.php/Main/index?kmid=1" target="main">科目二模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=2" target="main">科目二实车</a></li>
                    <li><a href="/index.php/Main/?kmid=3" target="main">科目三模拟</a></li>
                    <li><a href="/index.php/Main/?kmid=4" target="main">科目三实车</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(2)" id="lm_1_2">预约查询</div>
            <div class="left_con_y" onclick="dakai(2)" id="lm_2_2">预约查询</div>
            <div class="left_con_m" id="hid_2">
                <ul>
                    <li><a href="/index.php/Main/yuyueinfo" target="main" >预约查询</a></li>
                </ul>
            </div>
        </div>
        <div class="left_con">
            <div class="left_con_t" onclick="guanbi(3)" id="lm_1_3">系统公告</div>
            <div class="left_con_y" onclick="dakai(3)" id="lm_2_3">系统公告</div>
            <div class="left_con_m" id="hid_3">
                <ul>
                    <li><a href="/index.php/Main/message" target="main">系统公告</a></li>
                </ul>
            </div>
        </div>
    <div class="left_bottom">版本：2016V1.0</div>
    <span id="anniu_h"></span>
    </div><?php endif; ?>
    <span id="anniu_p"></span>
    <div class="right">
        <!--elt 小于等于2-->
        <?php if($usertype <= 2): ?><IFRAME id="main" src="/index.php/Admin/log_list" frameBorder="0" name="main"></IFRAME>
            <?php else: ?>
            <!--操作系统,浏览器信息页面-->
            <IFRAME id="main" src="/index.php/Main/info" frameBorder="0" name="main"></IFRAME><?php endif; ?>


    </div>
</div>
</body>
</html>