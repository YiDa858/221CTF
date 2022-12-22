<?php
//error_reporting(0);
require_once './action/db.php';

class pages
{
    public function showHeader()
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>221CTF</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="assets/css/challenge-border.css" rel="stylesheet">
        <link href="assets/css/block.css" rel="stylesheet">
        <link href="assets/css/index.css" rel="stylesheet">

        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </head>
    <body>

    <?php
    }

    public function showTitle()
    {
        ?>
        <div class="container">
            <h1 class="text-center">
                <strong>221CTF</strong>
            </h1>
        </div>
        <?php
    }

    public function showMenu()
    {
        ?>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="index.php">首页</a>
                        </li>
                        <li>
                            <a href="challenges.php">题目列表</a>
                        </li>
                        <li>
                            <a href="team_list.php">战队列表</a>
                        </li>
                        <li class="dropdown pull-right">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">用户<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="profile.php">个人资料</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="team.php">战队情况</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">题目完成情况</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="quit.php">注销</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    public function showIndex()
    {
        ?>
        <video playsinline autoplay muted loop poster="assets/img/Code_08.mp4">
            <source src="assets/img/Code_08.mp4">
        </video>
        <div class="container">
            <div id="polina">
                <h1>221CTF</h1>
                <p></p>
                <p>
                    <a href="challenges.php">现在就进入展示</a>
                </p>
            </div>
        </div>
        <?php
    }

    public function showFooter()
    {
    ?>
    </body>
    </html>
    <?php
}

    public function showLogin()
    {
        ?>
        <br>
        <div class="container">
            <div class="row">
                <form class="form-horizontal" role="form" action="./action/checkLogin.php" method="post">
                    <div class="form-group">
                        <label for="user" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user" placeholder="请输入用户名" name="user"
                                   autofocus="autofocus">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwd" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="passwd" placeholder="请输入密码" name="passwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vcode" class="col-sm-2 control-label">验证码</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" maxlength="4" placeholder="请输入验证码" name="vcode"/>
                            <img id="vcode" src="vcode.php" style="border-radius: 750pt;"
                                 onclick="this.src='vcode.php?r='+Math.random();">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-2">
                            <button type="submit" class="btn btn-dark">登录</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" onclick="register()" class="btn btn-dark">注册</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function register() {
                window.location.href = "./register.php";
            }
        </script>
        <?php
    }

    public function showRegister()
    {
        ?>
        <br>
        <div class="container">
            <form class="form-horizontal" role="form" action="../221CTF/action/checkRegister.php" method="post">
                <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="user" placeholder="请输入用户名" name="user"
                               autofocus="autofocus">
                    </div>
                </div>
                <div class="form-group">
                    <label for="passwd" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="passwd" placeholder="请输入密码" name="passwd">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_passwd" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="confirm_passwd" placeholder="请再次输入密码"
                               name="confirm_passwd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-2">
                        <button type="submit" class="btn btn-default">注册</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    public function showProfile()
    {
        ?>
        <div class="container">
            <div class="row clearfix">
                <main role="main">
                    <div class="jumbotron">
                        <div class="container">
                            <h1>个人资料</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <?php
                        $id = $_SESSION['user_id'];
                        $row = db_select_one('users', array('*'), array('Id' => $id));
                        $na = $row['username'];
                        $mail = $row['email'];
                        $team_id = $row['teamId'];
                        // SELECT teams_name FROM teams WHERE teamId=10000
                        $team_name = db_select_one('teams', array('teams_name'), array('teams_id' => $team_id));
                        $nam = $team_name['teams_name'];
                        ?>
                        <form id="Profile" method="post" accept-charset="utf-8" autocomplete="off" role="form"
                              class="form-horizontal">
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <?
                                echo "<input class='form-control input-filled-valid' type='text' name='Username'
                                       id='inputUsername' value=$na>";
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <?
                                echo "<input class='form-control input-filled-valid' type='text' name='Email'
                                       id='inputEmail' value=$mail>";
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="inputTeam">Team</label>
                                <?
                                echo "<input class='form-control input-filled-valid' type='text' name='Team'
                                       id='inputTeam' value=$nam>";
                                ?>
                            </div>
                        </form>
                        <hr>
                        <div class="text-right">
                            <a class="btn btn-dark" href="change.php" role="button">修改个人信息</a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php

    }

    public function showChange()
    {
        ?>
        <div class="container">
            <div class="row clearfix">
                <main role="main">
                    <div class="jumbotron">
                        <div class="container">
                            <div class="text-center">
                                <h1>个人资料修改</h1>
                            </div>
                        </div>
                    </div>
                    <?php
                    $id = $_SESSION['user_id'];
                    $row = db_select_one('users', array('*'), array('Id' => $id));
                    $na = $row['username'];
                    $mail = $row['email'];
                    ?>
                    <div class="col-md-6 col-md-offset-3">
                        <form id="Change" method="post" accept-charset="utf-8" autocomplete="off" role="form"
                              class="form-horizontal" action="./action/profile_change.php">
                            <div class="form-group">
                                <label for="inputUsername">用户名</label>
                                <?
                                echo "<input class='form-control input-filled-valid' type='text' name='username'
                                       id='inputUsername' value=$na>"
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">邮箱地址</label>
                                <?
                                echo "<input class='form-control input-filled-valid' type='text' name='email'
                                             id='inputEmail' value=$mail>";
                                ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="inputOriginal">当前密码</label>
                                <input class="form-control" type="password" name="original" id="inputOriginal">
                            </div>
                            <div class="form-group">
                                <label for="inputNew">新密码</label>
                                <input class="form-control" type="password" name="new" id="inputNew">
                            </div>
                            <hr>
                            <div class="text-right">
                                <input class="btn btn-dark" type="submit" value="确定">
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <?php
    }

    public function showTeam()
    {
        ?>
        <div class="container">
            <div class="row clearfix">
                <main role="main">
                    <div class="jumbotron">
                        <div class="container">
                            <div class="text-center">
                                <?php
                                // SELECT teams_name FROM teams WHERE teams_id=10000
                                $rows = db_select_one('teams', array('teams_name'), array('teams_id' => '10000'));
                                $na = $rows['teams_name'];
                                echo "<h1>$na</h1>";
                                ?>

                            </div>
                            <div class="text-right">
                                <span><b>总解题数：xx</b></span>
                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <td class="col-md-3">
                                            <b>职务</b>
                                        </td>
                                        <td class="col-md-3">
                                            <b>用户名</b>
                                        </td>
                                        <td class="col-md-3">
                                            <b>邮箱地址</b>
                                        </td>
                                        <td class="col-md-3">
                                            <b>个人分数</b>
                                        </td>
                                    </tr>
                                    </thead>
                                    <?php
                                    $id = $_SESSION['user_id'];
                                    $row = db_select_one('users', array('*'), array('Id' => $id));
                                    $team_id = $row['teamId'];

                                    // SELECT * FROM teams_information WHERE teams_id=10000
                                    $rows = db_select_one('teams_information', array('*'), array('teams_id' => $team_id));
                                    $cid = $rows['teams_captain_id'];
                                    $rows = db_select_one("users", array('*'), array('Id' => $cid));
                                    $cname = $rows['username'];
                                    $cemail = $rows['email'];

                                    ?>
                                    <tbody>
                                    <tr>
                                        <th scope="row">队长</th>
                                        <?
                                        echo "<td>$cname</td>";
                                        echo "<td>$cemail</td>";
                                        ?>
                                        <td>xx</td>
                                    </tr>

                                    <!--<tr>
                                        <th scope="row">队员</th>
                                        <td>姓名</td>
                                        <td>xx</td>
                                        <td>xx</td>
                                    </tr>-->

                                    <!--<tr>
                                        <th scope="row">队员</th>
                                        <td>姓名</td>
                                        <td>xx</td>
                                        <td>xx</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">队员</th>
                                        <td>姓名</td>
                                        <td>xx</td>
                                        <td>xx</td>
                                    </tr>-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
    }

    public function showChallenges()
    {
        ?>
        <div class="container">
            <div class="row clearfix">
                <div class="container">
                    <script>
                        /**
                         * 发送id，接受二进制流，download用于下载文件
                         * @param element 题目id
                         */
                        function ajax_download(element) {

                            var challenge_id = "challenge_id="+element;
                            var xhr = new XMLHttpRequest();

                            if (xhr) {
                                xhr.open("post", "./action/download.php", true);
                                xhr.responseType = 'arraybuffer';
                                xhr.setRequestHeader("content-type", 'application/x-www-form-urlencoded;charset=utf-8');
                                xhr.onload = function () {
                                    const data = xhr.response;
                                    if (!data) alert("null");
                                    // alert(data);
                                    const a = document.createElement('a');
                                    const blob = new Blob([data]);
                                    const blobUrl = window.URL.createObjectURL(blob);
                                    download(blobUrl);
                                }
                                xhr.send(challenge_id);
                            }

                            function download(blobUrl) {
                                const a = document.createElement('a');
                                a.style.display = 'none';
                                a.download = 'attachment.zip';
                                a.href = blobUrl;
                                a.click();
                                document.body.removeChild(a);
                            }
                        }

                        function ajax_docker(element) {
                            var challenge_id = "challenge_id=" + element;
                            var xhr = new XMLHttpRequest();

                            if (xhr) {
                                //如果实例化成功,就调用open()方法,就开始准备向服务器发送请求
                                xhr.open("post", "./action/docker.php", true);
                                xhr.setRequestHeader("content-type", 'application/x-www-form-urlencoded; charset=utf-8');
                                xhr.send(challenge_id);
                            }

                            alert('开启靶机可能会需要一些时间，请耐心等待~');

                            xhr.onreadystatechange = function () {
                                //验证当前的状态接受返回的信息
                                if (xhr.readyState == 4) {

                                    //接受服务器返回的信息
                                    var info = xhr.responseText;
                                    alert(info);
                                    // ajax_destroy(element);

                                }
                            }
                        }


                        function ajax_destroy(element) {
                            var challenge_id = "challenge_id=" + element;
                            var xhr2 = new XMLHttpRequest();

                            if (xhr2) {
                                //如果实例化成功,就调用open()方法,就开始准备向服务器发送请求
                                xhr2.open("post", "./action/docker_close.php", true);
                                xhr2.send(challenge_id);
                                return ;
                            }
                        }

                    </script>

                    <ul class="nav nav-pills" role="tablist">
                        <li role="presentation"><a href="#misc" aria-controls="misc" role="tab"
                                                   data-toggle="pill">Misc</a></li>
                        <li role="presentation"><a href="#web" aria-controls="web" role="tab"
                                                   data-toggle="pill">Web</a>
                        </li>
                        <li role="presentation"><a href="#pwn" aria-controls="pwn" role="tab"
                                                   data-toggle="pill">Pwn</a>
                        </li>
                        <li role="presentation"><a href="#crypto" aria-controls="crypto" role="tab"
                                                   data-toggle="pill">Crypto</a>
                        </li>
                        <li role="presentation"><a href="#reverse" aria-controls="reverse" role="tab"
                                                   data-toggle="pill">Reverse</a></li>
                    </ul>
                    <div class="tab-content">
                        <?php
                        $types = array('misc', 'web', 'pwn', 'crypto', 'reverse');

                        foreach ($types as $type) {
                            echo "<div role='tabpanel' class='tab-pane fade in active' id=$type>\n";

                            // SELECT * FROM challenges WHERE challenges_type=$type
                            $rows = db_select_all('challenges', array('*'), array('challenges_type' => $type));

                            foreach ($rows as $row) {
                                if ($row['is_delete'] == 1) {
                                    continue;
                                }
                                $id = $row['challenges_id'];
                                $name = $row['challenges_name'];
                                $type = $row['challenges_type'];
                                $light = '"' . $id . '-light"';
                                $fade = '"' . $id . '-fade"';
                                $display = '"block"';
                                $none = '"none"';
                                if ($type === 'web' || $type === 'pwn') {
                                    echo "<div id='challenge-$id' class='col-md-3 md-inline-block challenge-border'>
                                        <button class='btn btn-dark challenge-button w-100 text-truncate pb-3 pt-3 mb-2' onclick='document.getElementById($light).style.display=$display;document.getElementById($fade).style.display=$display'>
                                            <span>$name</span>
                                        </button>
                                      </div>
                                      <div id='$id-light' class='white_content light container'>
                                        <div id='font_login'>Flag</div>
                                        <div id='challenge-$id' class='md-inline-block challenge-border'>
                                           <button id=$id type='button' class='btn btn-dark mb-1 px-2 w-100 text-truncate' onclick='ajax_docker($id)' value=$id>启动靶机
                                            </button>
                                        </div>
                                        <form action='' method='post' id='form_submit'>
                                            <input type='text' class='form-control mb-1 px-2 w-100' name='flag' id='flag' value=''/><br>
                                            <input type='button' value='提交' class='button_beautiful'/>
                                            <input type='button' value='取消' class='button_beautiful' onclick='document.getElementById($light) . style . display = $none;document.getElementById($fade) . style . display = $none'/>
                                        </form>
                                      </div>
                                      <div id='$id-fade' class='black_overlay'></div>";
                                } else {
                                    echo "<div id='challenge-$id' class='col-md-3 md-inline-block challenge-border'>
                                        <button class='btn btn-dark challenge-button w-100 text-truncate pb-3 pt-3 mb-2' onclick='document.getElementById($light).style.display=$display;document.getElementById($fade).style.display=$display'>
                                            <span>$name</span>
                                        </button>
                                      </div>
                                      <div id='$id-light' class='white_content light container'>
                                        <div id='font_login'>Flag</div>
                                        <div id='challenge-$id' class='md-inline-block challenge-border'>
                                           <button id=$id type='button' class='btn btn-dark mb-1 px-2 w-100 text-truncate' onclick='ajax_download($id)' value=$id>Download
                                            </button>
                                        </div>
                                        <form action='' method='post' id='form_submit'>
                                            <input type='text' class='form-control mb-1 px-2 w-100' name='flag' id='flag' value=''/><br>
                                            <input type='button' value='提交' class='button_beautiful'/>
                                            <input type='button' value='取消' class='button_beautiful' onclick='document.getElementById($light) . style . display = $none;document.getElementById($fade) . style . display = $none'/>
                                        </form>
                                      </div>
                                      <div id='$id-fade' class='black_overlay'></div>";
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function showTeamList()
    {
    ?>
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12 column">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>战队ID</th>
                        <th>战队名称</th>
                        <th>队长</th>
                        <th>战队人数</th>
                        <th>申请加入</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rows = db_select_all('teams', array('*'));

                    foreach ($rows as $row) {
                        $name = $row['teams_name'];
                        $id = $row['teams_id'];
                        $team_rows = db_select_one('teams_information',array('*'),array('teams_id'=>$id));
                        $captain_id = $team_rows['teams_captain_id'];
                        $team_status = $team_rows['teams_status'];
                        $captain_names = db_select_one('users',array('*'),array('Id'=>$captain_id));
                        $captain_name=$captain_names['username'];
                        $num = substr_count($team_status,',')+1;

                        echo "<tr id=$captain_id>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$captain_name</td>
                        <td>$num/4</td>
                        <td><a title='申请' onclick=''><span>点击申请</span></a></td>
                      </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    }

    public function showMyChallenges()
    {

    }

    public function showCaptain()
    {

    }
}
