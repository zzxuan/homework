<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/hmworkhelper.php");
require_once ("../phplibs/hmworksubhelper.php");

$hmwksub = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['hmid']) && isset($_GET['uid'])) {
        $hmwksub = hmworksub::gethmksubbyhmandstu($_GET['hmid'], $_GET['uid']);
    } else {
        echo "<br><font color=\"#FF0000\">参数错误</font></br>";
        exit();
    }

}

if ($hmwksub == null) {
    echo "<br><font color=\"#FF0000\">该作业还未交</font></br>";
    exit();
}

function addimg($imgpath)
{
    return "<li><span><a onclick=\"imageShow('" . $imgpath . "')\" target=_blank><img width = '170' height = '125' src=\"" .
        $imgpath . "\" /></a></span>
    <p><a onclick=\"imageShow('" . $imgpath . "')\">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;</p></li>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<link href="../styles/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../styles/js/jquery.js"></script>
<script type="text/javascript" src="../styles/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="../styles/js/select-ui.min.js"></script>
<script type="text/javascript" src="../styles/js/imgshow.js"></script>
  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});

</script>
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
    <li><a href="#">首页</a></li>
    <li><a href="#" target="_blank">系统设置</a></li>
    </ul>
    </div>
    <div class="mainframeinfo">
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1" class="selected">学生作业</a></li> 
    <li><a href="#tab2"  <?php if (SUBSTATENONE == $hmwksub->hmworkresstate){echo "style=\"display: none\"";} ?>>老师批改</a></li> 
  	</ul>
    </div> 
    
  	<div id="tab1" class="tabson">
            
    <ul class="forminfo">
    <?php
if (SUBSTATENONE == $hmwksub->hmworkresstate) {
    $hmk = hmwork::gethmworkbyidnoc($hmwksub->hmworkid);
    if ($hmk->teacherid == getloginuser()->userid) {
        echo "<li><label>&nbsp;</label><a href=\"../teacherviews/teachercrthmk.php?id=".$hmwksub->hmworksubid."\"  target=\"_blank\"><input type='button' value=\"批改作业\" class=\"btn\"/></a></li>";
        //</a>
    } else {
        echo "老师正在努力批改中...";
    }
} else {

}
?>
        <li><label>作业名</label>
            <input type="text" name="hwclassname" class="dfinput" value="<?php echo
$hmwksub->hmworktitle; ?>" readonly="true"/><i>交作业时间 <?php echo $hmwksub->
createtime; ?></i>
          </li>
          <li><label>留言</label>
            <textarea name="hwclassdesc" cols="60" rows="20" class="textinput" readonly="true"><?php echo
$hmwksub->hmworksubdesc; ?></textarea>
          </li>
    </ul>
    <ul class="imglist" id="imglistview">
    <?php
if ($hmwksub->subimgs != null) {
    foreach ($hmwksub->subimgs as $imgpath) {
        echo addimg($imgpath);
    }
} else {
    echo "该学生只是留了个言...";
}
?>

    </ul>
    
    </div> 
    
    
  	<div id="tab2" class="tabson">
        <ul class="forminfo">
          <li><label><font color="#282DD7">作业名称</font></label>
            <label><?php
echo $hmwksub->hmworktitle;
?></label>
            </li>
                      <li><label><font color="#282DD7">得分</font></label>
            <div style="padding:8px 8px 8px 85px;border-top:1px solid #F4F4F4">
            <?php
echo $hmwksub->hmworkresscore;
?></div>
            </li>
            <li><label><font color="#282DD7">描述</font></label>
                <div style="padding:8px 8px 8px 85px;border-top:1px solid #F4F4F4">	
                    <?php
                        echo $hmwksub->hmworkresdesc;
                    ?>
                  </div>
            </li>
          <li><label><font color="#282DD7">详细内容</font></label>
                  <div style="padding:8px 8px 8px 85px;border-top:1px solid #F4F4F4">	
                    <?php
                        echo $hmwksub->hmworkrescontent;
                    ?>
                  </div>
            </li>
          </ul>
    
    
    </div>  
       
	</div> 
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    
    
    
    
    
    </div>
    </div>
</body>
</html>
