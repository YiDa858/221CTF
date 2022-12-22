<?php

sleep(10);

$path = $argv[1];

$cmd = 'D:\phpstudy_pro\Extensions\php\php7.3.4nts\php.exe D:\221CTF\action\docker_close.php ' . $path;

exec($cmd);

//echo $output;

//$path = $_GET['path'];
//$url = "D:/221CTF/action/docker_close.php?path=" . $path;
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//$content = curl_exec($ch);
//curl_close($ch);