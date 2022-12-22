<?php
require_once './pages.php';

if (isset($_SESSION['user_id'])) {
    header('Location:index.php');
    die('Have Login!');
}

$login = new pages();
$login->showHeader();
$login->showTitle();
$login->showLogin();
$login->showFooter();