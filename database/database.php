<?php
    $dbservername = "localhost";
<<<<<<< HEAD
    $dbusername = "c968524y_main";
    $dbpassword = "42681397";
=======
    $dbusername = "root";
    $dbpassword = "";
>>>>>>> refs/remotes/origin/master
    $dblink = mysql_connect($dbservername, $dbusername, $dbpassword);
    if(!$dblink){
        die("Connection error");
    }else{
<<<<<<< HEAD
        $dbselected = mysql_select_db($dbusername,$dblink);
=======
        $dbselected = mysql_select_db('c968524y_main',$dblink);
>>>>>>> refs/remotes/origin/master
        if(!$dbselected){
            die("Connection to database error");
        }
    }
<<<<<<< HEAD
=======

>>>>>>> refs/remotes/origin/master
?>