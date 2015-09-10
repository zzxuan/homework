<?php

require_once ('db.php');
require_once ('userhelper.php');
require_once ('hwconstant.php');

class hwclass
{
    public $hwclassid;
    public $hwclassname;
    public $hwclassdesc;

    public $userdisplay;
    public $userid;

    function setvalues($row)
    {
        if (null == $row)
            return;
        if (isset($row['hwclassid']))
            $this->hwclassid = $row['hwclassid'];
        if (isset($row['hwclassname']))
            $this->hwclassname = $row['hwclassname'];
        if (isset($row['hwclassdesc']))
            $this->hwclassdesc = $row['hwclassdesc'];
        if (isset($row['userdisplay']))
            $this->userdisplay = $row['userdisplay'];
        if (isset($row['userid']))
            $this->userid = $row['userid'];
    }

    public static function addhwclass($name, $desc)
    {
        if (null == $name || null == $desc) {
            return false;
        }
        $db = new DB();
        return $db->insert("hw_class", array(
            "hwclassname" => $name,
            "hwclassdesc" => $desc,
            ));
    }

    public static function getallhwclassnodesc()
    {
        $db = new DB();
        $sql = "select hwclassid,hwclassname from hw_class";
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwclass();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }

    public static function gethwclassbyid($classid)
    {
        $db = new DB();
        $sql = "select * from hw_class where hwclassid = " . $classid;
        $query = $db->query($sql);

        if (null == $query)
            return 0;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwclass();
            $info->setvalues($row);
            return $info;
        }
        return 0;
    }

    public static function gethwclassbyteacherid($teacherid)
    {
        $db = new DB();
        $sql = "SELECT a.* FROM hw_class a,hw_classteacher b
                WHERE a.hwclassid = b.hwclassid AND b.teacherid = " . $teacherid;
        $query = $db->query($sql);

        if (null == $query)
            return 0;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwclass();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }

    public static function updateteacher($classid, $username)
    {
        $user = hwuser::getuserbyname($username);
        if ($user == null) {
            return false;
        }

        if ($user->usertype != USERTEACHER) {
            return false;
        }

        $db = new DB();
        $db->query("delete from hw_classteacher where hwclassid = " . $classid);
        return $db->insert("hw_classteacher", array(
            "teacherid" => $user->userid,
            "hwclassid" => $classid,
            ));
    }

    public static function insertstudent($classid, $username)
    {
        $user = hwuser::getuserbyname($username);
        if ($user == null) {
            return false;
        }

        if ($user->usertype != USERSTUDENT) {
            return false;
        }

        $db = new DB();
        return $db->insert("hw_classstudent", array("studentid" => $user->userid,
                "hwclassid" => $classid));
    }

    public static function getclassstudent($classid)
    {
        $sql = "SELECT a.*,b.* from hw_user a ,hw_classstudent b 
        WHERE a.userid = b.studentid AND b.hwclassid = " . $classid;
        $db = new DB();
        $query = $db->query($sql);
        if (null == $query) {
            return null;
        }

        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }

    public static function getclassteacher($classid)
    {
        $sql = "SELECT a.*,b.* from hw_user a ,hw_classteacher b 
        WHERE a.userid = b.teacherid AND b.hwclassid = " . $classid;
        $db = new DB();
        $query = $db->query($sql);
        if (null == $query) {
            return null;
        }

        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            return $info;
        }
        return null;
    }

    public static function getsameClassStduents($studentid)
    {
        $sql = "SELECT hu.userid,hu.userdisplay,hc.hwclassname 
        FROM hw_classstudent hst,hw_class hc,hw_user hu,
        (SELECT hcs.hwclassid FROM hw_classstudent hcs WHERE hcs.studentid = $studentid) a
        WHERE hst.hwclassid = a.hwclassid AND hc.hwclassid = hst.hwclassid 
        AND hu.userid = hst.studentid";
        $db = new DB();
        $query = $db->query($sql);
        if (null == $query) {
            return null;
        }
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwclass();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }

    public static function getTeacherClassStduents($teacherid)
    {
        $sql = "SELECT hu.userid,hu.userdisplay,hc.hwclassname FROM hw_classstudent hst,hw_class hc,hw_user hu,
(SELECT hcs.hwclassid FROM hw_classteacher hcs WHERE hcs.teacherid = $teacherid) a
WHERE hst.hwclassid = a.hwclassid AND hc.hwclassid = hst.hwclassid 
AND hu.userid = hst.studentid";
        $db = new DB();
        $query = $db->query($sql);
        if (null == $query) {
            return null;
        }

        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwclass();
            $info->setvalues($row);
            $rt[] = $info;
        }
        return $rt;
    }
}

?>