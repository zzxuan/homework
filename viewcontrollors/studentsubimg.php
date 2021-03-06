<?php
session_start();
require_once ("../common.php");
require_once("../phplibs/functions.php");

checklogin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"];
        exit();
    }
    $picname = $_FILES['mypic']['name'];
    $picsize = $_FILES['mypic']['size'];
    $updir = "/data/studentfiles/";
    if ($picname != "") {
        $type = strstr($picname, '.'); //限制上传格式
        $type =  strtolower($type);//转为小写
        if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".bmp" &&
            $type != ".jpeg") {
            echo '图片格式不对！';
            exit;
        }
        $rand = rand(100, 999);
        $pics = 'student'.date("YmdHis") . $rand . $type; //命名图片名称
        //上传路径
        $upfile = dirname(dirname(__FILE__)).$updir;
        if (!file_exists($upfile)) { // 判断存放文件目录是否存在
            mkdir($upfile, 0777, true);
        }
        $pic_path = $upfile . $pics;
        $tem_path = $upfile."tem".$pics;
        if(!is_uploaded_file($_FILES['mypic']['tmp_name'])){
            echo '上传文件出错';
            exit;
        }
        if(!move_uploaded_file($_FILES['mypic']['tmp_name'], $tem_path)){//移到临时目录
            echo '移动文件出错';
            exit;
        }
        if(!scal_pic($tem_path,$pic_path)){
            echo '压缩图片出错...';
            exit;
        }
        unlink($tem_path);//删除临时文件
    }
    $arr = array(
        'name' => $picname,
        'pic' => $pics,
        'picsrc' =>HOME.$updir.$pics,
        'size' => $picsize);
    echo json_encode($arr); //输出json数据

}


?>