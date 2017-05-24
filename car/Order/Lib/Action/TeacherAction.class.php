<?php

class TeacherAction extends Action
{
    /**
     *  添加加班设置页面
     */
    public function Index()
    {
        $this->check_teacher();
        $tctime[] = $this->get_time_tc($_SESSION['user_id']);
        $this->assign('tctime', $tctime);
        if ($_POST['addjiaban']) {
            $timearr[] = $_POST['time_1'];
            $timearr[] = $_POST['time_2'];
            $timearr[] = $_POST['time_3'];
            $timearr[] = $_POST['time_4'];
            $timearr[] = $_POST['time_5'];
            $timearr[] = $_POST['time_6'];
            $timearr[] = $_POST['time_7'];
            $timearr = array_filter($timearr);
            $jia = M('jiaban');
            foreach ($timearr as $t) {
                $data['teacher_id'] = $_SESSION['user_id'];
                $data['time_id'] = $t . value;
                $data['addtime'] = $_POST['time_jia'];
                $jia->create($data);
                $result = $jia->add();
            }
            if ($result) {
                $this->success('添加加班信息成功！');
            } else {
                $this->error('添加加班信息失败！请重新尝试。。。');
            }
        }
        $message = R('/Main/get_message');
        $this->assign('message', $message);
        $this->assign('jiaban', $this->jiaban_info());
        $this->assign('jiaolian', $this->get_teacher_info());
        $this->assign('jinriyy', $this->jinriyuyue());
        $this->assign('usertype', $_SESSION['user_type']);
        $this->display();
    }

    /**
     * 读取加班时间段
     * @param $t_id
     * @return array
     */
    function get_time_tc($t_id)
    {
        $time = M('time');
        $tctime = $time->where("teacher_id = $t_id")->select();
        foreach ($tctime as $t) {
            $timearr[] = $t[time_id];
        }
        return $timearr;
    }

    /**
     * 查看预约信息页面
     */
    function yuyueinfo()
    {
        $this->check_teacher();
        $teacher_id = $_SESSION[user_id];
        $arr = $this->_param();
        $excel_name = time();
        if ($arr['shijian']) {
            if ($arr['riqi_cha'] == '')
                $shijian = date('Y-m-d');    //为空显示当天记录
            else {
                $shijian = $arr['riqi_cha'];
            }
            $Model = new Model();
            $sql = "select a.id,a.time,a.kemu,a.user_id,b.true_name,b.moble,c.time_duan from order_info
       as a left join order_user as b on a.user_id = b.user_id left join order_time 
        as c on a.time_id = c.time_id where a.teacher_id = $teacher_id and a.time = '$shijian' 
        order by a.time desc,c.time_duan asc";
            $infolist = $Model->query($sql);
            import('ORG.Util.Page');
            $cond['riqi_cha'] = $shijian;
            $cond['shijian'] = 'riqi';
            $count = count($infolist);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $yyinfo = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            $this->assign('cond', $cond);
        }
        //      elseif ($arr['shiduan']||$arr['shiduan_excel']){
        //      $Model=new Model();
        //      $sql="select a.user_id,a.time,c.time_duan,b.true_name,b.moble,a.kemu from order_info
        //      as a left join order_user as b on a.user_id = b.user_id left join order_time
        //       as c on a.time_id = c.time_id where a.time >= '$arr[start]' and a.time <= '$arr[end]'
        //   and a.teacher_id = $teacher_id order by a.time desc,c.time_duan asc";
        //     $info_sj=$Model->query($sql);
        //       if($arr['shiduan_excel']){
        //       exportexcel($info_sj,array('学员编号','预约日期','预约时段','学员姓名','学员电话','科目'),$excel_name);
        //       exit();
        //       	}
        //     import('ORG.Util.Page');
        //     $cond['start']=$arr[start];
        //     $cond['end']=$arr[end];
        //     $cond['shiduan']=$arr[shiduan];
        //     $count=count($info_sj);
        //     $Page       = new Page($count,10);			// 实例化分页类 传入总记录数和每页显示的记录数
        //     foreach($cond as $key=>$val) {
        //    $Page->parameter.="$key=".urlencode($val).'&';
        // }
        //     $show       = $Page->show();				// 分页显示输出
        //     $yyinfo =$Model->query($sql." limit ".$Page->firstRow.",".$Page->listRows );
        //     $this->assign('page',$show);				// 赋值分页输出
        //     $this->assign('cond',$cond);
        //      }
        else {
            $shijian = date('Y-m-d');
            $Model = new Model();
            $sql = "select a.id,a.time,a.kemu,a.user_id,b.true_name,b.moble,c.time_duan from order_info
       as a left join order_user as b on a.user_id = b.user_id left join order_time 
        as c on a.time_id = c.time_id where a.teacher_id = $teacher_id and a.time >= '$shijian' 
        order by a.time asc,c.time_duan asc";
            $yylist = $Model->query($sql);
            import('ORG.Util.Page');
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
        $this->assign('riqi', $shijian);
        $message = R('/Main/get_message');
        $this->assign('message', $message);
        $this->assign('usertype', $_SESSION['user_type']);
        $this->assign('jiaolian', $this->get_teacher_info());
        $this->assign('jinriyy', $this->jinriyuyue());
        $this->assign('yuyue', $yyinfo);
        $this->display('yuyueinfo');
    }

    /**
     * 查看学员信息页面
     * studentinfo
     */
    function get_student()
    {
        $user_id = $_GET['userid'];
        $user = M('user');
        $cond['user_id'] = $_SESSION['user_id'];
        $userinfo = $user->where("user_id= '$user_id'")->select();
        $this->assign('user', $userinfo);
        $this->display('studentinfo');
    }

    /**
     * 查看登录用户权限是否是教练
     * @return bool
     */
    function check_teacher()
    {
        if (!isset($_SESSION['login'])) {
            $this->error('请登录后操作！', '/index.php');
        } else {
            if ($_SESSION['user_type'] > '5') {
                $this->error('你无权限访问该页面。。。');
            } else {
                return true;
            }
        }
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
     * 今日预约
     * @return mixed
     */
    function jinriyuyue()
    {
        $riqi = date('Y-m-d');
        $yyinfo = M('info');
        $num = $yyinfo->where("teacher_id = '$_SESSION[user_id]' and time = '$riqi' ")->count();
        return $num;
    }

    /**
     * 查询加班信息
     * @return mixed
     */
    function jiaban_info()
    {
        $riqi = date('Y-m-d');
        $jiaban = M('jiaban');
        $jiabaninfo = $jiaban->join('order_time on order_jiaban.time_id = order_time.time_id')
            ->where("order_jiaban.addtime > '$riqi' and order_jiaban.teacher_id = '$_SESSION[user_id]'")
            ->order('addtime desc')->select();
        return $jiabaninfo;
    }

    /**
     * 取消加班
     */
    function jiaban_del()
    {
        if ($_GET['id']) {
            $jia = M('jiaban');
            $result = $jia->where("id = '$_GET[id]'")->delete();
            if ($result) {
                $this->success('取消加班记录成功！');
            } else {
                $this->error('取消加班记录失败！');
            }
        }
    }

    /**
     * 教练密码修改页面
     */
    function password_edit()
    {
        $this->check_teacher();
        if ($_POST['pswedit']) {
            $user = M('teacher');
            $userin = $user->where("t_id = '$_POST[userid]'")->select();
            if ($_POST['oldpsw'] === $userin[0][t_password]) {
                if ($_POST['newpsw1'] === $_POST['newpsw2']) {
                    $data['t_id'] = $_POST[userid];
                    $data['t_password'] = $_POST['newpsw1'];
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
        $message = R('/Main/get_message');
        $this->assign('message', $message);
        $this->assign('usertype', $_SESSION['user_type']);
        $this->assign('jiaolian', $this->get_teacher_info());
        $this->assign('jinriyy', $this->jinriyuyue());
        $this->display('password_edit');
    }
}