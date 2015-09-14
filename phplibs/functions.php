<?php
//图片压缩并另存函数

//示例：

//if(!scal_pic('pic.jpg','new_pic.jpg')){ die('您上传的图片格式存在问题！'); //然后再删除掉图片文件。。。 }
function scal_pic($file_name,$file_new,$max_width = 650){
        //验证参数
        if(!is_string($file_name) || !is_string($file_new)){
                return false;
        }
        //获取图片信息
        $pic_scal_arr = @getimagesize($file_name);
        if(!$pic_scal_arr){
                return false;
        }
        //获取图象标识符
        $pic_creat = '';
        switch($pic_scal_arr['mime']){
                case 'image/jpeg':
                        $pic_creat = @imagecreatefromjpeg($file_name);
                        break;
                case 'image/gif':
                        $pic_creat = @imagecreatefromgif($file_name);
                        break;
                case 'image/png':
                        $pic_creat = @imagecreatefrompng($file_name);
                        break;
                case 'image/wbmp':
                        $pic_creat = @imagecreatefromwbmp($file_name);
                        break;
                default:
                        return false;
                        break;
        }
        if(!$pic_creat){
                return false;
        }
        //判断/计算压缩大小
        //$max_width = 111;//最大宽度,象素，高度不限制
        //$min_width = 15;
        //$min_heigth = 20;
        //if($pic_scal_arr[0]<$min_width || $pic_scal_arr[1]<$min_heigth){
        //        return false;
        //}
        $re_scal = 0;
        if($pic_scal_arr[0]>$max_width){
                $re_scal = ($max_width / $pic_scal_arr[0]);
        }
        else{
            copy($file_name,$file_new);
            return true;
        }
        $re_width = round($pic_scal_arr[0] * $re_scal);
        $re_height = round($pic_scal_arr[1] * $re_scal);
        //创建空图象
        $new_pic = @imagecreatetruecolor($re_width,$re_height);
        if(!$new_pic){
                return false;
        }
        //复制图象
        if(!@imagecopyresampled($new_pic,$pic_creat,0,0,0,0,$re_width,$re_height,$pic_scal_arr[0],$pic_scal_arr[1])){
                return false;
        }
        //输出文件
        $out_file = '';
        switch($pic_scal_arr['mime']){
                case 'image/jpeg':
                        $out_file = @imagejpeg($new_pic,$file_new);
                        break;
                case 'image/jpg':
                        $out_file = @imagejpeg($new_pic,$file_new);
                        break;
                case 'image/gif':
                        $out_file = @imagegif($new_pic,$file_new);
                        break;
                case 'image/bmp':
                        $out_file = @imagebmp($new_pic,$file_new);
                        break;
                default:
                        return false;
                        break;
        }
        if($out_file){
                return true;
        }else{
                return false;
        }
}



?>