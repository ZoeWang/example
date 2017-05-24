<?php
header('Content-Type:text/html;charset=utf-8');

class IndexAction extends Action
{
    public function index()
    {
        $info = M('cominfo');
        $com = $info->select();
        $_SESSION['tel'] = $com[0][tel];
        $_SESSION['name'] = $com[0][name];
        $_SESSION['address'] = $com[0][address];
        $_SESSION['linkman'] = $com[0][linkman];
        $this->assign('info', $com[0]);
        $this->display();
    }

    public function login()
    {
        if ($_POST['login']) {
            if ($_POST['usertype'] == 'student') {            //学员登陆
                $userarr = M('User');
                $condition['user_card'] = $_POST[user];
                $user = $userarr->where($condition)->select();
                if (count($user) !== 0 && $user[0][user_id] !== '1') {
                    if ($_POST[user] == $user[0][user_card] && $_POST[password] == $user[0][user_password]) {
                        $_SESSION['user'] = $user[0][true_name];
                        $_SESSION['user_id'] = $user[0][user_id];
                        $_SESSION['user_type'] = '6';       // 学员user_type = 6
                        $_SESSION['class'] = $user[0]['class'];
                        $_SESSION['login'] = "login";
                        $this->success('登录成功', '../Main/shouye');
                    } else {
                        $this->error('密码错误，请重新输入！');
                    }
                } else {
                    $this->error('用户名不存在！');
                }
            } else if ($_POST['usertype'] == 'admin') {          //管理员登陆
                $userarr = M('Admin');
                $condition['username'] = $_POST['user'];
                $user = $userarr->where($condition)->select();
                if ($user) {
                    if ($_POST[user] == $user[0][username] && md5($_POST[password]) == $user[0][password]) {
                        $_SESSION['user'] = $user[0][username];
                        $_SESSION['user_id'] = $user[0][id];
                        $_SESSION['user_type'] = $user[0][user_type];
                        $_SESSION['login'] = "login";
                        $this->add_log($user[0][username]);
                        $this->success('登录成功', '../Main/shouye');
                    } else {
                        $this->error('密码错误，请重新输入！');
                    }
                } else {
                    $this->error('用户名不存在！');
                }
            } else {                             //教练登陆
                $userarr = M('teacher');
                $condition['t_card'] = $_POST['user'];
                $user = $userarr->where($condition)->select();
                if (count($user) !== 0) {
                    if ($_POST[user] == $user[0][t_card] && $_POST[password] == $user[0][t_password]) {
                        $_SESSION['user'] = $user[0][true_name];
                        $_SESSION['user_id'] = $user[0][t_id];
                        $_SESSION['user_type'] = '5';       // 教练user_type= 5
                        $_SESSION['kemu'] = $user[0][kemu];
                        $_SESSION['login'] = "login";
                        $this->success('登录成功', '../Main/shouye');
                    } else {
                        $this->error('密码错误，请重新输入！');
                    }
                } else {
                    $this->error('用户名不存在！');
                }


            }
        }
    }

    function get_user_info($id)
    {                                //获取学员约车数量
        $info = M('info');
        $infolist = $info->where("user_id = '$id' ")->select();
        return count($infolist);
    }


    function add_log($user)
    {       // 添加登录日志
        $log = M('login');
        $data = array('user' => $user,
            'log_ip' => get_client_ip(),
            'log_time' => Date('Y-m-d H:i:s')
        );
        $log->data($data)->add();
    }

    function login_out()
    {                           //退出登录
        session('[destroy]'); // 销毁session
        $this->success('已安全退出登录！', '/index.php');
    }
}