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
<title>历次作业</title>
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
		<th>老师</th>
        <th>学生</th>
        <th>分数</th>
        <th>提交时间</th>
        <th>查看</th>
        <th>作业结果</th>
    </tr>
    </thead>
    <tbody>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        echo "<br><font color=\"#FF0000\">参数错误</font></br>";
        exit();
    } else {
        //$hmwks = hmwork::getstudentoldhmwork($_GET['id']);
        $hmwks = hmworksub::getstudentsubs($_GET['id']);
        $user = getloginuser();
        
        $isOtherstd = false;//是否是别的学生
        if($user->usertype == USERSTUDENT){
            $isOtherstd = ($user->userid != $_GET['id']);//学生不能看别人没批改的作业
        }
        if ($hmwks != null) {

            foreach ($hmwks as $hk) {
                if((!$isOtherstd)||($isOtherstd && $hk->hmworkresstate==SUBSTATETEASETRES)){
                    echo "<tr>
                <td>" . $hk->hmworktitle . "</td>
                <td>" . $hk->hwclassname . "</td>
                <td>" . $hk->teachername . "</td>
                <td>" . $hk->studentname . "</td>
                <td>" . $hk->hmworkresscore . "</td>
                <td width=\"180\">" . $hk->createtime . "</td>
                <td width=\"50\"><a href=\"../commonviews/showhmwork.php?id=" . $hk->
                        hmworkid . "\" class=\"tablelink\">查看</a></td>      
                <td width=\"80\"><a href=\"../commonviews/ShowhmworkResault.php?hmid=" .
                        $hk->hmworkid . "&uid=" . $_GET['id'] . "\" class=\"tablelink\">完成情况</a></td>
                </tr>";
                }
            }
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
