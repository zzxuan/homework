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
    if (hwclass::addhwclass($_POST['hwclassname'], $_POST['hwclassdesc'])) {
        jumpto("adminhwclass.php");
        exit();
    } else {
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
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="formbody">
    <div class="formtitle"><span>添加班级</span></div>
    <form id="form1" name="form1" method="post" action="">
        <ul class="forminfo">
          <li><label>名称</label>
            <input type="text" name="hwclassname" class="dfinput"/>
            <i>标题不能超过30个字符</i>
            </li>
            <li>
          <label>描述</label>	
            <textarea name="hwclassdesc" cols="60" rows="20" class="textinput"></textarea>
            </li>
          <li>
            <label>&nbsp;</label>
            <input type="submit" name="Submit" value="提交" class="btn"/>
          </li>
          </ul>
    </form>
</div>
</body>
</html>
