<?php
    session_start();
    require_once("../common.php");
    checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
</head>

<frameset rows="88,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="adminmenu.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="*" frameborder="no" border="0" framespacing="0">
    <!--<frame name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />-->
    <frame name="rightFrame" id="rightFrame" title="rightFrame" />
  </frameset>
</frameset>
<noframes><body>
</body></noframes>
</html>
