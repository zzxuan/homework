<?php
    session_start();
    
    if(!isset($_SESSION['userinfo'])){
        //echo dirname(__FILE__);
        header("Location: /homework/login.php");
        //exit();
    }
?>