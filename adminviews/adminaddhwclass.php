<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/hwclasshelper.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ('' == $_POST['hwclassname'] || '' == $_POST['hwclassdesc']) {
        echo "<br><font color=\"#FF0000\">请先输入....</font></br>";
        exit;
    }
    if(hwclass::addhwclass($_POST['hwclassname'],$_POST['hwclassdesc'])){
        jumpto("adminhwclass.php");
        exit();
    }
    else{
        echo "<br><font color=\"#FF0000\">添加失败....</font></br>";
        exit;
    }

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加班级</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>名称
    <input type="text" name="hwclassname" />
</p>
  <p>描述</p>
  <p>	
    <textarea name="hwclassdesc" cols="60" rows="20"></textarea>
  </p>
  <p>
    <input type="submit" name="Submit" value="提交" />
  </p>
</form>
</body>
</html>
