<?php

    if($_POST['login']!=""){
        $login = base64_encode($_POST['login']);
    }else{
        exit (header('Location: login.php?err=Empty login'));
    };
    
    if($_POST['password']!=""){
        $password = base64_encode($_POST['password']);
    }else {
        exit (header('Location: login.php?err=Empty password'));
    };
    
    include("../database/database.php");
    
    $answer = mysql_query("SELECT * FROM `reg_users` WHERE `login` = '$login'", $dblink);
    $selected_user = mysql_fetch_array($answer);
    
    if($selected_user['login']==$login){
        if($password==$selected_user['password']){
            session_start();
            $_SESSION['user_name'] = $selected_user['user_name'];
            header('Location: ../game/map/map_select_zone.php');
            
        }else{
            header('Location: login.php?err=Wrong password.');
        }
    }else{
        header('Location: login.php?err=Dont register yet or wrong login.');
    }
    
?>