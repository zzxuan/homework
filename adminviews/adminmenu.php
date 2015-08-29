<?php
    session_start();
    require_once("../common.php");
    checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CAREPLUS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../styles/js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>

</head>
<body style="background:url(../styles/images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="main.html" target="_parent"><img src="../styles/images/logo.png" title="系统首页" /></a>
    </div>
        
    <ul class="nav">
    <li><a href="adminteacher.php" target="rightFrame" class="selected"><img src="../styles/images/icon01.png" title="老师管理" /><h2>老师管理</h2></a></li>
    <li><a href="adminstudent.php" target="rightFrame"><img src="../styles/images/icon02.png" title="学生管理" /><h2>学生管理</h2></a></li>
    <li><a href="adminhwclass.php"  target="rightFrame"><img src="../styles/images/icon03.png" title="分班管理" /><h2>分班管理</h2></a></li>
    </ul>
            
    <div class="topright">    
    <ul>
    <li><span><img src="../styles/images/help.png" title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    <li><a href="../login.php" target="_parent">退出</a></li>
    </ul>
     
    <div class="user">
    <span>admin</span>
    <i>消息</i>
    <b>5</b>
    </div>    
    
    </div>
</body>
</html>
