<?php
session_start();
require_once ("../common.php");
checklogin();

require_once ("hmworksubhelper.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['studentdubhmid'])) {
        echo "选择作业出错";
        exit;
    }
    $user = getloginuser();
    if ($user->usertype != USERSTUDENT) {
        echo "请以学生登录";
        exit;
    }
    $hmid = $_SESSION['studentdubhmid'];
    $desc = $_POST['desc'];
    $imgarr = $_POST['imgarr'];
    $studid = $user->userid;

    if(!hmworksub::addhmksub($hmid,$studid,$desc,$imgarr)){
        echo "提交失败";
        exit;
    }
    $arr = array('hmid' => $hmid,'uid'=>getloginuser()->userid);
    echo json_encode($arr); //输出json数据
}
?>