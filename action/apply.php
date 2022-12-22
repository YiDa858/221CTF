<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'];
$team_id = $_POST['team_id'];

if ($_POST['apply'] === 1) {
    $row = db_select_one('users', array('*'), array('Id' => $user_id));
    if (!empty($row['apply']) && $row['apply'] == $team_id) {
        echo '您已申请过该战队，请勿重复申请';
    } else if (!empty($row['apply']) && $row['apply'] != $team_id) {
        echo '您正在申请其他战队';
    } else {
        $row = db_select_one('teams', array('*'), array('teams_id' => $team_id));
        $apply = $row['apply'];
        if ($apply === '') {
            $apply .= $user_id;
        }else {
            $apply .= ',' . $user_id;
        }
        db_update('teams', array('apply'=>$apply), array('teams_id'=>$team_id));
        db_update('users', array('apply'=>$team_id), array('Id'=>$user_id));
    }
}