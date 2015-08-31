<?php
date_default_timezone_set('PRC');

require_once ('phplibs/hwconstant.php');
require_once ('phplibs/userhelper.php');

define("HOME", "/homework");

function checklogin()
{
    if (!isset($_SESSION['userinfo'])) {
        //header("Location: /homework/login.php");
        jumpto(constant("HOME") . "/login.php");
    }
}

function getloginuser()
{
    $se = $_SESSION['userinfo'];

    $user = new hwuser();
    $user->userid = $se['userid'];
    $user->username = $se['username'];
    $user->userpassword = $se['userpassword'];
    $user->userdisplay = $se['userdisplay'];
    $user->usertype = $se['usertype'];
    //echo "id = " . $user->userid . ",name = " . $user->username . ",type = " . $user->usertype;
    return $user;
}


function jumpto($url)
{
    echo "<script language=\"javascript\">";
    echo "document.location=\"" . $url . "\"";
    echo "</script>";
}

function gotoMainview()
{
    if (isset($_SESSION['userinfo'])) {
        $user = getloginuser();
        if (USERADMIN == $user->usertype) {
            jumpto(constant("HOME") . "/adminviews/adminframe.php");
        } else
            if (USERTEACHER == $user->usertype) {
                jumpto(HOME . "/teacherviews/teacherframe.php");
            } else
                if (USERSTUDENT == $user->usertype) {
                    jumpto(HOME . "/studentviews/studentframe.php");
                }
    }
}
?>