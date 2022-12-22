<?php
require_once("../action/db.php");

// 对压缩包进行解压
class un_file
{
    public function unzip_file($file)
    {

       $temp=substr($file,0,strlen($file)-strlen(strstr($file,".zip")));

        // 实例化对象
        $zip = new ZipArchive();

        //打开zip文档，如果打开失败返回提示信息
        if ($zip->open($file) !== TRUE) {
            die ("Could not open archive");
        }

        //将压缩文件解压到指定的目录下
        if (file_exists($temp)) {
            $zip->close();
            echo '<script type="text/javascript">alert("题库中已存在该题目");location="../admin/quesAdd.php"</script>';
            exit;
        }
        $zip->extractTo($temp);

        //关闭zip文档
        $zip->close();

        // 删除压缩包
        if (file_exists($file)) {
            $result = @unlink($file);
            if ($result == true) {
              ;
            }
        }
    }

    public function unrar_file($file,$exe){

        $temp=substr($file,0,strlen($file)-strlen(strstr($file,".zip")));

        $obj = new com("wscript.shell");

        if($obj){
            $obj->run($exe.' x '.$file.' -o'.$temp, 0, true);
        }else{
            return false;
        }
        // 删除压缩包
        if (file_exists($file)) {
            $result = @unlink($file);
            if ($result == true) {
                ;
            }
        }
        $obj->Quit();
        $obj->Release();

//        //双引号可以解析变量
//        $obj->run("winrar x $filepath $path",1,true);
//        //删除源文件
//        @unlink($filename);
//        $obj = null;
    }
}

function cheak_id()
{
    // 查找可用 题目ID号
    $rows = db_select_all('challenges', array('challenges_id'));
    $pre=9999;$now=$pre;
    foreach ($rows as $row)
    {
        if($row['challenges_id']-$pre!==1)
        {
            $pre=$pre+1;
            break;
        }
        $pre=$row['challenges_id'];
        $now=$row['challenges_id'];
    }
    if($pre==$now)
    {
        $pre=$now+1;
    }

    return $pre;
}
?>