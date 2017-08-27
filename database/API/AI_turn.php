<?php
include ('../database.php');

$curent_time = time();

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `name` like 'environment'");
while($choise = mysql_fetch_array($select)){
    if()
}

?>