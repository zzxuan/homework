<?php

require_once('db.php');
    
    class hwuser{
        private static $tabName = 'hw_user';
        public $userid = 0;
        public $username ;
        public $userpassword ;
        public $usertype = 0;
        

        
        public static function adduser($uname,$upass,$utype){
           $db = new DB();
           $db->insert(hwuser::$tabName,array("username"=>$uname
           ,"userpassword"=>md5($upass)
           ,"usertype"=>$utype)) ;
        }
        
        public static function userlogin($uname,$upass){
            $db = new DB();
            $query = $db->query("select * from ".hwuser::$tabName." where
            username = '".$uname."' and userpassword = '".md5($upass)."' limit 1");
            if(null == $query)
                return null;
            while($row = mysql_fetch_array($query,MYSQL_ASSOC)) {
                $info = new  hwuser();
                $info->userid = $row['userid'];
                $info->username = $row['username'];
                $info->usertype = $row['usertype'];
                return array("userid"=>$row['userid']
                           ,"username"=>$row['username']
                           ,"usertype"=>$row['usertype']
                           ,"userdisplay"=>$row['userdisplay']);
            }
            return null;
        }
        
        public static function getallteacher(){
                        $db = new DB();
            $query = $db->query("select * from ".hwuser::$tabName." where
            usertype = 1");
            if(null == $query)
                return null;
            $i = 0;
            $rt = array();
            while($row = mysql_fetch_array($query,MYSQL_ASSOC)) {
                $rt[$i] = $row;
                $i++;
            }
            return $rt;
        }
        
    }
?>