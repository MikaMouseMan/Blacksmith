<?php

$name = base64_encode($_POST['user_name']);
$password = base64_encode($_POST['user_password']);

include("../database/database.php");


$select = mysql_query("SELECT * FROM `reg_users` WHERE `login` LIKE '$name'");
$user = mysql_fetch_array($select);

if($user){
    if($user['password'] == $password){
        $id = $user['id'];
        $user_name = $user['user_name'];
        mysql_query("DELETE FROM `reg_users` WHERE `reg_users`.`id` = '$id'");
        $form_name = "user_$user_name";
        mysql_query("DROP TABLE $form_name");
        header("Location: login.php?msg=account now deleted");
    }
}
?>