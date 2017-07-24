<?php

//constants
define ("map_drow_size", 30);//map heigt & wind draw
define ("map_x_max", 512);//pixel map lenght
define ("map_y_max", 512);//pixel map hight

session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
include("../../database/database.php");
$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1001'");
$player_coord = mysql_fetch_array($select);

if($player_coord['health'] < map_drow_size){
    $x_min = 0;
    $x_max = map_drow_size-1;
}else if($player_coord['health'] >= map_x_max-map_drow_size-1){
    $x_max = map_x_max-1;
    $x_min = $x_max-map_drow_size;
}else{
    $x_min = (int)$player_coord['health']-map_drow_size/2;
    $x_max = (int)$player_coord['health']+map_drow_size/2;
}

if($player_coord['health_max'] < map_drow_size){    
    $y_min = 0;
    $y_max = map_drow_size-1;
}else if($player_coord['health_max'] >= map_y_max-map_drow_size-1){
    $y_max = map_y_max-1;
    $y_min = $y_max-map_drow_size;
}else{
    $y_min = (int)$player_coord['health_max']-map_drow_size/2;
    $y_max = (int)$player_coord['health_max']+map_drow_size/2;
}

$select = mysql_query("SELECT * FROM `data_temp_map` WHERE `x` BETWEEN '$x_min' AND '$x_max' AND `y` BETWEEN '$y_min' AND '$y_max'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
    
</head>

<style>
    @keyframes state_1{
      from { background-color: RGB(0,0,0);}
      to  {background-color: RGB(255,255,255);}
    }
</style>

<body>
    <a href="../exit.php">EXIT</a>
    <br><a href="map_select_zone.php">Back</a><br>
    <?
    while($point = mysql_fetch_array($select)){

        $r = $point['r'];
        $g = $point['g'];
        $b = $point['b'];

        if($point['x']==$player_coord['health']&&$point['y']==$player_coord['health_max']){
            echo "<a href = '' style='animation: state_1 2s infinite'>&#8195</a>";
        }else{
            echo "<a href = 'map_generator_100.php?x=".$point['x']."&y=".$point['y']."' style='background-color: RGB(".$r.",".$g.",".$b.")'>&#8195</a>";
        }
        if($point['x']>$x_max-1){
            echo "<br>";
        }

    }
    
    echo $x_max;
    ?>
</body>
</html>