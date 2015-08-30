<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/hmworkhelper.php");

$hmwk = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        echo "<br><font color=\"#FF0000\">参数错误</font></br>";
        exit();
    } else {
        $hmid = $_GET['id'];
        $hmwk = hmwork::gethmworkbyid($hmid);
        if ($hmwk == null) {
            echo "<br><font color=\"#FF0000\">作业不存在</font></br>";
            exit();
        }
    }
}

if ($hmwk == null) {
    echo "<br><font color=\"#FF0000\">作业为空</font></br>";
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作业查看</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
</head>

<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>作业查看</li>
    <li>作业详细信息</li>
    </ul>
    </div>

<div class="mainframeinfo">
<div class="formtitle"><span>作业详细信息</span></div>
        <ul class="forminfo">
          <li><label><font color="#282DD7">作业名称</font></label>
            <label><?php
echo $hmwk->hmworktitle;
?></label>
            </li>
            <li><label><font color="#282DD7">作业要求</font></label>
                <div style="padding:8px 8px 8px 85px;border-top:1px solid #F4F4F4">	
                    <?php
                        echo $hmwk->hmworkrequire;
                    ?>
                  </div>
            </li>
          <li><label><font color="#282DD7">详细内容</font></label>
                  <div style="padding:8px 8px 8px 85px;border-top:1px solid #F4F4F4">	
                    <?php
                        echo $hmwk->hmworkcontent;
                    ?>
                  </div>
            </li>
          </ul>

</div>
</body>
</html>
