<?php
    session_start();
    require_once("../common.php");
    checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<frameset rows="125,*" cols="*" framespacing="0" frameborder="no" border="0">
    <frame src="adminmenu.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />

    <frame src="viewadmin.php" name="contentFrame">
</frameset>
<body>
</body>
</html>
