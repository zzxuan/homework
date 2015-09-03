
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
    $("#fileupload").change(function(){ //选择文件 
        $("#myupload").ajaxSubmit({ 
            dataType:  'json', //数据格式为json 
            beforeSend: function() { //开始上传 
                
            }, 
            uploadProgress: function(event, position, total, percentComplete) { 
                var percentVal = percentComplete + '%'; //获得进度 
            }, 
            success: function(data) { //成功 
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮 
                //alert(data.name);
                //alert(data.picsrc + ',size = '+data.size);
                addElementLi(data.picsrc);
            }, 
            error:function(xhr){ //上传失败 
                alert(xhr.responseText); //返回失败信息 
            } 
        }); 
    });
});
function uploadfile()
{ 
    $("#fileupload").click(); 
} 


function addElementLi(imgpath) 
{
　　　　var ul = document.getElementById('imglistview');

　　　　//添加 li
　　　　var li = document.createElement("li");

　　　　//设置 li 属性，如 id
　　　　li.setAttribute("id", "newli");

　　　　li.innerHTML = 
        "<span><a onclick=\"imageShow('"+imgpath+"')\" target=_blank><img width = '170' height = '125' src=\""+imgpath+"\" /></a></span>\
    <p><a onclick=\"imageShow('"+imgpath+"')\">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\">删除</a></p>";
　　　　ul.appendChild(li);
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
            <textarea name="hwclassdesc" cols="60" rows="20" class="textinput"></textarea>
        </li>
    </ul>
    <div style="padding:8px 8px 8px 95px;">	

    <div class="tools"  style="padding:8px 8px 8px 15px;">
    <form id='myupload' action='../phplibs/studentsubimg.php' method='post' enctype='multipart/form-data'>
    <input type="file" style="display: none" id="fileupload" name="mypic"/></form>
    	<ul class="toolbar">
        <li class="click" onclick="uploadfile()"><span><img src="../styles/images/t01.png" /></span>上传图片</li>
        <li class="click"><span><img src="../styles/images/t02.png" /></span>提交作业</li>
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
