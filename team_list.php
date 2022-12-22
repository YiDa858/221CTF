<?php
//error_reporting(0);
require_once './pages.php';
session_start();

if(!isset($_SESSION['user_id']))
{
    echo '<script type="text/javascript">alert("您无权访问");location.href="login.php";</script>';
} else {
    $list = new pages();
    $list->showHeader();
    $list->showTitle();
    $list->showMenu();
    $list->showTeamList();
    $list->showFooter();
}
