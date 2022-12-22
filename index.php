<?php
require_once 'pages.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">alert("您无权访问");location="login.php";</script>';
} else {
    $index = new pages();
    $index->showHeader();
    ?>
    <div style="color: white">
        <?php
        $index->showTitle();
        $index->showMenu();
        $index->showIndex();
        ?>
    </div>
    <?php
    $index->showFooter();
}