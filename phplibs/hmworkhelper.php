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
        if (null == $hmid||!is_numeric($hmid)) {
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
    
    //根据老师id查询作业,不包括作业内容
    public static function gethmworkbyteachernoc($teacherid)
    {
        if (null == $teacherid ||!is_numeric($teacherid)) {
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


}

?>