<?php
$black = array('<', '>', "'", "\"", '%27', '%22');
foreach ($black as $item) {
    if (strpos("123", $item) !== false) echo '1';
}