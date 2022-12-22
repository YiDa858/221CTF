<?php
require_once 'db.php';
session_start();

// POST题目id及提交的flag
$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$flag = $_POST['flag'];

$row = db_select_one('challenges', array('*'), array('challenges_id' => $id));
// 判断flag是否正确
if ($flag !== $row['flag']) {
    // 错误
    echo '0';
} else {
    // 正确
    echo '1';
    // 查询是否曾经做过此题，若做过则不做其他操作，若没做过则更新users.user_score,users_challenges_information.status,teams.teams.score
    $user_status = db_select_one('users_challenges_information', array('*'), array('users_id' => $user_id));
    $status = $user_status['status'];
    $challenges = explode(',', $status);
    $i = 0;
    foreach ($challenges as $challenge) {
        if ($challenge == $id) {
            $i = 1;
            break;
        }
    }
    if ($i !== 1) {
        $status .= ',' . $id;
        // 更新users_challenges_information.status
        db_update('users_challenges_information', array('status' => $status), array('users_id' => $user_id));
        $user = db_select_one('users', array('*'), array('Id' => $user_id));
        $user_score = $user['user_score'];
        $challenge_score = $row['challenges_score'];
        $user_score += $challenge_score;
        // 更新users.user_score
        db_update('users', array('user_score' => $user_score), array('Id' => $user_id));
        $team = db_select_one('teams', array('*'), array('teams_id' => $user['teamId']));
        $team_score = $team['teams_score'] + $challenge_score;
        // 更新teams.teams_score
        db_update('teams', array('teams_score' => $team_score), array('teams_id' => $user['teamId']));
    }
}