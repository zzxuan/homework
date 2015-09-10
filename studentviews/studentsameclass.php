<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/userhelper.php");
require_once ("../phplibs/hwclasshelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>同学们</title>
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
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>作业查看</li>
    <li>作业列表</li>
    </ul>
</div>

<div class="mainframeinfo">

<table class="tablelist">
    <thead>

    <tr>     
        <th>姓名</th>
        <th>班级</th>
		<th>查看作业</th>
        <th>个人简介</th>
    </tr>
    </thead>
    <tbody>
<?php
$user = getloginuser();
if ($user->usertype == USERSTUDENT) { //如果是学生
    $students = hwclass::getsameClassStduents($user->userid);
    if ($students != null) {
        foreach ($students as $std) {
            echo "<tr>
            <td>" . $std->userdisplay . "</td>
            <td>" . $std->hwclassname . "</td>
            <td><a href=\"../studentviews/studentoldhmwork.php?id=".$std->userid."\" class=\"tablelink\">查看作业</a></td>
            <td><a href=\"#\">个人简介</a></td>
            </tr>";
        }
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
