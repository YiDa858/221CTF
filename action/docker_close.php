<?php
//require_once 'db.php';

//session_start();
//
//$id = $_POST['challenge_id'];
//
//// SELECT * FROM challenges WHERE challenges_id=$id
//$row = db_select_one('challenges', array('*'), array('challenges_id' => $id));
//
//// 题目地址
//$path = "D:\\221CTF\\tmp\\" . $_SESSION['user_id'];
//
//$cmd = "cd $path && docker-compose down";
//
//exec($cmd);
//
//$cmd = "rd /s /q $path";
//
//exec($cmd);
$psPath = 'C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe';

$cmd = "$psPath docker stop $(docker ps -aq)";

exec($cmd);

$cmd = "$psPath docker rm $(docker ps -aq)";

exec($cmd);