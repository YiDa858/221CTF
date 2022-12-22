<?php
session_start();
unset($_SESSION);


echo '<script type="text/javascript">alert("注销成功");location="login.php";</script>';

