<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/hwclasshelper.php");

$teacher = null;
$students = null;
$hwcls = null;

function updatemessage($classid)
{
    global $teacher; 
    global $students;
    global $hwcls;
    $teacher = hwclass::getclassteacher($classid);
    $students = hwclass::getclassstudent($classid);
    $hwcls = hwclass::gethwclassbyid($classid);

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['t'])) {
        $classid = $_GET['t'];
        updatemessage($classid);
        $_SESSION['classid'] = $classid;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['classid'])) {
        echo "<br><font color=\"#FF0000\">ERROR</font></br>";
        exit();
    }

    if ($_POST["uptea"]) {
        if (!hwclass::updateteacher($_SESSION['classid'], $_POST["teaname"])) {
            echo "<br><font color=\"#FF0000\">更新老师失败</font></br>";
        }
    } elseif ($_POST["addstu"]) {
        if (!hwclass::insertstudent($_SESSION['classid'], $_POST["stuname"])) {
            echo "<br><font color=\"#FF0000\">添加学生失败</font></br>";
        }
    }
    updatemessage($_SESSION['classid']);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<title>班级编辑</title>
</head>

<body>
<p>班名:<?php
if (null != $hwcls) {
    echo $hwcls->hwclassname;
}
?></p>
<p>老师：<?php
if (null != $teacher) {
    echo $teacher->userdisplay;
}
?></p>
<form id="form1" name="form1" method="post" action="">
  修改
    <input type="text" placeholder="请输入账号" name="teaname" />
    <input type="submit" name="uptea" value="更新" />
</form>
<p>学生</p>
<form id="form2" name="form2" method="post" action="">
  添加
    <input type="text" placeholder="请输入账号" name="stuname" />
    <input type="submit" name="addstu" value="新增" />
</form>
<p>&nbsp;</p>
<table class="bordered">
    <thead>

    <tr>     
        <th>用户名</th>
		<th>姓名</th>
    </tr>
    </thead>
<?php
if (null != $students) {
    foreach ($students as $stu) {
        echo ("<tr><td>" . $stu->username . "</td><td>" . $stu->userdisplay .
            "</td></tr>");
    }
}
?>
</table>
<p>&nbsp;</p>
</body>
</html>
