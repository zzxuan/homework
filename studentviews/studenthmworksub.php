<?php
session_start();
require_once ("../common.php");
checklogin();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $_SESSION['studentdubhmid'] = $_GET['id'];
    }
}else{
    echo "<br><font color=\"#FF0000\">请先选择作业</font></br>";
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../styles/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../styles/js/jquery.js"></script>
<script type="text/javascript" src="../styles/js/jquery-form.js"></script>
<script type="text/javascript" src="../styles/js/imgshow.js"></script>
<script language="javascript">
$(function(){
    

});
    function filechange(){ //选择文件 
        //alert("ld change");
        var obj = document.getElementById("fileupload");
        var lab = document.getElementById("uplable");
        if(obj.value == ''){
            alert("请选择文件");
            return;
        }
        $("#myupload").ajaxSubmit({ 
            dataType:  'json', //数据格式为json 
            beforeSend: function() { //开始上传 
                
            }, 
            uploadProgress: function(event, position, total, percentComplete) { 
                var percentVal = percentComplete + '%'; //获得进度 
                lab.innerHTML = percentVal;
            }, 
            success: function(data) { //成功 
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮 
                //alert(data.name);
                //alert(data.picsrc + ',size = '+data.size);
                addElementLi(data.picsrc);
                //var obj = document.getElementById("fileupload");
                obj.outerHTML = obj.outerHTML.replace(/(value=\").+\"/i, "$1\"");
                lab.innerHTML = '';
            }, 
            error:function(xhr){ //上传失败 
                alert(xhr.responseText); //返回失败信息 
            } 
        }); 
    };
function uploadfile()
{ 
    $("#fileupload").click(); 
} 



function addElementLi(imgpath) 
{
　　　　var ul = document.getElementById('imglistview');
        var liid = "liid" + ul.getElementsByTagName("li").length; 
　　　　//添加 li
　　　　var li = document.createElement("li");
　　　　//设置 li 属性，如 id
　　　　li.setAttribute("id", liid);
　　　　li.innerHTML = 
        "<span><a onclick=\"imageShow('"+imgpath+"')\" target=_blank><img width = '170' height = '125' src=\""+imgpath+"\" /></a></span>\
    <p><a onclick=\"imageShow('"+imgpath+"')\">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;\
    <a onclick=\"deleteElemenli('"+liid+"')\">删除</a></p>";
　　　　ul.appendChild(li);
}

function deleteElemenli(liid){
    var li = document.getElementById(liid);
    li.remove();
}

function subhmwork(){
    var ulimglistview=document.getElementById("imglistview");
    var imgs=ulimglistview.getElementsByTagName("img"); 
    var imgsrcs = new Array();
    if(imgs != null){
        for(var i=0;i<imgs.length;i++){
            imgsrcs.push(imgs[i].src);
        }
    }
    //alert(imgsrcs);
    var desctext = document.getElementById("desctext");
    var descstr = desctext.value;
    if(descstr.replace(/(^s*)|(s*$)/g, "").length ==0 && imgsrcs.length <= 0){
        alert("您的留言和图片都为空,请输入..."); //返回失败信息 
        return;
    }
    
    if(!confirm("您共选择了 "+imgsrcs.length +" 张图片,确定提交")){
        return;
    }
    
    $.ajax({
         url: "../phplibs/studenthmksub.php",  
         type: "POST",
         data:{desc:descstr,imgarr:imgsrcs},
         dataType: "json",
         error: function(xhr){  
             alert(xhr.responseText); //返回失败信息 
         },  
         success: function(msg){//如果调用php成功    
             alert('提交作业完成!');
         }
     });
}

	
</script>
</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">新作业</a></li>
    <li><a href="studenthmworksub.php">交作业</a></li>
    </ul>
    </div>
    
    <div class="mainframeinfo">
    <div class="formtitle"><span>作业名称:xxxxx</span></div>
    <ul class="forminfo">
        <li>
        <label>留言</label>	
            <textarea id="desctext" name="hwclassdesc" cols="60" rows="20" class="textinput"></textarea>
        </li>
    </ul>
    <div style="padding:8px 8px 8px 95px;">	

    <div class="tools"  style="padding:8px 8px 8px 15px;">

    	<ul class="toolbar">
            <li><form id='myupload' action='../phplibs/studentsubimg.php' method='post' enctype='multipart/form-data'>
    <input type="file" id="fileupload" name="mypic"/><span><label id="uplable"></label></span></form></li>
        <li class="click" onclick="filechange()"><span><img src="../styles/images/t01.png" /></span>上传图片</li>
        <li class="click" onclick="subhmwork()"><span><img src="../styles/images/t02.png" /></span>提交作业</li>
        </ul>
    
    </div>
    <div>
    <ul class="imglist" id="imglistview">

    </ul>
    </div>
    <div class="tip">
    	<div class="tiptop"><span>提示信息</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的修改 ？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
        </div>
        
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="确定" />&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>
    
    </div>
    </div>
    </div>
</body>
</html>
