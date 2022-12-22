<?php
require_once './pages.php';
session_start();

if(!isset($_SESSION['user_id']))
{
    echo '<script type="text/javascript">alert("您无权访问");location="login.php";</script>';
}

$affiliation=new pages();
$affiliation->showHeader();
$affiliation->showTitle();
$affiliation->showMenu();
$affiliation->showTeam();
$affiliation->showFooter();