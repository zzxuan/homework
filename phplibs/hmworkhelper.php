<?php
require_once ('db.php');
require_once ('userhelper.php');
require_once ('hwconstant.php');

class hmwork
{
    public $hmworkid; //作业id
    public $hmworktitle; //标题
    public $hmworkrequire; //要求
    public $hmworkcontent; //内容
    public $hwclassid; //班级id
    public $teacherid; //老师id
    public $createtime; //创建时间
    public $hmworkstate; //作业状态

    function setvalues($row)
    {
        if (null == $row)
            return;
        if (isset($row['hmworkid']))
            $this->hmworkid = $row['hmworkid'];
        if (isset($row['hmworktitle']))
            $this->hmworktitle = $row['hmworktitle'];
        if (isset($row['hmworkrequire']))
            $this->hmworkrequire = $row['hmworkrequire'];
        if (isset($row['hmworkcontent']))
            $this->hmworkcontent = $row['hmworkcontent'];
        if (isset($row['hwclassid']))
            $this->hwclassid = $row['hwclassid'];
        if (isset($row['teacherid']))
            $this->teacherid = $row['teacherid'];
        if (isset($row['createtime']))
            $this->createtime = $row['createtime'];
        if (isset($row['hmworkstate']))
            $this->hmworkstate = $row['hmworkstate'];
    }

    //添加作业
    public static function addhmwork($title, $req, $content, $hwclassid, $teacherid)
    {
        if (null == $title || null == $req || null == $content || null == $hwclassid || null ==
            $teacherid) {
            return false;
        }

        $db = new DB();
        return $db->insert('hw_hmwork', array(
            "hmworktitle" => $title,
            "hmworkrequire" => $req,
            "hmworkcontent" => $content,
            "hwclassid" => $hwclassid,
            "teacherid" => $teacherid,
            "createtime" => date("Y-m-d H:i:s"),
            "hmworkstate" => HMWORkSTATENORMAL));
    }

    

}

?>