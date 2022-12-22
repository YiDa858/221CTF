<?php
require_once 'pages.php';
session_start();

if (!isset($_SESSION)) {
    echo '<script type="text/javascript">alert("您无权访问");location="login.php";</script>';
} else {
    $challenges = new pages();
    $challenges->showHeader();
    $challenges->showTitle();
    $challenges->showMenu();
    $challenges->showChallenges();
    $challenges->showFooter();
}