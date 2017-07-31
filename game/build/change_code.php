<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}

include ('../../../database/database.php');

$door_id = $_POST['door_id'];
$old_pass = $_POST['old_password'];
$new_pass = $_POST['new_password'];

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `id` = '$door_id'");
$door = mysql_fetch_array($select);

if($door['color'] == $old_pass){
    mysql_query("UPDATE `data_buildings_on_map` SET `color` = '$new_pass' WHERE `data_buildings_on_map`.`id` = '$door_id'");
    exit(header("Location: ../map_generator_10000.php?msg=New password set"));
}else{
    $_SESSION['busy_time'] += 3;
    exit(header("Location: ../map_generator_10000.php?msg=Wrong password"));
}

?>