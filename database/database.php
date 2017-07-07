<?php
    $dbservername = "localhost";
    $dbusername = "c968524y_main";
    $dbpassword = "42681397";
    $dblink = mysql_connect($dbservername, $dbusername, $dbpassword);
    if(!$dblink){
        die("Connection error");
    }else{
        $dbselected = mysql_select_db($dbusername,$dblink);
        if(!$dbselected){
            die("Connection to database error");
        }
    }
?>