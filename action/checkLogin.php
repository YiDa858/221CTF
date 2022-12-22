<?php
error_reporting(0);
require_once 'db.php';
session_start();

if ($_POST['vcode'] != $_SESSION['authcode']) {
    echo '<script type="text/javascript">alert("验证码错误！");location.href="../login.php";</script>';
}else {
    unset($_SESSION['authcode']);
}

//检查登录
if (!empty($_POST['user']) && !empty($_POST['passwd'])) {

    $user_name = $_POST['user'];
    $password = $_POST['passwd'];

    // SELECT * FROM users WHERE username=$user_name
    $row = db_select_one('users', array('*'), array('username' => $user_name));

    if ($row) {
        if ($user_name == $row["username"] && $password == $row["passwd"]) {


            $_SESSION['user_id'] = $row['Id'];

            if ($row['is_admin'] == 1) {
                header('location:../admin/index.php');
            } else {
                //跳转到主页面
                header('location:../index.php');
                exit;
            }
        } else {
            echo '<script type="text/javascript">alert("用户名或密码错误");location.href=".././login.php";</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("用户不存在");location.href="../login.php";</script>';
    }
} else {
    echo '<script type="text/javascript">alert("请输入用户名和密码");location.href="../login.php";</script>';
}
