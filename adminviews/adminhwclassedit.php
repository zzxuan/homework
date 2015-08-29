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
<title>班级编辑</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../styles/js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>

</head>

<body>
<div class="mainframeinfo">
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
    <input type="text" placeholder="请输入账号" name="teaname" class="dfinput"/>
    <input type="submit" name="uptea" value="更新" class="btn"/>
</form>
<p>学生</p>
<form id="form2" name="form2" method="post" action="">
  添加
    <input type="text" placeholder="请输入账号" name="stuname" class="dfinput" />
    <input type="submit" name="addstu" value="新增" class="btn"/>
</form>
<p>&nbsp;</p>
<table class="tablelist">
    <thead>

    <tr>     
        <th>用户名</th>
		<th>姓名</th>
    </tr>
    </thead>
    <tbody>
<?php
if (null != $students) {
    foreach ($students as $stu) {
        echo ("<tr><td>" . $stu->username . "</td><td>" . $stu->userdisplay .
            "</td></tr>");
    }
}
?>
</tbody>
</table>
</div>
<script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
