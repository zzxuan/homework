<?php

require_once ('db.php');

class hwuser
{
    private static $tabName = 'hw_user';
    public $userid = 0;
    public $username;
    public $userpassword;
    public $userdisplay;
    public $usertype = 0;


    public static function adduser($uname, $upass, $disname, $utype, &$output)
    {
        if (null == $uname || null == $upass || null == $utype || null == $disname) {
            $output = "您输入的格式不对！";
            return false;
        }

        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            username = '" . $uname . "' limit 1");

        if (null != $query && mysql_num_rows($query) > 0) {
            $output = "用户名已存在！";
            return false;
        }

        $db->insert(hwuser::$tabName, array(
            "username" => $uname,
            "userpassword" => md5($upass),
            "usertype" => $utype,
            "userdisplay" => $disname));
        return true;
    }

    public static function userlogin($uname, $upass)
    {
        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            username = '" . mysql_real_escape_string($uname) . "' and userpassword = '" . md5($upass) .
            "' limit 1");
        if (null == $query)
            return null;
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            //return $info;
            return array(
                "userid" => $row['userid'],
                "username" => $row['username'],
                "usertype" => $row['usertype'],
                "userpassword" => $row['userpassword'],
                "userdisplay" => $row['userdisplay']);
        }
        return null;
    }

    public static function getallteacher()
    {
        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            usertype = 1");
        if (null == $query)
            return null;
        $i = 0;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            $rt[$i] = $info;
            //echo("<br>" . $info->username." --- " . $info->userdisplay."</br>");
            $i++;
        }
        return $rt;
    }

    public static function getallstudent()
    {
        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            usertype = 2");
        if (null == $query)
            return null;
        $i = 0;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            $rt[$i] = $info;
            $i++;
        }
        return $rt;
    }

    public static function getalladmin()
    {
        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            usertype = 3");
        if (null == $query)
            return null;
        $i = 0;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            $rt[$i] = $info;
            $i++;
        }
        return $rt;
    }

    function setvalues($row)
    {
        if(null == $row)
            return;
        if (isset($row['userid']))
            $this->userid = $row['userid'];
        if (isset($row['username']))
            $this->username = $row['username'];
        if (isset($row['userpassword']))
            $this->userpassword = $row['userpassword'];
        if (isset($row['userdisplay']))
            $this->userdisplay = $row['userdisplay'];
        if (isset($row['usertype']))
            $this->usertype = $row['usertype'];
    }
    
    public static function getuserbyname($username){
        $db = new DB();
        $query = $db->query("select * from " . hwuser::$tabName . " where
            username = '".$username."'");
        if (null == $query)
            return null;

        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $info = new hwuser();
            $info->setvalues($row);
            return $info;
        }
        return null;
    }

    
}
?>