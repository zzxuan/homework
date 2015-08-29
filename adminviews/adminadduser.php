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
                else if(2 == $_SESSION['addusertype']){
                    jumpto('adminstudent.php'); 
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
<title>添加人员</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="formbody">
    <div class="formtitle"><span>
    <?php
        if(!isset($_SESSION['addusertype'])){
            echo "添加人员";
        }
        else if(USERADMIN == $_SESSION['addusertype']){
            echo "添加管理员";
        }else if(USERTEACHER == $_SESSION['addusertype']){
            echo "添加老师";
        }else if(USERSTUDENT == $_SESSION['addusertype']){
            echo "添加学生";
        }
    ?>
    </span></div>
<form action="" method="post">
<ul class="forminfo">
<li><label>登录名：</label>
            <input type="text" name="uname" placeholder="请输入登录名" class="dfinput" />
            </li>
            <li>
  <li><label>姓  名 :</label>
    <input type="text" name="disname" placeholder="请输入姓  名" class="dfinput" />
</li>
  <li><label>密码:</label>
    <input type="password" name="pass1" placeholder="请输入密码" class="dfinput" />
  </li>
  <li><label>再次输入:</label>
    <input type="password" name="pass2" placeholder="请输入密码" class="dfinput" />
  </li>
  <li><label>&nbsp;</label>
    <input type="submit" name="Submit" value="确定" class="btn" />
  </li>
  </ul>
</form>
</div>

</body>
</html>
