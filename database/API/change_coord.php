<?php
session_start();
if($_SESSION['user_id'] != 1){
    exit(header("Location: ../../index.php"));
}
include ('../database.php');
$x = $_POST['x'];
$y = $_POST['y'];
$id = $_POST['id'];
$select = mysql_query("SELECT * FROM `reg_users` WHERE `id` = '$id'");
if($user = mysql_fetch_array($select)){
    $user_name = $user['user_name'];
    $form_user = "user_$user_name";
    mysql_query("UPDATE `$form_user` SET `health` = '$x', `health_max` = '$y' WHERE `$form_user`.`cell_id` = 1001");
    echo "Teleported";
}else{
    echo "No id";
}
echo "<br><a href='../API/api.php'>back</a>";
?>