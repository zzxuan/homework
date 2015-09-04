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
    }

    public static function addhmksub($hmkid, $studid, $desc, $imgsrcarr)
    {
        $db = new DB();
        if (!$db->insert("hw_hmworksub", array(
            "hmworkid" => $hmkid,
            "studentid" => $studid,
            "hmworksubdesc" => $desc,
            "createtime"=>date("Y-m-d H:i:s")
            ))) {
            return false;
        }
        
        $id = $db->insert_id();
        return hwimg::addimgs(IMGTYPEHMKSUB,$id,$imgsrcarr);
    }


}

?>