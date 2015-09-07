<?php
/**
 * 学生提交作业
 * 
 * */
require_once ('hwconstant.php');
require_once ('db.php');
require_once ('imghelper.php');
class hmworksub
{

    public $hmworksubid;
    public $hmworksubcontent; //` varchar(2048) DEFAULT NULL,
    public $hmworksubdesc; //` varchar(2048) DEFAULT NULL,
    public $createtime; //` varchar(32) DEFAULT NULL,
    public $hmworkid; //` int(11) DEFAULT NULL,
    public $studentid; //` int(11) DEFAULT NULL,

    public $hmworktitle;
    public $subimgs;

    public $hwclassname;
    public $studentname;

    function setvalues($row)
    {
        if (null == $row)
            return;
        if (isset($row['hmworksubid']))
            $this->hmworksubid = $row['hmworksubid'];
        if (isset($row['hmworksubcontent']))
            $this->hmworksubcontent = $row['hmworksubcontent'];
        if (isset($row['hmworksubdesc']))
            $this->hmworksubdesc = $row['hmworksubdesc'];
        if (isset($row['createtime']))
            $this->createtime = $row['createtime'];
        if (isset($row['hmworkid']))
            $this->hmworkid = $row['hmworkid'];
        if (isset($row['studentid']))
            $this->studentid = $row['studentid'];
        if (isset($row['hmworktitle']))
            $this->hmworktitle = $row['hmworktitle'];
        if (isset($row['hwclassname']))
            $this->hwclassname = $row['hwclassname'];
        if (isset($row['userdisplay']))
            $this->studentname = $row['userdisplay'];
    }

    public static function addhmksub($hmkid, $studid, $desc, $imgsrcarr)
    {
        if (hmworksub::gethmksubbyhmandstu($hmkid, $studid) != null) {
            //已经提交过
            return false;
        }

        $db = new DB();
        if (!$db->insert("hw_hmworksub", array(
            "hmworkid" => $hmkid,
            "studentid" => $studid,
            "hmworksubdesc" => $desc,
            "createtime" => date("Y-m-d H:i:s")))) {
            return false;
        }

        $id = $db->insert_id();
        return hwimg::addimgs(IMGTYPEHMKSUB, $id, $imgsrcarr);
    }

    public static function gethmksub($hmwsubid)
    {
        if (null == $hmwsubid || !is_numeric($hmwsubid)) {
            return null;
        }
        $sql = "select a.*,b.hmworktitle from hw_hmworksub a,hw_hmwork b 
        where a.hmworkid = b.hmworkid a.hmworksubid = " . $hmwsubid . " limit 1";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmworksub();
            $info->setvalues($row);
            $info->subimgs = hwimg::getimgs(IMGTYPEHMKSUB, $hmwsubid); //获得图片
            return $info;
        }
        return null;
    }

    public static function gethmksubbyhmandstu($hmid, $studid)
    {
        if (null == $hmid || !is_numeric($hmid) || null == $studid || !is_numeric($studid)) {
            return null;
        }
        $sql = "select a.*,b.hmworktitle from hw_hmworksub a,hw_hmwork b 
        where a.hmworkid = b.hmworkid 
        and a.hmworkid = " . $hmid . " and a.studentid = " . $studid .
            " limit 1";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmworksub();
            $info->setvalues($row);
            $info->subimgs = hwimg::getimgs(IMGTYPEHMKSUB, $info->hmworksubid); //获得图片
            return $info;
        }
        return null;
    }

    //老师需要批改的作业
    public static function getstudentsubnew($teacherid)
    {
        if (null == $teacherid || !is_numeric($teacherid)) {
            return null;
        }
        $sql = "SELECT hsub.hmworkid,hsub.hmworksubid,hsub.studentid, hmk.hmworktitle,hsub.createtime,hc.hwclassname,hu.userdisplay 
        FROM hw_hmwork hmk,hw_hmworksub hsub,hw_class hc,hw_user hu 
        WHERE hmk.hmworkid = hsub.hmworkid AND hmk.teacherid = " . $teacherid .
            " 
        AND hc.hwclassid = hmk.hwclassid AND hu.userid = hsub.studentid 
        AND hsub.hmworksubid not in 
        (SELECT hmworksubid FROM hw_hmworkres hres WHERE hres.teacherid = " . $teacherid .
            ")";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmworksub();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }


}

?>