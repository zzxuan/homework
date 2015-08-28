<?php
    session_start();
    require_once("../common.php");
    checklogin();
    require_once("../phplibs/hwclasshelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<title>班级管理</title>
</head>

<body>
<p>
  <a href="adminaddhwclass.php">添加班级</a>
</p>
<table class="bordered">
<?php
    $hwclss = hwclass::getallhwclassnodesc();
    foreach ($hwclss as $cas){ 
        
      echo("<tr><td><a href=\"adminhwclassedit.php?t=$cas->hwclassid\">". $cas->hwclassname."</a></td></tr>");
    } 
?>
</table>
</body>
</html>