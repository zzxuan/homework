<?php
session_start();
require_once ("../common.php");
checklogin();
require_once ("../phplibs/userhelper.php");
require_once ("../phplibs/hmworkhelper.php");
require_once ("../phplibs/hwclasshelper.php");

$user = getloginuser();
if ($user->usertype != USERTEACHER) {
    echo "<br><font color=\"#FF0000\">请用老师账号登录</font></br>";
    exit();
}

$hwclassarr = hwclass::gethwclassbyteacherid($user->userid);
if (null == $hwclassarr) {
    echo "<br><font color=\"#FF0000\">该老师没有代课,请先分配班级</font></br>";
    exit();
}
//$_SESSION['classarr'] = $hwclassarr;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ('' == $_POST['hmworktitle'] || '' == $_POST['hmworkhwclass'] || '' == $_POST['hmworkrequire'] ||
        '' == $_POST['hwclasscontent']) {
        echo "<br><font color=\"#FF0000\">请检查输入内容</font></br>";
    } else {
        $clssid = 0;
        foreach ($hwclassarr as $cls) {
            if($cls->hwclassname == $_POST['hmworkhwclass']){
                $clssid = $cls->hwclassid;
            }
        }
        if($clssid == 0){
            echo "<br><font color=\"#FF0000\">您选的班级不存在</font></br>";
        }else{
            if(hmwork::addhmwork($_POST['hmworktitle'],$_POST['hmworkrequire'],
            $_POST['hwclasscontent'],$clssid,$user->userid)){
                echo "<br><font color=\"#FF0000\">布置作业成功</font></br>";
            }else{
                echo "<br><font color=\"#FF0000\">布置作业失败</font></br>";
            }
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>布置作业</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<link href="../styles/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../styles/js/jquery.js"></script>
<script type="text/javascript" src="../styles/js/select-ui.min.js"></script>
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

<script type="text/javascript" charset="utf-8" src="../styles/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../styles/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="../styles/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript">
 var ue = UE.getEditor('editor',{
            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
            //toolbars:[['FullScreen', 'Undo', 'Redo','Bold','test', 'simpleupload']],
            //focus时自动清空初始化时的内容
            //autoClearinitialContent:true,
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //默认的编辑区域高度
            initialFrameHeight:300,
            //更多其他参数，请参考ueditor.config.js中的配置项
            //serverUrl: '/server/ueditor/controller.php'
        });
</script> 

</head>

<body>
<div class="mainframeinfo">
    <div class="formbody">
        <div class="formtitle"><span>布置作业</span></div>
        <form id="form1" name="form1" method="post" action="">
            <ul class="forminfo">
              <li><label>名称<b>*</b></label>
                <input type="text" name="hmworktitle" class="dfinput"/>
                <i>标题不能超过30个字符</i>
               </li>
               <li><label>班级<b>*</b></label>  
                    <div class="vocation">
                    <select class="select1" name="hmworkhwclass">
                    <?php
foreach ($hwclassarr as $cls) {
    echo "<option>" . $cls->hwclassname . "</option>";
}
?>
                    </select>
                    </div>
                    
               </li>
               <li>
                  <label>作业要求<b>*</b></label>	
                  <textarea name="hmworkrequire" cols="60" rows="5" class="textinputmin"></textarea>
               </li>
                <li>
                  <label>作业内容<b>*</b></label>
                  <div style="padding:8px 8px 8px 85px;">	
                    <textarea name="hwclasscontent" id="editor" cols="60" rows="5"></textarea>
                  </div>
                </li>
                <li><label>&nbsp;</label>
                 <input type="submit" name="Submit" value="提交" class="btn"/>
                 </li>
              </ul>
        </form>
    </div>
</div>
</body>
</html>
