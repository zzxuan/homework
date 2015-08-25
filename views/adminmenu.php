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
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
   <!--start container-->
    <div id="container">
    <!--start header-->
    <header>
    <!--start logo-->
    <div id="logo">
    <img src="images/logo.png" alt="" />
    </div>
	<!--end logo-->
   <!--start menu-->
	<nav>
    <ul>

		  <li class="current"><a href="adminteacher.php" target="contentFrame">老师管理</a></li>
		 <li><a href="adminstudent.php" target="contentFrame">学生管理</a></li>
		 <li><a href="adminteacher.php" target="contentFrame">分班管理</a></li>
    </ul>
    </nav>
	<!--end menu-->

</header>
</div>
</html>
