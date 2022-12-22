<?php
//error_reporting(0);
require_once 'db.php';
session_start();

if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['original']) && !empty($_POST['new'])) {
    $id = $_SESSION['user_id'];

    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $original = $_POST['original'];
    $new = $_POST['new'];

    $row = db_select_one('users', array('*'), array('Id' => $id));

    if ($original === $row["passwd"]) {
        if ($user_name != $row["username"]) {
            $rows = db_select_one('users', array('*'), array('username' => $user_name));
            if ($rows) {
                echo '<script type="text/javascript">alert("此用户名已被占用");location.href="../change.php";</script>';
            } else {
                db_update('users', array('username' => $user_name, 'passwd' => $new), array('Id' => $id));
            }
        } else {
            db_update('users', array('passwd' => $new), array('Id' => $id));
        }
        if ($email !== $row["email"]) db_update('users', array('email' => $email), array('Id' => $id));

        echo '<script type="text/javascript">alert("个人信息修改成功");location.href="../change.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("当前密码错误");location.href="../change.php";</script>';
    }

} else {
    echo '<script type="text/javascript">alert("请输入当前密码和新密码");location.href="../change.php";</script>';
}