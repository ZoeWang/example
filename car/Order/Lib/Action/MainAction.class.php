<?php

class MainAction extends Action
{
    /**
     * 预约情况模块页面
     */
    public function index()
    {
        $this->check_student();     //判断是否有进入权限
        if ($_GET['kmid'] == '') {
            $kmid = '1';
        } else {
            $kmid = $_GET['kmid'];
        }
        if ($_SESSION['user_type'] == 6) {
            //如果是学员进行科目判断
            //是否具有科目操作权限的判断
            $num_mn = R('/Admin/config_info');
            if ($_GET['kmid'] == '1') {
                $kmnum = $this->get_kemu_num('科目二模拟');  // 系统有设置模拟(学时)次数上限
                if ($kmnum > $num_mn['num_mn2']) {
                    $this->error('您的科目二模拟学时超出' . $num_mn['num_mn2'] . '学时，无法继续预约！');
                    exit();
                }
            } elseif ($_GET['kmid'] == '3') {
                $kmnum = $this->get_kemu_num('科目三模拟');  // 系统有设置模拟(学时)次数上限
                if ($kmnum > $num_mn['num_mn3']) {
                    $this->error('您的科目三模拟学时超出' . $num_mn['num_mn3'] . '学时，无法继续预约！');
                    exit();
                }
            }
        }
        $riqi = $this->get_riqi();
        $this->assign('riqi', $riqi);                    //获取日期

        $laoshi = M('teacher');
        if ($kmid == '1' || $kmid == '3') {
            $where['kemu'] = '1';

        } elseif ($kmid == '2') {
            $where['kemu'] = '2';
        } else {
            $where['kemu'] = '3';
        }
        $teaclist = $laoshi->where($where)->select();
        import('ORG.Util.Page');// 导入分页类
        $count = count($teaclist);
        $Page = new Page($count, 11);    // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();    // 分页显示输出
        $teac = $laoshi->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('teacher', $teac);                    //获取教练列表

        // 时间轴
        if ($_GET['action'] == 'riqi') {
            foreach ($teac as $t) {
                $teacarr[$t[carnum]] = $this->get_time_duan($t[t_id], $_GET[date], $this->kemu($kmid));
            }
            $this->assign('shijian', $_GET[date]);
        } else {
            $shijian = Date('Y-m-d');
            foreach ($teac as $t) {
                $teacarr[$t[carnum]] = $this->get_time_duan($t[t_id], $shijian, $this->kemu($kmid));
            }
            $this->assign('shijian', $shijian);
        }
        $jinriyy = R('Teacher/jinriyuyue');
        $this->assign('jinriyy', $jinriyy);
        $student = $this->student_info();                         //获取学员信息头部显示
        $this->assign('student', $student);
        $kemu2 = $this->get_kemu_num('科目二实车');
        $kemumn2 = $this->get_kemu_num('科目二模拟');
        $kemu3 = $this->get_kemu_num('科目三实车');
        $kemumn3 = $this->get_kemu_num('科目三模拟');
        $kemuer = $kemu2 + $kemumn2;
        $kemusan = $kemu3 + $kemumn3;
        $this->assign('kemuer', $kemuer);
        $this->assign('kemusan', $kemusan);
        $this->assign('kemu', $kmid);
        $this->assign('jiaolian', $this->get_teacher_info());
        $this->assign('usertype', $_SESSION['user_type']);
        $this->assign('yuyuearr', $teacarr);

        $this->display('index');
    }

    /**
     * @param $id
     * @return string
     */
    function kemu($id)
    {            //科目id转换
        Switch ($id) {
            case 1:
                $km = '科目二模拟';
                break;
            case 2:
                $km = '科目二实车';
                break;
            case 3:
                $km = '科目三模拟';
                break;
            case 4:
                $km = '科目三实车';
                break;
        }
        return $km;
    }

    /**
     * 显示时间的时间戳
     * @return array
     */
    function get_riqi()
    {
        $con = M('config');
        $cinfig = $con->select();
        $num = $cinfig[0][num_date];
        for ($i = 0; $i < $num; $i++) {
            $tomorrow = mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"));
            $riqi[] = date('Y-m-d', $tomorrow);
        }
        return $riqi;
    }

    /**
     * 个人科目预约
     */
    function yuyue()
    {
        // 判断身份
        $this->check_student();
        if ($_SESSION['user_type'] == '5') {
            echo "你的身份是教练，不能预约！";
            exit();
        }
        if ($_POST['riqi'] == date("Y-m-d")) {
            echo "只能预约明天以后的时段！";
            exit();
        }

        $nowtime = time();
        $config = R('/Admin/config_info');
        $start = $config['start_time'];
        $start = strtotime($start);
        $end = $config['end_time'];
        $end = strtotime($end);
        if ($nowtime < $start || $nowtime > $end) {
            echo "现在不是预约时间，请在" . Date('H:i:s', $start) . "-" . Date('H:i:s', $end) . "内预约！";
            exit();
        }
        $showT = mktime(0, 0, 0, date("m"), date("d") + $config['num_date'], date("Y"));
        $showD = date("Y-m-d", $showT);
        if ($_POST['riqi'] >= $showD) {
            echo "非法操作，现在不是预约时间！";
            exit();
        }
        if ($_POST) {
            if ($_POST['kmid'] == 1 || $_POST['kmid'] == 2) {
                $kemu2 = $this->get_kemu_num('科目二实车');
                $kemumn2 = $this->get_kemu_num('科目二模拟');
                $kemuer = $kemu2 + $kemumn2;
                $xueshi = $this->get_xueshi();
                if ($kemuer >= $xueshi[xueshi_k2]) {
                    echo '您的学时已经不足，请联系管理员添加！';
                    exit();
                }
            } else {
                $kemu3 = $this->get_kemu_num('科目三实车');
                $kemumn3 = $this->get_kemu_num('科目三模拟');
                $kemusan = $kemu3 + $kemumn3;
                $xueshi = $this->get_xueshi();
                if ($kemusan >= $xueshi[xueshi_k3]) {
                    echo '您的学时已经不足，请联系管理员添加！';
                    exit();
                }
            }

            $shiduan = $this->check_time_duan($_POST[time_id], $_POST[riqi]);
            if ($shiduan) {
                echo "同一时间段您只能预约一个教练！";
                exit();
            } else {
                if ($this->num_geren_yuyue($_POST['riqi']) >= $config['yuyue_num']) {
                    echo "您今天已经预约" . $config[yuyue_num] . "个小时，不能继续预约！";
                    exit();
                } else {

                    $info = M('info');
                    $data['user_id'] = $_SESSION['user_id'];
                    $data['teacher_id'] = $_POST['t_id'];
                    $data['time_id'] = $_POST['time_id'];
                    $data['time'] = $_POST['riqi'];
                    if ($_POST['kmid'] == '1') {
                        $data['kemu'] = '科目二模拟';
                    } elseif ($_POST['kmid'] == '2') {
                        $data['kemu'] = '科目二实车';
                    } elseif ($_POST['kmid'] == '3') {
                        $data['kemu'] = '科目三模拟';
                    } else {
                        $data['kemu'] = '科目三实车';
                    }

                    if ($data['time'] == '' || $data['time'] == '0000-00-00') {
                        echo "预约失败，请刷新页面后重试！";
                        exit();
                    }
                    if ($this->check_yuyue($data['teacher_id'], $data['time_id'], $data['time'], $data['kemu'])) {
                        echo "该时间段已经被预约，请刷新页面后重试！";
                        exit();
                    } else {
                        $info->create($data);
                        $result = $info->add();
                        if ($result) {
                            echo "预约成功！";
                        } else {
                            echo "预约失败！";
                        }
                    }
                }
            }
        }
    }

    /**
     * 确认当前日期段无人预约
     * @param $tid
     * @param $timeid
     * @param $time
     * @param $km
     * @return mixed
     */
    function check_yuyue($tid, $timeid, $time, $km)
    {
        $info = M('info');
        $data['teacher_id'] = $tid;
        $data['time_id'] = $timeid;
        $data['time'] = $time;
        $data['kemu'] = $km;
        $result = $info->where($data)->select();
        return $result;
    }

    /**
     * 同一时间段只能预约一个教练
     * @param $time_id
     * @param $riqi
     * @return array|mixed
     */
    function check_time_duan($time_id, $riqi)
    {
        $user_id = $_SESSION['user_id'];
        $time = M('time');
        $cond['time_id'] = $time_id;
        $time_duan = $time->where($cond)->select();
        $timeduan = $time_duan[0][time_duan];
        $Model = new Model();
        $result = $Model->query("SELECT b.time_duan FROM order_info as a LEFT JOIN
       order_time as b ON a.time_id = b.time_id where 
       a.user_id = $user_id and b.time_duan = '$timeduan' and a.time = '$riqi' ");
        return $result;
    }

    /**
     * 查询个人当天预约数量
     * @param $date
     * @return int
     */
    function num_geren_yuyue($date)
    {
        $info = M('info');
        $condition['user_id'] = $_SESSION[user_id];
        $condition['time'] = $date;
        $yuyue = $info->where($condition)->select();
        return count($yuyue);
    }

    /**
     * 查询个人预约的总数
     * @return int
     */
    function num_yuyue_zong()
    {
        $info = M('info');
        $condition['user_id'] = $_SESSION[user_id];
        $yuyue = $info->where($condition)->select();
        return count($yuyue);
    }

    /**
     * 获取个人学时数量
     * @return mixed
     */
    function get_xueshi()
    {
        $user = M('user');
        $condition['user_id'] = $_SESSION[user_id];
        $userinfo = $user->where($condition)->select();
        return $userinfo[0];
    }

    /**
     * 获取教练时间资源
     * @param $t_id
     * @param $shijian
     * @param $km
     * @return array
     */
    function get_time_duan($t_id, $shijian, $km)
    {
        $Model = new Model();
        $time = $Model->query("select a.t_id,a.true_name,b.time_id,b.time_duan,b.zhuangtai
        FROM order_teacher as a LEFT JOIN order_time as b ON a.t_id = b.teacher_id 
        where t_id = $t_id");
        foreach ($time as $t) {
            if ($this->get_fangjia($shijian, $t[time_duan], $t_id)) {
                //查询到当天有放假记录后更新状态为休息
                $t[zhuangtai] = '2';
                $jiaban = $this->get_jiaban($t[t_id], $t[time_id], $shijian);
                if ($jiaban) {
                    $t[zhuangtai] = '1';
                }        //更新有加班的状态
                $yuyuearr[] = $t;
            } else {
                $jiaban = $this->get_jiaban($t[t_id], $t[time_id], $shijian);
                if ($jiaban) {
                    $t[zhuangtai] = '1';
                }             //更新有加班的状态
                $yuyue = $this->get_yuyue_info($t[t_id], $t[time_id], $shijian, $km);
                if ($yuyue) {
                    $gerenyuyue = $this->get_geren_info($t[t_id], $t[time_id], $shijian, $km);
                    if ($gerenyuyue) {
                        $t[zhuangtai] = '4';        //更新个人预约的状态
                    } else {
                        $t[zhuangtai] = '3';     //更新非个人预约状态  状态更新只在输出数组,不添加到数据库
                    }
                }
                $yuyuearr[] = $t;
            }
        }
        return $yuyuearr;
    }

    /**
     * 查询是否有放假记录
     * @param $time
     * @param $timeduan
     * @param $t_id
     * @return bool
     */
    function get_fangjia($time, $timeduan, $t_id)
    {
        $fj = M('fangjia');
        $condition['time_fj'] = $time;
        $condition['time_duan'] = '0';
        $condition['t_id'] = $t_id;
        $fangjia = $fj->where($condition)->select();
        if ($fangjia) {
            //放假一整天
            return true;
        } else {
            $condition['time_duan'] = $timeduan;
            $condition['time_fj'] = $time;
            $condition['t_id'] = '0';
            $sd_fj = $fj->where($condition)->select();
            if ($sd_fj) {
                return true;
            } else {
                $condition['time_fj'] = $time;
                $condition['time_duan'] = $timeduan;
                $condition['t_id'] = $t_id;
                $tc_fj = $fj->where($condition)->select();
                if ($tc_fj) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * 查询预约时间段情况
     * @param $teacher_id
     * @param $time_id
     * @param $date
     * @param $km
     * @return mixed
     */
    function get_yuyue_info($teacher_id, $time_id, $date, $km)
    {
        $info = M('info');
        $condition['teacher_id'] = $teacher_id;
        $condition['time_id'] = $time_id;
        $condition['time'] = $date;
        $condition['kemu'] = $km;
        $yuyue = $info->where($condition)->select();
        return $yuyue;
    }

    /**
     * 查询个人预约情况
     * @param $teacher_id
     * @param $time_id
     * @param $date
     * @param $km
     * @return mixed
     */
    function get_geren_info($teacher_id, $time_id, $date, $km)
    {
        $info = M('info');
        $condition['user_id'] = $_SESSION[user_id];
        $condition['teacher_id'] = $teacher_id;
        $condition['time_id'] = $time_id;
        $condition['time'] = $date;
        $condition['kemu'] = $km;
        $yuyue = $info->where($condition)->select();
        return $yuyue;
    }

    /**
     * 查询教练加班信息
     * @param $teacher_id
     * @param $time_id
     * @param $date
     * @return mixed
     */
    function get_jiaban($teacher_id, $time_id, $date)
    {
        $jia = M('jiaban');
        $condition['teacher_id'] = $teacher_id;
        $condition['time_id'] = $time_id;
        $condition['addtime'] = $date;
        $jiaban = $jia->where($condition)->select();
        return $jiaban;
    }

    function del_yuyue()
    {                       //取消预约
        if ($_POST) {
            $tomorrow = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
            $shijian = date('Y-m-d', $tomorrow);
            if ($_POST['riqi'] <= $shijian) {
                echo "预约已经锁定，取消操作失败！";
                exit();
            }
            $info = M('info');
            $condition['user_id'] = $_SESSION[user_id];
            $condition['teacher_id'] = $_POST[t_id];
            $condition['time_id'] = $_POST[time_id];
            $condition['time'] = $_POST[riqi];
            $result = $info->where($condition)->delete();
            if ($result) {
                echo "取消预约成功！";
            } else {
                echo "取消预约失败，请重新尝试！";
            }
        }
    }

    /**
     * @return bool  页面访问权限
     */
    function check_student()
    {                       //页面访问权限判断
        if (!isset($_SESSION['login'])) {
            $this->error('请登录后操作！', '/index.php');
        } else {
            if ($_SESSION['user_type'] > '6') {
                $this->error('你无权限访问该页面。。。');
            } else {
                return true;
            }
        }
    }

    /**
     * 查看个人预约信息
     */
    function yuyueinfo()
    {
        $this->check_student();
        $user_id = $_SESSION[user_id];
        $excel_name = time();       //返回当前的时间戳
        $arr = $this->_param();     //获取参数
        if ($arr['cha_riqi'] || $arr['riqi_excel']) {
            $start = $arr['start'];
            $end = $arr['end'];
            $Model = new Model();
            if ($start == '' && $end == '') {
                $sql = "select a.kemu,b.carnum,c.time_duan,a.time,b.t_id,a.id from order_info
       as a left join order_teacher as b on a.teacher_id = b.t_id left join order_time 
       as c on a.time_id = c.time_id where a.user_id = $user_id order by a.time,c.time_duan ";
            } else {
                $sql = "select a.kemu,b.carnum,c.time_duan,a.time,b.t_id,a.id from order_info
       as a left join order_teacher as b on a.teacher_id = b.t_id left join order_time 
       as c on a.time_id = c.time_id where a.user_id = $user_id and a.time >= '$start' 
       and a.time <= '$end' order by a.time,c.time_duan";
            }
            $yylist = $Model->query($sql);
            if ($arr['riqi_excel']) {
                foreach ($yylist as $a) {
                    $b = array_splice($a, 0, 4);
                    $excel[] = $b;
                }
                // 到处execl表格
                exportexcel($excel, array('科目', '车牌号码', '预约时段', '预约日期'), $excel_name);
                exit();
            }
            import('ORG.Util.Page');
            $cond['start'] = $arr[start];
            $cond['end'] = $arr[end];
            $cond['cha_riqi'] = 'chakan';
            $count = count($yylist);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $yyinfo = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            $this->assign('cond', $cond);
        } else {
            $shijian = date('Y-m-d');    //默认显示当天以后的记录
            $Model = new Model();
            $sql = "select a.id,a.time,a.kemu,b.carnum,b.t_id,c.time_duan from order_info
	 as a left join order_teacher as b on a.teacher_id = b.t_id left join order_time 
	 as c on a.time_id = c.time_id where a.user_id = $user_id and a.time >= '$shijian' 
	 order by a.time,c.time_duan";
            $yylist = $Model->query($sql);
            import('ORG.Util.Page');
            $count = count($yylist);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show();                // 分页显示输出
            $yyinfo = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
        }

        if ($arr['cha_kemu'] || $arr['kemu_excel']) {
            $arr['kemu'] = urldecode($arr['kemu']);
            $Model = new Model();
            $sql = "select a.kemu,b.carnum,c.time_duan,a.time,b.t_id,a.id from order_info
	 as a left join order_teacher as b on a.teacher_id = b.t_id left join order_time 
	 as c on a.time_id = c.time_id where a.user_id = $user_id and a.kemu = '$arr[kemu]' 
	 order by a.time desc,c.time_duan ";
            $yylist = $Model->query($sql);
            if ($arr['kemu_excel']) {
                foreach ($yylist as $a) {
                    $b = array_splice($a, 0, 4);
                    $excel[] = $b;
                }
                exportexcel($excel, array('科目', '车牌号码', '预约时段', '预约日期'), $excel_name);
                exit();
            }
            import('ORG.Util.Page');
            $cond['kemu'] = urlencode($arr['kemu']);
            $cond['cha_kemu'] = 'chakan';
            $count = count($yylist);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $yyinfo = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            $this->assign('cond', $cond);
        }
        $this->assign('usertype', $_SESSION['user_type']);
        $this->assign('chexing', $_SESSION['class']);
        $this->assign('message', $this->get_message());     //系统公告内容
        $this->assign('yuyue', $yyinfo);
        $this->display('yuyue_info');
    }

    /**
     * 显示教练信息
     */
    function teacher_info()
    {
        $t_id = $_GET['tid'];
        $teac = M('teacher');
        $teacinfo = $teac->where("t_id = '$t_id'")->select();
        $teacinfo[0][true_name] = substr($teacinfo[0][true_name], 0, 3) . "教练";
        $config = R('Admin/config_info');
        $this->assign('moble_zt', $config['moble_zt']);
        $this->assign('teacher', $teacinfo);
        $this->display('teacherinfo');
    }

    /**
     * 个人信息查询
     * @return mixed
     */
    function student_info()
    {
        $user_id = $_SESSION['user_id'];
        $user = M('user');
        $userinfo = $user->where("user_id = '$user_id' ")->select();
        return $userinfo;
    }

    /**
     * 获取当前用户每个科目预约的数量
     * @param $str
     * @return mixed
     */
    function get_kemu_num($str)
    {
        $info = M('info');
        $num = $info->where(" kemu ='$str' and user_id = '$_SESSION[user_id]'")->count();
        return $num;
    }

    /**
     * 返回系统公告内容
     * @return mixed
     */
    function get_message()
    {
        $config = M('config');
        $msg = $config->where('id = 1')->select();
        return $msg[0][message];
    }

    /**
     * 教练信息头部显示
     * @return mixed
     */
    function get_teacher_info()
    {
        $t_id = $_SESSION['user_id'];
        $user = M('teacher');
        $userinfo = $user->where("t_id = '$t_id' ")->select();
        return $userinfo;
    }

    /**
     * 取消预约,今日或是之前的预约不可取消
     */
    function quxiao()
    {
        if ($this->isGet()) {
            $jintian = date('Y-m-d');
            if ($_GET['riqi'] == $jintian) {
                $this->error('今日的预约已经锁定，取消操作失败！');
                exit();
            } elseif ($_GET['riqi'] < $jintian) {
                $this->error('预约已经被锁定，取消操作失败！');
                exit();
            }
            $info = M('info');
            $result = $info->where("id = '$_GET[id]'")->delete();
            if ($result) {
                $this->success('取消预约成功！');
            } else {
                $this->error('取消预约失败，请重新尝试！');
            }
        }
    }

    /**
     * 学员信息修改
     */
    function password_edit()
    {
        $this->check_student();
        if ($_POST['pswedit']) {
            $user = M('user');
            $userin = $user->where("user_id = '$_POST[userid]'")->select();
            if ($_POST['oldpsw'] === $userin[0][user_password]) {
                if ($_POST['newpsw1'] === $_POST['newpsw2']) {
                    $data['user_id'] = $_POST[userid];
                    $data['user_password'] = $_POST['newpsw1'];
                    $result = $user->data($data)->save();
                    if ($result) {
                        $this->success('修改密码成功！');
                    } else {
                        $this->error('修改密码失败，请重新尝试！');
                    }
                } else {
                    $this->error('两次输入的新密码不同！');
                }
            } else {
                $this->error('原密码错误！');
            }
        }
        if ($_POST['info_edit']) {
            $user = M('user');
            $data['moble'] = $_POST['moble'];
            $data['address'] = $_POST['address'];
            $result = $user->where("user_id='$_SESSION[user_id]'")
                ->data($data)->save();
            if ($result) {
                $this->success('修改个人信息成功！');
                exit();
            } else {
                $this->error('修改个人信息失败，请重试！');
            }
        }
        $student = $this->student_info();                         //获取学员信息头部显示
        $gereninfo = M('user')->where("user_id='$_SESSION[user_id]'")
            ->select();
        $this->assign('info', $gereninfo[0]);
        $this->assign('student', $student);
        $this->assign('chexing', $_SESSION['class']);
        $kemu2 = $this->get_kemu_num('科目二实车');
        $kemumn2 = $this->get_kemu_num('科目二模拟');
        $kemu3 = $this->get_kemu_num('科目三实车');
        $kemumn3 = $this->get_kemu_num('科目三模拟');
        $kemuer = $kemu2 + $kemumn2;
        $kemusan = $kemu3 + $kemumn3;
        $this->assign('kemuer', $kemuer);
        $this->assign('kemusan', $kemusan);
        $this->assign('message', $this->get_message());
        $this->assign('usertype', $_SESSION['user_type']);
        $this->display('password_edit');
    }

    /**
     * 首页显示
     */
    function shouye()
    {
        $this->check_student();
        //获取学员信息头部显示
        $student = $this->student_info();
        $this->assign('student', $student[0]);
        $this->assign('chexing', $_SESSION['class']);
        $kemu2 = $this->get_kemu_num('科目二实车');
        $kemumn2 = $this->get_kemu_num('科目二模拟');
        $kemu3 = $this->get_kemu_num('科目三实车');
        $kemumn3 = $this->get_kemu_num('科目三模拟');
        $kemuer = $kemu2 + $kemumn2;
        $kemusan = $kemu3 + $kemumn3;
        $this->assign('kemuer', $kemuer);
        $this->assign('kemusan', $kemusan);
        $jinriyy = R('Teacher/jinriyuyue');   //调用某个控制器的方法
        $this->assign('jinriyy', $jinriyy);
        $this->assign('usertype', $_SESSION['user_type']);
        $this->display('shouye');
    }

    /**
     * 系统公告
     */
    function message()
    {
        $this->check_student();
        $this->assign('message', $this->get_message());
        $this->display('message');
    }

    /**
     * 介绍系统界面
     */
    function info()
    {
        $this->check_student();
        $sev = $_SERVER['SERVER_SOFTWARE'];
        $this->assign("sever", (substr($sev, 20, 10)));
        $this->assign('message', $this->get_message());
        $this->assign('liulq', $this->typellq());
        $this->display('info');
    }

    /**
     * 返回浏览器名称
     * @return string
     */
    function typellq()
    {
        $agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($agent, "MSIE 8.0"))
            $result = "Internet Explorer 8.0";
        else if (strpos($agent, "MSIE 7.0"))
            $result = "Internet Explorer 7.0";
        else if (strpos($agent, "MSIE 6.0"))
            $result = "Internet Explorer 6.0";
        else if (strpos($agent, "Firefox/3"))
            $result = "Firefox 3";
        else if (strpos($agent, "Firefox/2"))
            $result = "Firefox 2";
        else if (strpos($agent, "Chrome"))
            $result = "Google Chrome";
        else if (strpos($agent, "Safari"))
            $result = "Safari";
        else if (strpos($agent, "Opera"))
            $result = "Opera";
        else $result = $agent;
        return $result;
    }
}
