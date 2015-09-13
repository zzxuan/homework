<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/userhelper.php");
require_once ("../phplibs/hmworkhelper.php");
require_once ("../phplibs/hmworksubhelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新的作业</title>
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
        <th>作业名称</th>
        <th>所在班级</th>
		<th>学生</th>
        <th>完成时间</th>
        <th>查看</th>
        <th>批改</th>
    </tr>
    </thead>
    <tbody>
<?php
$user = getloginuser();
if ($user->usertype == USERTEACHER) { //如果是老师
    $hnewsubs = hmworksub::getstudentsubnew($user->userid);

    if ($hnewsubs != null) {

        foreach ($hnewsubs as $hsub) {
            echo "<tr>
            <td>" . $hsub->hmworktitle . "</td>
            <td>" . $hsub->hwclassname. "</td>
            <td>" . $hsub->studentname . "</td>
            <td width=\"180\">" . $hsub->createtime . "</td>
            <td width=\"70\"><a href=\"../commonviews/showhmwork.php?id=".$hsub->hmworkid."\" class=\"tablelink\">作业内容</a></td>      
            <td width=\"70\"><a href=\"../commonviews/ShowhmworkResault.php?hmid=".$hsub->hmworkid."&uid=".$hsub->studentid."\" class=\"tablelink\">查看批改</a></td>
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
