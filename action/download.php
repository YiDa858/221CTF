<?php
require_once 'db.php';
/**
 * 实现misc/re/crypto等通过下载附件做题的功能
 * head()和fread()函数把文件直接输出到浏览器
 */

session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">alert("您无权访问");location="../login.php";</script>';
}

$id = $_POST['challenge_id'];

echo "<script type='text/javascript'>alert($id)</script>";

if (!empty($_POST['challenge_id']) && preg_match("/^[1-9][0-9]*$/", $_POST['challenge_id'])) {

    // SELECT * FROM challenges WHERE challenges_id=$id
    $row = db_select_one('challenges', array('*'), array('challenges_id'=>$id));

    if (!$row) {
        //题目不存在
        echo '<script type="text/javascript">alert("题目不存在");location="../challenges.php";</script>';
        exit;

    }

    $file_name = $row['challenges_name'] . ".zip"; //下载文件名

    $file_dir = "../challenges/misc/";           //下载文件存放目录

    //检查文件是否存在
    if (!file_exists($file_dir . $file_name)) {
        header('HTTP/1.1 404 NOT FOUND');
    } else {
        //以只读和二进制模式打开文件
        $file = fopen($file_dir . $file_name, "rb");
        $len = filesize($file_dir . $file_name);

        //读取文件内容并直接输出到浏览器
        if (!$file) {
            exit;
        } else {
            while (!feof($file)) {
                echo fread($file, 1024);
            }
            fclose($file);
        }

        exit ();
    }
} else {
    //题目id 有误
    header('location:challenges.php');
    exit;
}

//        //告诉浏览器这是一个文件流格式的文件
//        Header("Content-type:application/octet-stream");
//        //请求范围的度量单位
//        Header("Accept-Ranges: bytes");
//        Header("Content-Transfer-Encoding: binary");
//        //Content-Length是指定包含于请求或响应中数据的字节长度
//        Header("Accept-Length: " . $len);
//        //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
//        Header("Content-Disposition: attachment; filename=attachment.zip");