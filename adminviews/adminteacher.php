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
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<title>老师管理</title>
</head>

<body>
<p>
  <a href="adminadduser.php?t=1">添加老师</a>
</p>
<table class="bordered">
    <thead>

    <tr>     
        <th>用户名</th>
		<th>姓名</th>
    </tr>
    </thead>
<?php
    $teachers = hwuser::getallteacher();
    foreach ($teachers as $tea){ 
      echo("<tr><td>" . $tea->username."</td><td>" . $tea->userdisplay."</td></tr>");
    } 
?>
</table>
</body>
</html>
