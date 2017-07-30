<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}

include ('../../../database/database.php');

$direction = $_POST['direction'];
$door_id = $_POST['door_id'];
$pass_to_check = $_POST['password'];

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `id` = '$door_id'");
$door = mysql_fetch_array($select);

if($door['color'] == $pass_to_check){
    exit(header("Location: move_on_map.php?pass=granted&direction=".$direction));
}else{
    exit(header("Location: move_on_map.php?pass=denaid"));
}

?>