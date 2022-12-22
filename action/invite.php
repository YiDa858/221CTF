<?php
session_start();
require_once 'db.php';
$user_id = $_POST['invite_user'];
$team_id = $_POST['team_id'];

if ($_POST['invite'] === 1) {
    $row = db_select_one('users', array('*'), array('Id' => $user_id));
    if ($row['teamId'] !== null) {
        echo '该用户当前已加入其他战队';
        die();
    }
    if ($row['invite'] === '') {
        $invite = '' . $team_id;
    } else {
        $invites = explode(',', $row['invite']);
        $i = 0;
        foreach ($invites as $invite) {
            if ($invite == $team_id) {
                $i = 1;
                break;
            }
        }
        if ($i !== 1) {
            $invite = $row['invite'] . ',' . $team_id;
        }
    }
    db_update('users', array('invite' => $invite), array('Id' => $user_id));
}