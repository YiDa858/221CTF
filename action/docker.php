<?php
require_once 'db.php';
/**
 * 实现web/pwn通过Docker启动题目环境
 */

session_start();

$id = $_POST['challenge_id'];

if (!empty($_POST['challenge_id']) && preg_match("/^[1-9][0-9]*$/", $_POST['challenge_id'])) {
    // SELECT * FROM challenges WHERE challenges_id=$id
    $row = db_select_one('challenges', array('*'), array('challenges_id' => $id));

    if (!$row) {
        //题目不存在
        echo '<script type="text/javascript">alert("题目不存在");location="../challenges.php";</script>';
        exit();
    }

    // 题目文件夹地址
    $path = "../challenges/" . $row['challenges_type'] . '/' . $row['challenges_name'] . '/';

    $content = file_get_contents($path . 'docker-compose.yml');

    $rand_port = mt_rand(20000, 30000);

    $before = '/\d{1,}:\d{1,}/';

    preg_match($before, $content, $match);

    $after = $rand_port . ":80";

    $content = str_replace($match, $after, $content);

    file_put_contents($path . 'docker-compose.yml', $content);

    $path = "D:\\221CTF\\tmp\\";

    $dir = $_SESSION['user_id'];

    $cmd1 = "cd $path && mkdir $dir";

    exec($cmd1);

    $cmd = 'xcopy D:\\221CTF\\challenges\\' . $row['challenges_type'] . '\\' . $row['challenges_name'] . "\\* $path$dir /e /i /h && cd $path$dir/ && docker-compose up -d";

    $output = shell_exec($cmd);

    echo $row['challenges_name'] . " 题目地址:10.122.192.125:" . $rand_port;
} else {
    //题目id 有误
    header('location:challenges.php');
    exit;
}
