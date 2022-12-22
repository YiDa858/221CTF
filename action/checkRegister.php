<?php
error_reporting(0);
require_once 'db.php';
require_once '../admin/delete.php';


if (!empty($_POST['user']) && !empty($_POST['passwd']) && !empty($_POST['confirm_passwd'])) {
    $user_name = $_POST['user'];
    $password = $_POST['passwd'];
    $confirm_password = $_POST['confirm_passwd'];

    // 查询用户名是否已存在
    // SELECT * FROM users WHERE username=$user_name
    $row = db_select_one('users', array('*'), array('username' => $user_name));
    //若用户名已存在
    if ($row) {
        echo "<script type='text/javascript'>alert('用户名已存在,请使用其它用户名'); location='../register.php';</script>";
    } else {
        if ($password !== $confirm_password) {
            echo "<script type='text/javascript'>alert('两次输入密码不一致');location='../register.php';</script>";
        } else {
            $line = cheak_id('users', 'Id');

            // 将注册信息插入users,users_challenges_information表
            db_insert('users', array('username' => $user_name, 'passwd' => $password, 'Id' => $line));

            db_insert('users_challenges_information', array('users_id' => $line, 'status' => ''));

            echo "<script type='text/javascript'>alert('注册成功');location='../login.php';</script>";
        }
    }
}