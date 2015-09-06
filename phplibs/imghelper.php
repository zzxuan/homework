<?php
require_once ('db.php');

class hwimg
{
    public $imgid;
    public $imgtype;
    public $imgparentid;
    public $imgsrc;

    public static function addimgs($imgtp, $imgprtid, $imgsrarr)
    {
        if ($imgprtid != null && $imgtp != null && null != $imgsrarr) {
            $db = new DB();
            foreach ($imgsrarr as $isrc) {
                if (!$db->insert("hw_img", array(
                    "imgtype" => $imgtp,
                    "imgparentid" => $imgprtid,
                    "imgsrc" => $isrc,
                    ))) {
                    return false;
                }
            }
            return true;
        } else {
            return null == $imgsrarr;//如果图片集合为空则不需要提交返回true
        }
    }

    public static function getimgs($imgtp, $imgprtid)
    {
        if ($imgtp == null || $imgprtid == null) {
            return null;
        }
        $db = new DB();
        $sql = "select * from hw_img where imgtype = " . $imgtp . " and imgparentid = " .
            $imgprtid;
        $query = $db->query($sql);

        if (null == $query)
            return null;
        $rt = array();
        while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $rt[] = $row['imgsrc'];
        }
        return $rt;
    }
}
?>