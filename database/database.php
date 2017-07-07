<?php
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dblink = mysql_connect($dbservername, $dbusername, $dbpassword);
    if(!$dblink){
        die("Connection error");
    }else{
        $dbselected = mysql_select_db('c968524y_main',$dblink);
        if(!$dbselected){
            die("Connection to database error");
        }
    }

?>