<?php
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
            if(3 == $user['usertype']){
                jumpto(constant("HOME")."/views/adminframe.html");
            }
        }   
    }
?>