<?php
echo "<!--?source-->";
error_reporting(0);
function fzip_open($fzip = '', $tagdir = '')
{
    if (file_exists($fzip) && is_dir($tagdir)) {
        $zip = new ZipArchive;
        try {
            $status = $zip->open($fzip);
            $status = $zip->extractTo($tagdir);
            $zip->close();
            return $status;
        } catch (Exception $e) {
            return false;
        }
    }
    return false;
}

function moveSqlFile($old_path, $target_path)
{
    $handle = opendir($old_path);
    while (false !== $file = (readdir($handle))) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $substr = substr($file, -4);
        if ($substr === '.sql') {
            rename($old_path . '/' . $file, $target_path . $file);
        }
    }
    closedir($handle);
    if (is_dir($old_path)) {
        deldir($old_path);
    }
}


function deldir($dir)
{
    //先删除目录下的文件：
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
    closedir($dh);

    //删除当前文件夹：
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET['source'])) {
    highlight_file(__FILE__);
}


$userdir = "./sandbox/user_" . md5($_SERVER['REMOTE_ADDR']) . '/';
if (!file_exists($userdir)) {
    mkdir($userdir);
}
if (!empty($_FILES["file"])) {
    // Done，修改html页面提交
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = $_FILES["file"]["name"];
    $extension = substr($name, strrpos($name, ".") + 1);
    $f_path = $userdir . "/" . $name;
    $extension = substr($name, strrpos($name, ".") + 1);

    // Done，./sandbox/user_4b877091ceddf0294739ba5d898192c8//
    if (preg_match("/ph/i", $extension)) die("No Hacker");
    if (mb_strpos(file_get_contents($tmp_name), '<?') !== False) die("No Hacker");
    @move_uploaded_file($tmp_name, $f_path);
    print_r($f_path);

    if ($extension == 'zip') {
        // 生成长度为4的随机字符串
        $patten = "0123456789abcdef";
        $random = '';
        while (true) {
            if (strlen($random) < 4) {
                $rand = rand(0, strlen($patten));
                $random .= substr($patten, $rand, 1);
            } else {
                break;
            }
        }

        // ./sandbox/user_4b877091ceddf0294739ba5d898192c8/tmp_****/
        $tagdir = $userdir . 'tmp_' . $random . '/';
        mkdir($tagdir);

        // 将文件解压到tagdir
        $res = fzip_open($f_path, $tagdir);
        if ($res) {
            //
            moveSqlFile($tagdir, $userdir);
        }

    }
}
?>