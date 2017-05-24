<?php
header('Content-Type: text/html; charset=UTF-8');

class AdminAction extends Action
{
    /**
     * 添加学员操作
     */
    function Index()
    {
        $this->check_admin();
        if ($_POST['adduser']) {             //添加学员操作
            if ($_POST['trueuser'] == '' || $_POST['card'] == '') {
                $this->error('用户名和身份证不能为空！');
            }
            $this->check_user($_POST['card']);
            $user = M('user');
            $data['true_name'] = $_POST['trueuser'];
            $data['user_password'] = $this->get_psw($_POST[card]);
            $data['user_type'] = '3';   //新添加学员user_type = 3 登录学员user_type 设置为5
            $data['user_card'] = $_POST['card'];
            $data['sex'] = $_POST['sex'];
            $data['moble'] = $_POST['moble'];
            $data['address'] = $_POST['address'];
            $data['class'] = $_POST['class'];
            $data['xueshi_k2'] = $_POST['xueshi_k2'];
            $data['xueshi_k3'] = $_POST['xueshi_k3'];
            $data['addtime'] = date('Y-m-d H:i:s');
            $user->create($data);
            $result = $user->add();
            if ($result) {
                echo "<script language='javascript'>alert('添加新学员成功！');window.history.back(-1);</script>";
            } else {
                echo "<script language='javascript'>alert('添加新学员失败，请重新尝试！');window.history.back(-1);</script>";
            }
        }
//        $this->display();
        $this->display('index');
    }

    function add_teacher()
    {                     //添加教练
        $this->check_admin();
        if ($_POST['addtc']) {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();                        // 实例化上传类
            $upload->maxSize = 3145728;                    // 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath = './Uploads/';    // 设置附件上传目录
            if (!$upload->upload()) {                    // 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            } else {                                    // 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
            }
            if ($_POST['kemu'] == '1') {                        //添加模拟车辆
                $user = M('teacher');
                $data['true_name'] = '模拟车';
                $data['t_password'] = mt_rand();
                $data['t_card'] = mt_rand();
                $data['sex'] = '模拟车';
                $data['moble'] = '';
                $data['address'] = '学车驾校';
                $data['carnum'] = $_POST['carnum'];
                $data['chexing'] = '模拟车';
                $data['kemu'] = '1';
                $data['addtime'] = date('Y-m-d H:i:s');
                $user->create($data);
                $result = $user->add();
                if ($result) {
                    $result2 = $this->add_teac_time($result);
                    if ($result2) {
                        echo "<script language='javascript'>alert('添加模拟车辆成功！');
			      window.history.back(-1);</script>";
                    } else {
                        echo "<script language='javascript'>alert('添加模拟车辆失败，请联系管理员处理！');
			      window.history.back(-1);</script>";
                    }
                }
            } else {
                if ($_POST['trueuser'] == '' || $_POST['card'] == '' || $_POST['carnum'] == '') {
                    $this->error('用户名、身份证和车牌号不能为空！');
                } else {
                    $this->check_teacher($_POST['card']);   //检测身份证是否重复
                    $this->check_carnum($_POST['carnum']);   //检测车牌号是否重复
                    $user = M('teacher');
                    $data['true_name'] = $_POST['trueuser'];
                    $data['t_password'] = $this->get_psw($_POST['card']);
                    $data['t_card'] = $_POST['card'];
                    $data['sex'] = $_POST['sex'];
                    $data['moble'] = $_POST['moble'];
                    $data['address'] = $_POST['address'];
                    $data['carnum'] = $_POST['carnum'];
                    $data['chexing'] = $_POST['chexing'];
                    $data['kemu'] = $_POST['kemu'];
                    $data['jianjie'] = $_POST['jianjie'];
                    $data['photo'] = $info[0]['savename'];
                    $data['addtime'] = date('Y-m-d H:i:s');
                    $user->create($data);
                    $result = $user->add();
                    if ($result) {
                        $result2 = $this->add_teac_time($result);
                        if ($result2) {
                            echo "<script language='javascript'>alert('添加新教练成功！');
			      window.history.back(-1);</script>";
                        } else {
                            echo "<script language='javascript'>alert('添加新教练失败，请联系管理员处理！');
			      window.history.back(-1);</script>";
                        }
                    }
                }
            }
        }

        $this->display('add_teacher');
    }

    /**
     * 截取身份证后6位作为默认密码
     * @param $card
     * @return string
     */
    function get_psw($card)
    {
        $card = rtrim($card, ' ');
        $psw = substr($card, -6, 6);
        return $psw;
    }

    /**
     * 学员用户名重复度检测
     * @param $usercard
     * @return bool
     */
    function check_user($usercard)
    {
        $user = M('user');
        $name = $user->where("user_card = '$usercard' ")->select();
        if ($name) {
            $this->error('用户卡号已存在！');
            exit();
        } else {
            return true;
        }
    }

    /**
     * 教练身份证重复度检测
     * @param $username
     * @return bool
     */
    function check_teacher($username)
    {
        $user = M('teacher');
        $name = $user->where("t_card = '$username' ")->select();
        if ($name) {
            $this->error('该身份证已经被注册！');
            exit();
        } else {
            return true;
        }
    }

    /**
     * 教练车牌号重复度检测
     * @param $num
     * @return bool
     */
    function check_carnum($num)
    {
        $user = M('teacher');
        $name = $user->where("carnum = '$num' ")->select();
        if ($name) {
            $this->error('该车牌号已经被注册！');
            exit();
        } else {
            return true;
        }
    }

    /**
     * 为新教练添加时间资源
     * @param $id
     * @return bool
     */
    function add_teac_time($id)
    {
        $time = M('time');
        $data1 = $this->shijian($id, 6, 8, 2);
        $data2 = $this->shijian($id, 8, 12, 1);
        $data3 = $this->shijian($id, 13, 18, 1);
        $data4 = $this->shijian($id, 18, 23, 2);
        if ($data1 && $data2 && $data3 && $data4) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 时间段处理函数
     * @param $t_id
     * @param $start
     * @param $end
     * @param $zt
     * @return mixed
     */
    function shijian($t_id, $start, $end, $zt)
    {
        $time = M('time');
        for ($i = $start; $i < $end; $i++) {
            $data[teacher_id] = $t_id;
            $data[time_duan] = ($i) . ":00-" . ($i + 1) . ":00";
            $data[zhuangtai] = $zt;
            $time->create($data);
            $result = $time->add();
        }
        return $result;
    }

    /**
     * 学员列表
     */
    function student_list()
    {
        $this->check_admin();
        if ($_POST['chazhao']) {
            $Model = new Model();
            $sql = "select * from order_user where true_name like '%" . $_POST['name'] . "%'";
            $userlist = $Model->query($sql);
        } else {
            $user = M('user');
            import('ORG.Util.Page');                              // 导入分页类
            $count = $user->count();                         // 查询满足要求的总记录数
            $Page = new Page($count, 10);                    // 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show();                          // 分页显示输出
            $userlist = $user->limit($Page->firstRow . ',' . $Page->listRows)->select();
            $this->assign('page', $show);
        }
        $this->assign('student', $userlist);
        $this->display('student_list');
    }

    /**
     * 学员信息修改
     */
    function student_edit()
    {
        $this->check_admin();
        if ($_GET['action'] == 'stedit') {
            $user = M('user');
            $condition['user_id'] = $_GET['stid'];
            $userinfo = $user->where($condition)->select();
            $this->assign('student', $userinfo);
            $this->display('student_edit');
        }
        if ($_GET['action'] == 'stdel') {
            $user = M('user');
            $condition['user_id'] = $_GET['stid'];
            $result = $user->where($condition)->delete();
            if ($result) {
                $this->success('删除学员信息成功！', '/index.php/Admin/student_list');
            } else {
                $this->error('删除学员信息失败，请重新尝试！');
            }
        }
        if ($_POST['user_edit']) {
            $user = M('user');
            $data['user_name'] = $_POST['user'];
            $data['true_name'] = $_POST['trueuser'];
            $data['user_password'] = $_POST['password'];
            $data['user_card'] = $_POST['card'];
            $data['sex'] = $_POST['sex'];
            $data['moble'] = $_POST['moble'];
            $data['address'] = $_POST['address'];
            $data['class'] = $_POST['class'];
            $data['user_id'] = $_POST['stid'];
            $user->create($data);
            $result = $user->save();
            if ($result) {
                $this->success('修改学员信息成功！', '/index.php/Admin/student_list');
                exit();
            } else {
                $this->error('修改学员信息失败，请重新尝试！');
                exit();
            }

            $this->display('student_edit');
        }
    }

    /**
     * 教练列表
     */
    function teacher_list()
    {
        $this->check_admin();
        $teacher = M('teacher');
        import('ORG.Util.Page');                              // 导入分页类
        $count = $teacher->count();                      // 查询满足要求的总记录数
        $Page = new Page($count, 10);                    // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();                          // 分页显示输出
        $teacherlist = $teacher->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);                           // 赋值分页输出
        $this->assign('teacher', $teacherlist);
        $this->display('teacher_list');
    }

    /**
     * 教练信息修改
     */
    function teacher_edit()
    {
        $this->check_admin();
        if ($_GET['action'] == 'tcedit') {
            $user = M('teacher');
            $condition['t_id'] = $_GET['tcid'];
            $userinfo = $user->where($condition)->select();
            $this->assign('student', $userinfo);
            $this->display('teacher_edit');
        }
        if ($_GET['action'] == 'tcdel') {
            $user = M('teacher');
            $condition['t_id'] = $_GET['tcid'];
            $result = $user->where($condition)->delete();
            $this->teacher_time_del($_GET['tcid']);
            if ($result) {
                $this->success('删除教练信息成功！', '/index.php/Admin/teacher_list');
            } else {
                $this->error('删除教练信息失败，请重新尝试！');
            }
        }
        if ($_POST['teacher_edit']) {
            if ($_FILES['photo']['size']) {
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();                        // 实例化上传类
                $upload->maxSize = 3145728;                    // 设置附件上传大小
                $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath = './Uploads/';             // 设置附件上传目录
                if (!$upload->upload()) {                    // 上传错误提示错误信息
                    $this->error($upload->getErrorMsg());
                } else {                                    // 上传成功 获取上传文件信息
                    $info = $upload->getUploadFileInfo();
                }
            } else {
                $info[0]['savename'] = $_POST['photo_name'];
            }
            $user = M('teacher');
            $data['t_name'] = $_POST['user'];
            $data['true_name'] = $_POST['trueuser'];
            $data['t_password'] = $_POST['password'];
            $data['t_card'] = $_POST['card'];
            $data['sex'] = $_POST['sex'];
            $data['moble'] = $_POST['moble'];
            $data['address'] = $_POST['address'];
            $data['carnum'] = $_POST['carnum'];
            $data['chexing'] = $_POST['chexing'];
            $data['kemu'] = $_POST['kemu'];
            $data['photo'] = $info[0]['savename'];
            $data['jianjie'] = $_POST['jianjie'];
            $data['t_id'] = $_POST['tcid'];
            $user->create($data);
            $result = $user->save();
            if ($result) {
                $this->success('修改教练信息成功！', '/index.php/Admin/teacher_list');
                exit();
            } else {
                $this->error('修改教练信息失败，请重新尝试！');
            }

            $this->display('teacher_edit');
        }
    }

    /**
     * 管理员密码修改
     */
    function psw_edit()
    {
        $this->check_admin();
        if ($_POST['pswedit']) {
            $user = M('admin');
            $admin = $user->where("id ='$_SESSION[user_id]'")->select();
            if (md5($_POST['oldpsw']) == $admin[0][password]) {
                if ($_POST['newpsw1'] == $_POST['newpsw2']) {
                    $data['id'] = $_SESSION['user_id'];
                    $data['password'] = md5($_POST['newpsw1']);
                    $user->create($data);
                    $result = $user->save();
                    if ($result) {
                        $this->success('修改管理员密码成功！');
                        exit();
                    } else {
                        $this->error('修改管理员密码失败，请重新尝试！');
                    }
                } else {
                    $this->error('两次输入的新密码不同！');
                }
            } else {
                $this->error('原密码错误！');
            }
        }
        $this->display('password_edit');
    }

    /**
     * 删除教练的时间信息
     * @param $t_id
     * @return mixed
     */
    function teacher_time_del($t_id)
    {
        $time = M('time');
        $condition['teacher_id'] = $t_id;
        $result = $time->where($condition)->delete();
        return $result;
    }

    /**
     * 用户权限判断
     * @return bool
     */
    function check_admin()
    {
        if (!isset($_SESSION['login'])) {
            $this->error('请登录后操作！', '/index.php');
        } else {
            if ($_SESSION['user_type'] > '2') {
                $this->error('你无权限访问该页面。。。');
            } else {
                return true;
            }
        }
    }

    /**
     * 网站显示天数设置
     */
    function show_date()
    {
        $this->check_admin();
        if ($_POST['show']) {
            $con = M('config');
            $data['num_date'] = $_POST['num'];
            $data['id'] = '1';
            $result = $con->data($data)->save();
            if ($result) {
                $this->success('设置成功！');
                exit();
            } else {
                $this->error('设置失败！');
                exit();
            }
        }
        $message = $this->config_info();
        $this->assign('config', $message);
        $this->display('config');
    }

    /**
     * 添加放假记录
     */
    function fangjia()
    {
        $this->check_admin();
        if ($_POST['fangjia']) {
            if (empty($_POST['riqi_fj'])) {
                $this->error('日期不能为空！');
            }
            $fj = M('fangjia');
            $data['time_fj'] = $_POST['riqi_fj'];
            $data['t_id'] = $_POST['teac'];
            $fj->create($data);
            $result = $fj->add();
            $this->del_yuyue_fj($_POST['riqi_fj'], $_POST['teac']);
            if ($result) {
                $this->success('添加放假记录成功！');
                exit();
            } else {
                $this->error('添加放假记录失败！');
                exit();
            }
        }

        if ($_POST['time_fj']) {
            if (empty($_POST['time_fjrq'])) {
                $this->error('日期不能为空！');
            }
            $riqi = $_POST['time_fjrq'];
            $fj = M('fangjia');
            $check = $_POST;
            array_shift($check);
            array_shift($check);
            array_pop($check);
            $check = array_values($check);
            foreach ($check as $td) {
                $data['time_fj'] = $riqi;
                $data['time_duan'] = $td;
                $data['t_id'] = $_POST['teac'];
                $fj->create($data);
                $result = $fj->add();
                $this->del_shiduan_fj($riqi, $data['time_duan'], $data['t_id']);
            }
            if ($result) {
                $this->success('添加放假记录成功！');
                exit();
            } else {
                $this->error('添加放假记录失败！');
            }
        }

        // 取消放假
        if ($_GET['action'] == 'delfj') {
            $fangjia = M('fangjia');
            $result = $fangjia->where("id = $_GET[fjid]")->delete();
            if ($result) {
                $this->success('取消放假成功！');
                exit();
            } else {
                $this->error('取消放假失败！请重新尝试...');
            }
        }
        // 显示今天以后的放假记录
        $shijian = date('Y-m-d');
        $fangjia = M('fangjia');
        import('ORG.Util.Page');        // 导入分页类
        $count = $fangjia->join('order_teacher on order_fangjia.t_id=order_teacher.t_id ')->where("time_fj >= '$shijian' ")->count();
        $Page = new Page($count, 10);
        $show = $Page->show();             // 分页显示输出
        $fjlist = $fangjia->join('order_teacher on order_fangjia.t_id=order_teacher.t_id ')
            ->where("time_fj >= '$shijian' ")->order('time_fj desc')->
            limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('fangjia', $fjlist);     // 赋值数据集
        $this->assign('page', $show);        // 赋值分页输出
        $time_duan = $this->get_timeduan();
        $this->assign('timeduan', $time_duan);
        //教练下拉列表
        $teacher = M('teacher');
        $condition['kemu'] = array('neq', 1);
        $teacherlist = $teacher->where($condition)->select();
        $this->assign('teacher', $teacherlist);

        $this->display('fangjia');
    }

    /**
     * 截取时间段
     * @return mixed
     */
    function get_timeduan()
    {
        $time = M('time');
        $timeinfo = $time->limit(0, 16)->select();
        return $timeinfo;
    }

    /**
     * 如果放假时间已经有预约则删除预约记录
     * @param $time
     * @param $teac
     * @return mixed
     */
    function del_yuyue_fj($time, $teac)
    {
        $info = M('info');
        $condition['time'] = $time;
        $condition['teacher_id'] = $teac;
        $yyinfo = $info->where($condition)->delete();
        return $yyinfo;
    }

    /**
     * 如果放假时间已经有预约则删除预约记录(时间段)
     * @param $time
     * @param $shiduan
     * @param $teac
     * @return mixed
     */
    function del_shiduan_fj($time, $shiduan, $teac)
    {
        $Model = new Model();
        $yyinfo = $Model->query("SELECT a.id,b.time_duan from
      order_info as a LEFT JOIN order_time as b on a.time_id = b.time_id 
      WHERE a.time = '$time' and b.time_duan = '$shiduan' and a.teacher_id ='$teac' ");
        $info = M('info');
        foreach ($yyinfo as $td) {
            $condition['id'] = $td[id];
            $result = $info->where($condition)->delete();
        }
        return $result;
    }

    /**
     * 数据统计——教练约车时间查询统计
     */
    function get_teacher_yy()
    {
        $this->check_admin();
        $excel_name = time();
        $arr = $this->_param();
        $arr[t_name] = urldecode($arr[t_name]);
        // 查询或是导出功能 按日期
        if ($arr['shijian'] || $arr['riqi_excel']) {
            if ($arr['riqi_cha'] == '') {
                $shijian = date('Y-m-d');   // 没输入查询日期默认查询今天
            } else {
                $shijian = $arr['riqi_cha'];
            }
            $Model = new Model();
            $sql = "SELECT d.true_name as teacher,b.true_name,b.user_id,c.time_duan,a.time,a.kemu FROM
	  order_info as a LEFT JOIN order_user as b on a.user_id = b.user_id LEFT JOIN 
	  order_time as c ON c.time_id = a.time_id LEFT JOIN order_teacher AS d ON 
	  d.t_id = a.teacher_id where a.time = '$shijian' ";
            $info_sj = $Model->query($sql);
            if ($arr['riqi_excel']) {
                exportexcel($info_sj, array('教练姓名', '学员姓名', '学员编号', '预约时段', '预约日期', '科目'), $excel_name);
                exit();
            }
            import('ORG.Util.Page');                    // 导入分页类
            $cond['riqi_cha'] = $shijian;
            $cond['shijian'] = 'chakan';
            $count = count($info_sj);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $list = $Model->query($sql . "limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            $this->assign('riqi', $shijian);
            $this->assign('yueche', $list);
        }

        if ($arr['shiduan'] || $arr['shiduan_excel']) {                     //教练按时间段查询统计
            $Model = new Model();
            $sql = "SELECT d.true_name as teacher,b.true_name,b.user_id,c.time_duan,a.time,a.kemu FROM
	  order_info as a LEFT JOIN order_user as b on a.user_id = b.user_id LEFT JOIN 
	  order_time as c ON c.time_id = a.time_id LEFT JOIN order_teacher AS d ON 
	  d.t_id = a.teacher_id where a.time >= '$arr[start]' and a.time <= '$arr[end]' 
	  and d.true_name = '$arr[t_name]' order by a.time desc,c.time_duan asc";
            $info_sj = $Model->query($sql);
            if ($arr['shiduan_excel']) {
                exportexcel($info_sj, array('教练姓名', '学员姓名', '学员编号', '预约时段', '预约日期', '科目'), $excel_name);
                exit();
            }
            import('ORG.Util.Page');
            $cond['start'] = $arr[start];
            $cond['end'] = $arr[end];
            $cond['t_name'] = urlencode($arr[t_name]);
            $cond['shiduan'] = "chakan";
            $count = count($info_sj);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $list = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            $cond['t_name'] = urldecode($arr[t_name]);
            $this->assign('cond', $cond);
            $this->assign('yueche', $list);
        }
        $teacher = M('teacher');
        $teacherlist = $teacher->select();
        $this->assign('teacherlist', $teacherlist);
        $this->display('teacher_yy');
    }

    /**
     * 数据统计——学员约车统计
     */
    function get_student_yy()
    {
        $this->check_admin();
        $excel_name = time();
        $arr = $this->_param();
        $arr['stname'] = urldecode($arr['stname']);

        if ($arr['name_cha'] || $arr['name_excel']) {                         //学员名称查询统计
            $Model = new Model();
            if ($arr['stname']) {
                $condition = "where b.true_name= '$arr[stname]'";
            } else {
                $condition = "where 1 = 1";
            }
            $sql = "SELECT a.id,b.user_id,b.true_name,d.true_name as teacher,c.time_duan,a.time,a.kemu FROM
      order_info as a LEFT JOIN order_user as b on a.user_id = b.user_id LEFT JOIN
      order_time as c ON c.time_id = a.time_id LEFT JOIN order_teacher as d ON
      d.t_id = a.teacher_id " . $condition . " order by a.time desc,c.time_duan asc ";

            $info_name = $Model->query($sql);

            import('ORG.Util.Page');
            $cond['stname'] = urlencode($arr['stname']);
            $cond['name_cha'] = 'chakan';
            $count = count($info_name);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $listyy = $Model->query($sql . "limit " . $Page->firstRow . "," . $Page->listRows);

            $this->assign('page', $show);                // 赋值分页输出

            if ($arr['name_excel']) {
                exportexcel($info_name, array('学员编号', '学员姓名', '教练姓名', '预约时段', '预约日期', '科目'), $excel_name);
                exit();
            }

            $this->assign('tiaojian', $arr[stname]);
            $this->assign('yueche', $listyy);
        }


        if ($arr['shiduan'] || $arr['sj_excel']) {                     //学员按时间段查询统计
            $arr['st_name'] = urldecode($arr['st_name']);
            $Model = new Model();
            $sql = "SELECT b.true_name,d.true_name as teacher,c.time_duan,a.time,a.kemu FROM
	  order_info as a LEFT JOIN order_user as b on a.user_id = b.user_id LEFT JOIN
	  order_time as c ON c.time_id = a.time_id LEFT JOIN order_teacher AS d ON
	  d.t_id = a.teacher_id where a.time >= '$arr[start]' and a.time <= '$arr[end]'
	  and b.true_name = '$arr[st_name]' order by a.time desc,c.time_duan asc";
            $info_sj = $Model->query($sql);

            import('ORG.Util.Page');
            $cond['start'] = $arr[start];
            $cond['end'] = $arr[end];
            $cond['st_name'] = urlencode($arr[st_name]);
            $cond['shiduan'] = "chakan";
            $count = count($info_sj);
            $Page = new Page($count, 10);            // 实例化分页类 传入总记录数和每页显示的记录数
            foreach ($cond as $key => $val) {
                $Page->parameter .= "$key=" . urlencode($val) . '&';
            }
            $show = $Page->show();                // 分页显示输出
            $list = $Model->query($sql . " limit " . $Page->firstRow . "," . $Page->listRows);
            $this->assign('page', $show);                // 赋值分页输出
            if ($arr['sj_excel']) {
                exportexcel($info_sj, array('学员名称', '教练名称', '预约时段', '预约日期', '科目'), $excel_name);
                exit();
            }
            $this->assign('sj_name', $arr[st_name]);
            $this->assign('start', $arr[start]);
            $this->assign('end', $arr[end]);
            $this->assign('yueche', $list);
        }
        $user = M('user');
        $studentlist = $user->select();
        $this->assign('studentlist', $studentlist);
        $this->display('student_yy');
    }

    /**
     * 系统公告设置
     */
    function message_edit()
    {
        if ($_POST['news']) {
            $this->check_admin();
            $config = M('config');
            $data['message'] = $_POST['message'];
            $data['id'] = '1';
            $result = $config->data($data)->save();
            if ($result) {
                $this->success('修改信息成功！');
            } else {
                $this->error('修改信息失败！请重新尝试。。。');
            }
        }
        $message = $this->config_info();
        $this->assign('config', $message);
        $this->display('message');
    }

    /**
     * 网站设置--模拟学时上限设置
     */
    function up_num_mn()
    {                     //网站设置--模拟学时上限设置
        if ($_POST['num_mn']) {
            $config = M('config');
            $data['num_mn2'] = $_POST['num_mn2'];
            $data['num_mn3'] = $_POST['num_mn3'];
            $data['id'] = '1';
            $result = $config->save($data);
            if ($result) {
                $this->success('修改模拟学时成功！');
            } else {
                $this->error('修改模拟学时失败，请重新尝试！');
            }
        }
    }

    /**
     * 获取网站设置信息
     * @return mixed
     */
    function config_info()
    {
        $config = M('config');
        $msg = $config->where('id = 1')->select();
        return $msg[0];
    }

    /**
     * 公司信息设置
     */
    public function cominfo()
    {
        $this->check_admin();
        if ($_POST['cominfo']) {
            $info = M('cominfo');
            $info->create();
            $result = $info->where('id = 1')->save();
            if ($result) {
                $this->success('修改公司信息成功！');
                exit();
            } else {
                $this->error('修改公司信息失败，请重新尝试！');
                exit();
            }
        }
        $info = M('cominfo');
        $com = $info->select();
        $this->assign('info', $com['0']);
        $this->display();
    }

    /**
     * 设置放假
     */
    function xiuxi()
    {                        //管理员设置休息状态
        $this->check_admin();
        if ($_GET) {
            $shiduan = M('time');
            $sd = $shiduan->where("time_id = '$_GET[time_id]'")->select();
            $duan = $sd[0]['time_duan'];
            $fangjia = M('fangjia');
            $data['time_fj'] = $_GET['riqi'];
            $data['time_duan'] = $duan;
            $data['t_id'] = $_GET['t_id'];
            $result = $fangjia->data($data)->add();
            if ($result) {
                $this->success('设置放假成功！');
            } else {
                $this->error('设置放假失败，请重新尝试！');
            }
        }
    }

    /**
     * 管理员取消预约状态
     */
    function admin_del()
    {
        $this->check_admin();
        if ($_GET) {
            switch ($_GET['kmid']) {
                case 1:
                    $kemu = "科目二模拟";
                    break;
                case 2:
                    $kemu = "科目二实车";
                    break;
                case 3:
                    $kemu = "科目三模拟";
                    break;
                case 4:
                    $kemu = "科目三实车";
                    break;
            }
            $info = M('info');
            $data['teacher_id'] = $_GET['t_id'];
            $data['time_id'] = $_GET['time_id'];
            $data['time'] = $_GET['riqi'];
            $data['kemu'] = $kemu;
            $result = $info->where($data)->delete();
            if ($result) {
                $this->success('取消预约成功！');
            } else {
                $this->error('取消预约失败，请重新尝试！');
            }
        }
    }

    /**
     * 管理员删除预约状态(学员预约情况)
     * ??? 没找到那里用
     */
    function admin_delyy()
    {
        $this->check_admin();
        if ($_GET) {
            $info = M('info');
            $data['id'] = $_GET['yy_id'];
            $result = $info->where($data)->delete();
            if ($result) {
                $this->success('取消预约成功！');
            } else {
                $this->error('取消预约失败，请重新尝试！');
            }
        }
    }

    /**
     * 管理员设置加班
     */
    function admin_jiaban()
    {
        $this->check_admin();
        if (isGet) {
            $fj = M('jiaban');
            $data['teacher_id'] = $_GET['t_id'];
            $data['time_id'] = $_GET['time_id'];
            $data['addtime'] = $_GET['riqi'];
            $fj->create($data);
            $result = $fj->add();
            if ($result) {
                $this->success('添加加班成功！');
                exit();
            } else {
                $this->error('添加加班失败，请重新尝试！');
            }
        }
    }

    /**
     * 学员详细信息查询
     */
    function student_cha()
    {
        $this->check_admin();
        if ($_GET) {
            $user = M('user');
            $userinfo = $user->where("user_id = '$_GET[stid]'")->select();
            $yy_kemu2 = $this->get_kemu_num('科目二实车', $_GET[stid]);
            $yy_kemu2mn = $this->get_kemu_num('科目二模拟', $_GET[stid]);
            $sy_kemu2 = $userinfo[0][xueshi_k2] - $yy_kemu2 - $yy_kemu2mn;         //计算科目二剩余学时
            $yy_kemu3 = $this->get_kemu_num('科目三实车', $_GET[stid]);
            $yy_kemu3mn = $this->get_kemu_num('科目三模拟', $_GET[stid]);
            $sy_kemu3 = $userinfo[0][xueshi_k3] - $yy_kemu3 - $yy_kemu3mn;         //计算科目三剩余学时
            $userinfo[0][yy_kemu2] = $yy_kemu2 + $yy_kemu2mn;
            $userinfo[0][sy_kemu2] = $sy_kemu2;
            $userinfo[0][yy_kemu3] = $yy_kemu3 + $yy_kemu3mn;
            $userinfo[0][sy_kemu3] = $sy_kemu3;
            $this->assign('student', $userinfo[0]);
            $this->display('student_cha');
        }
    }

    /**
     * 查找学员已约学时
     * @param $str
     * @param $user_id
     * @return mixed
     */
    function get_kemu_num($str, $user_id)
    {
        $info = M('info');
        $num = $info->where(" kemu ='$str' and user_id = '$user_id'")->count();
        return $num;
    }

    /**
     * 学员学时充值
     */
    function chongzhi()
    {
        $this->check_admin();
        if ($_SESSION['user_type'] > 1) {   //只有超级管理员可以添加学时 superadmin
            $this->error('您没有权限进行此项操作');
            exit();
        }
        if ($_POST['czkemu2']) {
            $cz = M('chongzhi');
            $data['user_id'] = $_POST['userid'];
            $data['kemu'] = "科目二";
            $data['num'] = $_POST['num2'];
            $data['riqi'] = Date('Y-m-d h:i:s');
            $result = $cz->data($data)->add();           //添加科目二充值记录
            $xueshi = $this->get_user_kemu($_POST['userid']);
            $xueshi_k2 = $xueshi['xueshi_k2'] + $_POST['num2'];
            $user = M('user');
            $con['xueshi_k2'] = $xueshi_k2;
            $result2 = $user->where("user_id = $_POST[userid]")->data($con)->save();  //更新学员的学时
            if ($result && $result2) {
                $this->success('科目二充值成功！');
            } else {
                $this->error('科目二充值失败，请重试！');
            }
        }
        if ($_POST['czkemu3']) {
            $cz = M('chongzhi');
            $data['user_id'] = $_POST['userid'];
            $data['kemu'] = "科目三";
            $data['num'] = $_POST['num3'];
            $data['riqi'] = Date('Y-m-d h:i:s');
            $result = $cz->data($data)->add();   //添加科目三充值记录
            $xueshi = $this->get_user_kemu($_POST['userid']);
            $xueshi_k3 = $xueshi['xueshi_k3'] + $_POST['num3'];
            $user = M('user');
            $con['xueshi_k3'] = $xueshi_k3;
            $result2 = $user->where("user_id = $_POST[userid]")->data($con)->save();  //更新学员的学时
            if ($result && $result2) {
                $this->success('科目三充值成功！');
            } else {
                $this->error('科目三充值失败，请重试！');
            }
        }
    }

    /**
     * 获取学员科目数
     * @param $userid
     * @return mixed
     */
    function get_user_kemu($userid)
    {
        $st = M('user');
        $kemu = $st->where("user_id = '$userid'")->select();
        return $kemu[0];
    }

    /**
     * 查询充值记录
     */
    function chongzhi_list()
    {
        $excel_name = time();   // 导出execl 表名
        $this->check_admin();
        $cz = M('chongzhi');
        if ($_POST['cz_cha'] || $_POST['cz_excel']) {
            if ($_POST['name'] == '') {
                $this->error('学员名称不能为空！');
            }
            $con['true_name'] = array('like', '%' . $_POST['name'] . '%');
            $list = $cz->join('order_user on order_chongzhi.user_id = order_user.user_id ')
                ->where($con)->order('cz_id desc')->select();
            if ($_POST['cz_excel']) {
                foreach ($list as $a) {
                    $list_f = array(
                        'name' => $a['true_name'],
                        'kemu' => $a['kemu'],
                        'num' => $a['num'],
                        'riqi' => $a['riqi'],);
                    $list_arr[] = $list_f;
                }
                exportexcel($list_arr, array('学员姓名', '充值科目', '充值学时', '充值时间'), $excel_name);
                exit();
            }
        } else {
            import('ORG.Util.Page');// 导入分页类
            $count = $cz->join('order_user on order_chongzhi.user_id = order_user.user_id ')->count();
            $Page = new Page($count, 13);    // 实例化分页类
            $show = $Page->show();
            $list = $cz->join('order_user on order_chongzhi.user_id = order_user.user_id ')
                ->limit($Page->firstRow . ',' . $Page->listRows)->order('cz_id desc')->select();
            $this->assign('page', $show);// 赋值分页输出
        }
        $this->assign('stname', $_POST['name']);
        $this->assign('czlist', $list);
        $this->display('chongzhi');
    }

    /**
     * 修改教练手机是否显示
     */
    function mobel_zt()
    {
        $config = M('config');
        $data['moble_zt'] = $_POST['show'];
        $data['id'] = '1';
        $result = $config->data($data)->save();
        if ($result) {
            $this->success('修改显示信息成功！');
        } else {
            $this->error('修改显示信息失败！');
        }
    }

    /**
     * 修改作息时间 夏季作息中午多休息1小时
     */
    function change_zuoxi()
    {
        $config = M('config');
        $data['zuoxi'] = $_POST['zuoxi'];
        $data['id'] = '1';
        $result = $config->data($data)->save();
        $time = M('time');
        if ($_POST['zuoxi'] == '1') {
            $time->where("time_duan = '13:00-14:00'")->data("zhuangtai=1")->save();
            $time->where("time_duan = '18:00-19:00'")->data("zhuangtai=2")->save();
        } else {
            $time->where("time_duan = '13:00-14:00'")->data("zhuangtai=2")->save();
            $time->where("time_duan = '18:00-19:00'")->data("zhuangtai=1")->save();
        }
        if ($result) {
            $this->success('修改作息时间成功！');
        } else {
            $this->error('修改作息时间失败！');
        }

    }

    /**
     * 删除教练照片信息
     * 只取消连接,没有真正删除图片
     */
    function del_photo()
    {
        $tc = M('teacher');
        $data['photo'] = '';
        $file = $tc->where("t_id = '$_GET[tid]'")->select();
        $result = $tc->where("t_id = '$_GET[tid]'")->data($data)->save();
        $photo = "./Uploads/" . $file[0]['photo'];
        $result2 = @unlink($photo);
        if ($result && $result2) {
            $this->success('删除照片成功！');
        } else {
            $this->error('删除照片失败！');
        }
    }

    /**
     * 登陆日志
     */
    function log_list()
    {
        $yue = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
        $moth = date("Y-m-d H:i:s", $yue);      //显示一月的登陆记录
        $log = M('login');
        import('ORG.Util.Page');// 导入分页类
        $count = $log->where("log_time >='$moth'")->count();// 查询满足要求的总记录数
        $Page = new Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $log->where("log_time >='$moth'")->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('log', $list);
        $this->display('log_list');
    }

    /**
     *  修改学员可约车起止时间
     *  修改学员单日约车次数限制
     */
    function yuyuetime()
    {
        if ($_POST['yuyuetime']) {
            $config = M('config');
            $data['start_time'] = $_POST['start'];
            $data['end_time'] = $_POST['end'];
            $data['id'] = '1';
            $result = $config->data($data)->save();
            if ($result) {
                $this->success('修改学员预约时间成功！');
            } else {
                $this->error('修改学员预约时间失败！');
            }
        }

        if ($_POST['yueche_shu']) {
            $config = M('config');
            $data['yuyue_num'] = $_POST['yueche_num'];
            $data['id'] = '1';
            $result = $config->data($data)->save();
            if ($result) {
                $this->success('修改学员当日预约次数成功！');
            } else {
                $this->error('修改学员当日预约次数失败！');
            }
        }
    }

}