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

    public $hwclassname;
    public $userdisplay;

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

        if (isset($row['hwclassname']))
            $this->hwclassname = $row['hwclassname'];
        if (isset($row['userdisplay']))
            $this->userdisplay = $row['userdisplay'];
    }

    //添加作业
    public static function addhmwork($title, $req, $content, $hwclassid, $teacherid)
    {
        if (null == $title || null == $req || null == $content || null == $hwclassid || null ==
            $teacherid) {
            return null;
        }

        $db = new DB();
        if ($db->insert('hw_hmwork', array(
            "hmworktitle" => $title,
            "hmworkrequire" => $req,
            "hmworkcontent" => $content,
            "hwclassid" => $hwclassid,
            "teacherid" => $teacherid,
            "createtime" => date("Y-m-d H:i:s"),
            "hmworkstate" => HMWORkSTATENORMAL))) {
            return $db->insert_id();
        }
        return null;
    }

    public static function gethmworkbyid($hmid)
    {
        if (null == $hmid || !is_numeric($hmid)) {
            return null;
        }
        $sql = "select * from hw_hmwork where hmworkid = " . $hmid;
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmwork();
            $info->setvalues($row);
            return $info;
        }
    }

    public static function gethmworkbyidnoc($hmid)
    {
        if (null == $hmid || !is_numeric($hmid)) {
            return null;
        }
        $sql = "select hmworkid,hmworktitle,hmworkstate,hwclassid,
        createtime,hmworkrequire,teacherid from hw_hmwork where hmworkid = " . $hmid;
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmwork();
            $info->setvalues($row);
            return $info;
        }
    }

    //根据老师id查询作业,不包括作业内容
    public static function gethmworkbyteachernoc($teacherid)
    {
        if (null == $teacherid || !is_numeric($teacherid)) {
            return null;
        }
        $sql = "SELECT a.hmworkid,a.hmworktitle,a.hmworkstate,a.hwclassid,
        a.createtime,a.hmworkrequire,a.teacherid,b.hwclassname 
        FROM hw_hmwork a,hw_class b 
        WHERE a.hwclassid = b.hwclassid and a.teacherid = " . $teacherid . " 
        ORDER BY a.hmworkid DESC";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rc = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmwork();
            $info->setvalues($row);
            $rc[] = $info;
        }
        return $rc;
    }

    //获得学生没做的作业
    public static function getstudentnewhmwork($studentid)
    {
        if (null == $studentid || !is_numeric($studentid)) {
            return null;
        }

        $sql = "select hk.hmworkid,hk.hmworktitle,hk.createtime,class.hwclassname ,us.userdisplay 
        from hw_hmwork hk,hw_class class,hw_classstudent cs ,hw_user us 
        where hk.hwclassid=class.hwclassid and 
        hk.hwclassid = cs.hwclassid and us.userid = hk.teacherid and 
        cs.studentid = '" . $studentid . "' and hk.hmworkid not in 
        (select hmworkid from hw_hmworksub where studentid = '" . $studentid .
            "') ORDER BY hk.hmworkid DESC";
        // ORDER BY a.hmworkid DESC";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rc = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmwork();
            $info->setvalues($row);
            $rc[] = $info;
        }
        return $rc;
    }

    //获得学生做过的作业
    public static function getstudentoldhmwork($studentid)
    {
        if (null == $studentid || !is_numeric($studentid)) {
            return null;
        }
        $sql = "select hk.hmworkid,hk.hmworktitle,hk.createtime,class.hwclassname ,us.userdisplay 
        from hw_hmwork hk,hw_class class,hw_classstudent cs ,hw_user us 
        where hk.hwclassid=class.hwclassid and 
        hk.hwclassid = cs.hwclassid and us.userid = hk.teacherid and 
        cs.studentid = '" . $studentid . "' and hk.hmworkid in 
        (select hmworkid from hw_hmworksub where studentid = '" . $studentid .
            "') ORDER BY hk.hmworkid DESC";
        // ORDER BY a.hmworkid DESC";
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rc = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmwork();
            $info->setvalues($row);
            $rc[] = $info;
        }
        return $rc;
    }

    public static function deletehmwork($hmkid)
    {
        if (null == $hmkid || !is_numeric($hmkid)) {
            return null;
        }
        $db = new DB();
        return $db->delete(hw_hmwork,"hmworkid = $hmkid");
    }

}

?>