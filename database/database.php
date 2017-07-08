<?php
    $dbservername = "localhost";
<<<<<<< HEAD
<<<<<<< HEAD
    $dbusername = "c968524y_main";
    $dbpassword = "42681397";
=======
    $dbusername = "root";
    $dbpassword = "";
>>>>>>> refs/remotes/origin/master
=======

    $dbusername = "root";
    $dbpassword = "";

>>>>>>> origin/Blacksmith_Lucas
    $dblink = mysql_connect($dbservername, $dbusername, $dbpassword);
    if(!$dblink){
        die("Connection error");
    }else{
<<<<<<< HEAD
<<<<<<< HEAD
        $dbselected = mysql_select_db($dbusername,$dblink);
=======
        $dbselected = mysql_select_db('c968524y_main',$dblink);
>>>>>>> refs/remotes/origin/master
=======

        $dbselected = mysql_select_db('c968524y_main',$dblink);
>>>>>>> origin/Blacksmith_Lucas
        if(!$dbselected){
            die("Connection to database error");
        }
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> refs/remotes/origin/master
=======
>>>>>>> origin/Blacksmith_Lucas
?>