<?php
    require_once('phplibs/hwconstant.php');
    define("HOME","/homework");
    
    function checklogin(){
        if(!isset($_SESSION['userinfo'])){
            //header("Location: /homework/login.php");
            jumpto(constant("HOME")."/login.php");
        }
    }
    
    function jumpto($url){
        echo "<script language=\"javascript\">";
    	echo "document.location=\"".$url."\"";
    	echo "</script>";
    }
    
    function gotoMainview(){
        if(isset($_SESSION['userinfo'])){
            //echo "12345678";
            $user = $_SESSION['userinfo'];
            //echo "<br>".$user['userid'];
            //echo "<br>".$user['usertype'];
            //echo "<br>".$user['username'];
            if(USERADMIN == $user['usertype']){
                jumpto(constant("HOME")."/adminviews/adminframe.php");
            }
            else if(USERTEACHER == $user['usertype']){
                jumpto(HOME."/teacherviews/teacherframe.php");
            }
        }   
    }
?>