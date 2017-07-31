<?php
$x = $_POST['construction_x'];
$y = $_POST['construction_y'];
$master_id = $_POST['construction_master_id'];
$player_id = $_POST['construction_player_id'];

if($master_id != $player_id){
    exit(header("Location: ../map/map_generator_10000.php?msg=Not you construction!"));
}

include('../../database/database.php');

$id = $x.$y;

mysql_query("DELETE FROM `data_buildings_on_map` WHERE `data_buildings_on_map`.`id` LIKE '$id'");

header("Location: ../map/map_generator_10000.php?msg=Destroyed");
?>