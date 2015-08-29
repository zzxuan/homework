<?php
    session_start();
    require_once("../common.php");
    checklogin();
    require_once("../phplibs/userhelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生管理</title>
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
    <div class="tools">
    
    	<ul class="toolbar">
        <li class="click"><a href="adminadduser.php?t=2"><span><img src="../styles/images/t01.png" /></span>添加</a></li>
        <li class="click"><span><img src="../styles/images/t02.png" /></span>修改</li>
        <li><span><img src="../styles/images/t03.png" /></span>删除</li>
        </ul>
   
    </div>
<table class="tablelist">
    <thead>

    <tr>     
        <th>用户名</th>
		<th>姓名</th>
    </tr>
    </thead>
    <tbody>
<?php
    $students = hwuser::getallstudent();
    foreach ($students as $stu){ 
      echo("<tr><td>" . $stu->username."</td><td>" . $stu->userdisplay."</td></tr>");
    } 
?>
</tbody>
</table>
    <div class="pagin">
    	<div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
        <ul class="paginList">
        <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
        <li class="paginItem"><a href="javascript:;">1</a></li>
        <li class="paginItem current"><a href="javascript:;">2</a></li>
        <li class="paginItem"><a href="javascript:;">3</a></li>
        <li class="paginItem"><a href="javascript:;">4</a></li>
        <li class="paginItem"><a href="javascript:;">5</a></li>
        <li class="paginItem more"><a href="javascript:;">...</a></li>
        <li class="paginItem"><a href="javascript:;">10</a></li>
        <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
