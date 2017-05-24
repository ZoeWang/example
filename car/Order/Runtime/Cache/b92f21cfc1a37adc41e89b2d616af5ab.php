<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="/Order/Public/Css/style.css">
    <script type="text/javascript" src="/Order/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Order/Public/Js/daohang.js"></script>
    <title>网上约车系统-会员预约</title>
    <script type="text/javascript">
        function check_xiuxi() {
            return confirm("当前操作为放假操作，请确认是否继续！");
        }

        function check_del() {
            return confirm("请确认是否取消该预约！");
        }

        function check_jiaban() {
            return confirm("当前操作为加班操作，请确认是否继续！");
        }

        function yuyue(t_id, time_id, riqi) {   //teacher_id    time_id   当前日期
            $.ajax({
                type: "POST",
                url: "/index.php/Main/yuyue",
                data: "kmid=<?php echo ($kemu); ?>&t_id=" + t_id + "&time_id=" + time_id + "&riqi=" + riqi,
                success: function (msg) {
                    alert(msg);
                    location.reload();
                    // if(msg=='预约成功！'){
                    //  $("#yy_"+t_id+"_"+time_id).html("<a href='#' onclick=yuyue_del('"+t_id+"','"+time_id+"','"+riqi+"') class='huangse'>取消预约</a>");
                    // }
                }
            });
        }
        function yuyue_del(t_id, time_id, riqi) {
            $.ajax({
                type: "POST",
                url: "/index.php/Main/del_yuyue",
                data: "t_id=" + t_id + "&time_id=" + time_id + "&riqi=" + riqi,
                success: function (msg) {
                    alert(msg);
                    location.reload();
                    //  if(msg=="取消预约成功！"){
                    // $("#yy_"+t_id+"_"+time_id).html("<a href='#' onclick='yuyue("+t_id+","+time_id+","+riqi+")' class='lvse'>预约</a>"); }
                }
            });
        }

        function cha(i) {
            var adds = document.getElementById("cha");
            window.open("/index.php/Main/teacher_info/?tid=" + i, "cha", "status=0,menubar=0,toolbar=0,width=430,height=370,top=200,left=450,scrollbars=yes")
        }

        function currentPage() {
            if (!document.getElementById("nav"))
                return false;
            /*进行必要的测试，避免没有id为nav时候出错*/
            var nav = document.getElementById("nav");
            var links = nav.getElementsByTagName("a");
            var currenturl = window.location.href;
            /*获取当前页面的地址*/
            if (currenturl == 'http://www.car.me/index.php/Main/'
                    || currenturl.indexOf("/index.php/Main/?kmid=") !== -1
                    || currenturl.indexOf("/index.php/Main/index/p/") !== -1
                    || currenturl.indexOf("/index.php/Main/index/kmid/") !== -1) {
                document.getElementById("riqi_0").className = "current";
            }
            for (i = 0; i < links.length; i++) {
                var url = links[i].getAttribute("href");
                /*获取链接的href值*/
                riqi = url.slice(-10);
                if (currenturl.indexOf(riqi) != -1) {/*如果链接的href值在当前页面地址中有匹配*/
                    links[i].className = "current";
                }
            }
        }
        window.onload = currentPage;
        /*载入页面时加载*/
    </script>
</head>
<body>
<div class="middle_list">
    <div class="main_title">
        <?php if($usertype == 6 ): if($kemu == 1 ): ?><h3>科目二模拟预约</h3>
                <?php elseif($kemu == 2 ): ?>
                <h3>科目二实车预约</h3>
                <?php elseif($kemu == 3 ): ?>
                <h3>科目三模拟预约</h3>
                <?php else: ?>
                <h3>科目三实车预约</h3><?php endif; ?>
            <?php else: ?>
            <?php if($kemu == 1 ): ?><h3>科目二模拟预约</h3>
                <?php elseif($kemu == 2 ): ?>
                <h3>科目二实车预约</h3>
                <?php elseif($kemu == 3 ): ?>
                <h3>科目三模拟预约</h3>
                <?php else: ?>
                <h3>科目三实车预约</h3><?php endif; endif; ?>
    </div>
    <div class="main_head">
        <ul class="riqi" id="nav">
            <?php if(is_array($riqi)): foreach($riqi as $key=>$dt): ?><li><a href="/index.php/Main/?action=riqi&kmid=<?php echo ($kemu); ?>&date=<?php echo ($dt); ?>" id="riqi_<?php echo ($key); ?>"><?php echo ($dt); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
    <table class="main_list" cellspacing="0" cellpadding="0">
        <tr class="main_td">
            <td style="width:80px;">车辆</td>
            <td>6:00-7:00</td>
            <td>7:00-8:00</td>
            <td>8:00-9:00</td>
            <td>9:00-10:00</td>
            <td>10:00-11:00</td>
            <td>11:00-12:00</td>
            <td>13:00-14:00</td>
            <td>14:00-15:00</td>
            <td>15:00-16:00</td>
            <td>16:00-17:00</td>
            <td>17:00-18:00</td>
            <td>18:00-19:00</td>
            <td>19:00-20:00</td>
            <td>20:00-21:00</td>
            <td>21:00-22:00</td>
            <td>22:00-23:00</td>
            <?php if(($kemu == 2) OR ($kemu == 4)): ?><td>教练</td><?php endif; ?>
        </tr>
        <?php if($usertype <= 2 ): ?><!--管理员-->
            <?php if(is_array($yuyuearr)): foreach($yuyuearr as $key=>$tc): ?><tr>
                    <td><?php echo ($key); ?></td>
                    <?php if(is_array($tc)): foreach($tc as $key=>$tm): ?><td id="yy_<?php echo ($tm["t_id"]); ?>_<?php echo ($tm["time_id"]); ?>">
                            <?php if($tm["zhuangtai"] == 3 ): ?><a
                                    href="/index.php/Admin/admin_del/?kmid=<?php echo ($kemu); ?>&t_id=<?php echo ($tm["t_id"]); ?>&time_id=<?php echo ($tm["time_id"]); ?>&riqi=<?php echo ($shijian); ?>"
                                    class="zise" onclick="return check_del()">可取消</a>
                                <?php elseif($tm["zhuangtai"] == 2): ?>
                                <a href="/index.php/Admin/admin_jiaban/?t_id=<?php echo ($tm["t_id"]); ?>&time_id=<?php echo ($tm["time_id"]); ?>&riqi=<?php echo ($shijian); ?>"
                                   class="lanse" onclick="return check_jiaban()">休息</a>
                                <?php else: ?>
                                <a href="/index.php/Admin/xiuxi/?kmid=<?php echo ($kemu); ?>&t_id=<?php echo ($tm["t_id"]); ?>&time_id=<?php echo ($tm["time_id"]); ?>&riqi=<?php echo ($shijian); ?>"
                                   class="lvse" onclick="return check_xiuxi()">预约</a><?php endif; ?>
                        </td><?php endforeach; endif; ?>
                    <?php if(($kemu == 2) OR ($kemu == 4)): ?><td><a href="#" onclick="cha('<?php echo ($tm["t_id"]); ?>')">[ 查看 ]</a></td><?php endif; ?>
                </tr><?php endforeach; endif; ?>
            <?php else: ?>
            <!--学员-->
            <?php if(is_array($yuyuearr)): foreach($yuyuearr as $key=>$tc): ?><tr>
                    <td><?php echo ($key); ?></td>
                    <?php if(is_array($tc)): foreach($tc as $key=>$tm): ?><td id="yy_<?php echo ($tm["t_id"]); ?>_<?php echo ($tm["time_id"]); ?>">
                            <?php if($tm["zhuangtai"] == 3 ): ?><span class="zise">已预约</span>
                                <?php elseif($tm["zhuangtai"] == 4): ?>
                                <a href="#" onclick="yuyue_del('<?php echo ($tm["t_id"]); ?>','<?php echo ($tm["time_id"]); ?>','<?php echo ($shijian); ?>')"
                                   class="huangse">取消预约</a>
                                <?php elseif($tm["zhuangtai"] == 2): ?>
                                <span class="lanse">休息</span>
                                <?php else: ?>
                                <a href="#" onclick="yuyue('<?php echo ($tm["t_id"]); ?>','<?php echo ($tm["time_id"]); ?>','<?php echo ($shijian); ?>')"
                                   class="lvse">预约</a><?php endif; ?>
                        </td><?php endforeach; endif; ?>
                    <?php if(($kemu == 2) OR ($kemu == 4)): ?><td><a href="#" onclick="cha('<?php echo ($tm["t_id"]); ?>')">[ 查看 ]</a></td><?php endif; ?>
                </tr><?php endforeach; endif; endif; ?>
        <tr>
            <td colspan="18" class="page"><?php echo ($page); ?></td>
        </tr>
    </table>
    <div class="shuoming">
        <ul>
            <li><img src="/Order/Public/Images/lvse.jpg" alt="">正常状态可以预约</li>
            <li><img src="/Order/Public/Images/huangse.jpg" alt="">
                当前个人预约状态
            </li>
            <li><img src="/Order/Public/Images/chengse.jpg" alt="">
                当前已经有别人预约
            </li>
            <li><img src="/Order/Public/Images/lanse.jpg" alt="">
                放假或休息状态，不可预约
            </li>
        </ul>
    </div>
</div>
</body>
</html>