<?php

require_once("un_file.php");
require_once("db.php");

// 除了传输文件 还需要 post 传输数据
// 1. 题目类型 2. 题目分值设定 3. flag 设定  4. 是否隐藏题目 5.题目描述

$posts = array("score", "name", "type", "checkboxSuccess", "flag", "brief");
$info_value = array();

// 题目上传 相应信息
foreach ($posts as $post) {
    if (empty($_POST[$post]) && $post !== 'brief' && $post !== 'checkboxSuccess') {
        echo '<script type="text/javascript">alert("所填信息不完整");location="../admin/quesAdd.php";</script>';
    }
    if (empty($_POST[$post]) && $post === 'brief') {
        array_push($info_value, '开始做题吧!');
        continue;
    }
    if (empty($_POST[$post]) && $post === 'checkboxSuccess') {

        array_push($info_value, 0);
        continue;
    }
    array_push($info_value, $_POST[$post]);
}

// 查找可用 题目ID号
$insert_id = cheak_id();
Array_unshift($info_value, $insert_id);


// CTF 题目类型
$ctftype = array("misc", "pwn", "web", "crypto", "reverse");

// 允许上传的压缩包后缀
$allowedExts = array("zip", "rar", "7z");

$temp = explode(".", $_FILES["file"]["name"]); // 字符串打散为数组
$extension = end($temp);     // 获取文件后缀名
$extension = strtolower($extension);// 后缀小写处理

// 文件类型
//   7z  application/octet-stream
//　　zip application/x-zip-compressed
//   rar application/octet-stream

if ((($_FILES["file"]["type"] == "application/x-zip-compressed")
        || $_FILES["file"]["type"] == "application/octet-stream")
    && ($_FILES["file"]["size"] < 204800000)   // 小于 200 MB
    && in_array($extension, $allowedExts)) {

    if ($_FILES["file"]["error"] > 0) {
        echo '<script type="text/javascript">alert("文件上传时发生错误，请重新发送");location="../admin/quesAdd.php"</script>';
        //echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    } else if (isset($_POST['type'])) {

        $type = $_POST['type'];
        if (!in_array($type, $ctftype)) {
            echo '<script type="text/javascript">alert("无此题目类型");location="../admin/quesAdd.php"</script>';
            exit;
        }

        //echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        //echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        //echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        //echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

        // 判断当前目录下的 challenges 目录是否存在该文件
        $path = "../challenges/" . $type . "/" . $_FILES["file"]["name"];
        if (file_exists($path)) {
            echo "<script type='text/javascript'>alert('题库中已存在该题目');window.opener=null;window.open('','_self');window.close();</script>";
            exit;
        } else {
            if (($extension === '7z' || $extension === 'rar') && ($type === 'pwn' || $type === 'web')) {
                echo '<script type="text/javascript">alert("(web pwn)暂不支持 .rar .7z类型压缩包上传");location="../admin/quesAdd.php"</script>';
//                   if($extension==='rar') {$up_file->unrar_file($path, "winrar");}
//                   else{$up_file->unrar_file($path,  "7za");}
                exit;
            }
            // 将文件上传到 challenges 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], $path);

            // 若是 web pwn 类型的题目，需要将压缩包解压到当前目录
            if ($type === "web" || $type === "pwn") {
                $up_file = new un_file();

                if ($extension === 'zip') {
                    $up_file->unzip_file($path);
                }
            }


            db_insert("challenges", array("challenges_id" => $info_value[0], "challenges_score" => $info_value[1]
            , "challenges_name" => $info_value[2], "challenges_type" => $info_value[3], "is_delete" => $info_value[4]
            , "flag" => $info_value[5], "hints" => $info_value[6]));

            echo "<script type='text/javascript'>alert('题目已上传');location='../admin/quesAdd.php'</script>";
        }
    } else {
        echo '<script type="text/javascript">alert("题目类型未设置");location="../admin/quesAdd.php"</script>';
    }
} else {
    if (isset($_FILES["file"]["name"]))
        echo '<script type="text/javascript">alert("非法题目类型");location="../admin/quesAdd.php"</script>';
}

?>
