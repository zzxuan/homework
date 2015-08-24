<?php
    session_start();
    require_once("../common.php");
    checklogin();
    require_once("../phplibs/userhelper.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['t'])){
            $_SESSION['addusertype'] = $_GET['t'];
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_SESSION['addusertype'])){
            echo "<br><font color=\"#FF0000\">ERROR</font></br>";
        }
        else if($_POST['pass1'] == $_POST['pass2']){
            echo $utype;
            $output = null;
            if(hwuser::adduser($_POST['uname'],$_POST['pass1'],$_POST['disname'],$_SESSION['addusertype'],$output)){
                if(1 == $_SESSION['addusertype']){
                    jumpto('adminteacher.php'); 
                }
                exit();
            } 
            else{
                echo "<br><font color=\"#FF0000\">$output</font></br>";
            }
            
        } 
        else{
            echo "<br><font color=\"#FF0000\">输入的密码不一样</font></br>";
        } 
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加老师</title>
</head>

<body><form action="" method="post">
  <p>
    登录名： 
      <input type="text" name="uname" placeholder="请输入登录名"/>
  </p>
  <p>姓  名 :
    <input type="text" name="disname" placeholder="请输入姓  名"/>
</p>
  <p>密码:
    <input type="password" name="pass1" placeholder="请输入密码"/>
  </p>
  <p>再次输入:
    <input type="password" name="pass2" placeholder="请输入密码"/>
  </p>
  <p>
    <input type="submit" name="Submit" value="确定" />
  </p>
</form>
</body>
</html>
