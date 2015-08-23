<?php
    session_start();
    if(isset($_SESSION['userinfo'])){
        //echo "12345678";
        $user = $_SESSION['userinfo'];
        //echo "<br>".$user['userid'];
        //echo "<br>".$user['usertype'];
        //echo "<br>".$user['username'];
        if(3 == $user['usertype']){
            header('Location:./views/adminframe.html');
        }
    }
?>