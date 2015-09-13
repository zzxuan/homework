<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/userhelper.php");
require_once ("../phplibs/hmworkhelper.php");
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
<script language="javascript">
function deletehmwork(hmkid,tdobj){
    if(!confirm("是否删除该作业,删除后将不可恢复！")){
        return;
    }
    $.ajax({
         url: "../viewcontrollors/teacherhmworksctrlor.php",  
         type: "POST",
         data:{mtype:1,id:hmkid},
         dataType: "json",
         error: function(xhr){  
             alert(xhr.responseText); //返回失败信息 
         },  
         success: function(msg){//如果调用php成功    
             var table=document.getElementById("hmktable");
             table.deleteRow(tdobj.parentNode.parentNode.rowIndex)
         }
     });
}
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

<table class="tablelist" id="hmktable">
    <thead>

    <tr>     
        <th>作业名称</th>
        <th>作业要求</th>
		<th>班级</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
<?php
$user = getloginuser();
if ($user->usertype == USERTEACHER) { //如果是老师
    $hmwks = hmwork::gethmworkbyteachernoc($user->userid);
    if ($hmwks != null) {
        foreach ($hmwks as $hk) {
            echo "<tr>
            <td>" . $hk->hmworktitle . "</td>
            <td>" . mb_substr($hk->hmworkrequire,0,25,'utf-8') . "</td>
            <td>" . $hk->hwclassname . "</td>
            <td>" . $hk->createtime . "</td>
            <td ><a href=\"../commonviews/showhmwork.php?id=".$hk->hmworkid."\" class=\"tablelink\">查看</a>
            <a href=\"#\" onclick=\"deletehmwork($hk->hmworkid,this)\" class=\"tablelink\">删除</a></td>
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
