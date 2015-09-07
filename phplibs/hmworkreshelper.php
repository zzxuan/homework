<?php
require_once ('db.php');
require_once ('userhelper.php');
require_once ('hwconstant.php');

//老师批改作业
class hmworkres
{
    public $hmworkresid;
    public $hmworkresscore;
    public $hmworkresdesc;
    public $hmworkrescontent;
    public $createtime;
    public $teacherid;
    public $hmworksubid;

    function setvalues($row)
    {
        if (null == $row)
            return;
        if (isset($row['hmworkresid']))
            $this->hmworkresid = $row['hmworkresid'];
        if (isset($row['hmworkresscore']))
            $this->hmworkresscore = $row['hmworkresscore'];
        if (isset($row['hmworkresdesc']))
            $this->hmworkresdesc = $row['hmworkresdesc'];
        if (isset($row['hmworkrescontent']))
            $this->hmworkrescontent = $row['hmworkrescontent'];
        if (isset($row['createtime']))
            $this->createtime = $row['createtime'];
        if (isset($row['teacherid']))
            $this->teacherid = $row['teacherid'];
        if (isset($row['hmworksubid']))
            $this->hmworksubid = $row['hmworksubid'];
    }

    public static function gethresbysubid($hsubid)
    {
        if (null == $hsubid || !is_numeric($hsubid)) {
            return null;
        }
        $sql = "select * from hw_hmworkres where hmworksubid = " . $hsubid;
        $db = new DB();
        $query = $db->query($sql);

        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hmworkres();
            $info->setvalues($row);
            return $info;
        }
        return null;
    }
    


}


?>