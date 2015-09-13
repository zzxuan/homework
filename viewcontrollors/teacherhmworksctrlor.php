<?php
session_start();
require_once ("../common.php");
checklogin();

require_once ("../phplibs/hmworkhelper.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = getloginuser();
    $mtype = $_POST['mtype'];
    
    if($mtype == 1){//删除作业
        $hmid = $_POST['id'];
        if(!hmwork::deletehmwork($hmid)){
            echo "删除失败"; //输出json数据
            exit();
        }
        $arr = array('hmid' => $hmid,'uid'=>getloginuser()->userid);
        echo json_encode($arr); //输出json数据
        exit();
    }
    
    
}
?>