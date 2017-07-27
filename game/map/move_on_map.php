<?php
session_start();
include ('../../database/database.php');

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

$direction = $_GET['direction'];

$player_x = $player_coord['health']%1000;
$player_y = $player_coord['health_max']%1000;
$player_g_x = (int)(($player_coord['health']%1000000)/1000);
$player_g_y = (int)(($player_coord['health_max']%1000000)/1000);

if($direction == "left"){
    
    if($player_x == 0){
        if($player_g_x == 0){
            $temp_x = $player_coord['health']+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_x = $player_coord['health']+99-1000;
        $x = (int)(($temp_x)/1000000);
        $y = (int)(($player_coord['health_max'])/1000000);
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
        exit(header("Location: map_generator_100.php?x=$x&y=$y"));
    }else{
        $temp_x = $player_coord['health']-1;
    }
    
    mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
    
}else if($direction == "right"){
    
    if($player_x == 99){
        if($player_g_x == 99){
            $temp_x = $player_coord['health']-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_x = $player_coord['health']-99+1000;
        $x = (int)(($temp_x)/1000000);
        $y = (int)(($player_coord['health_max'])/1000000);
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
        exit(header("Location: map_generator_100.php?x=$x&y=$y"));
    }else{
        $temp_x = $player_coord['health']+1;
    }
    
    mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001;");
    
}else if($direction == "up"){
    
    if($player_y == 0){
        if($player_g_y == 0){
            $temp_y = $player_coord['health_max']+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_y = $player_coord['health_max']+99-1000;
        $x = (int)(($player_coord['health'])/1000000);
        $y = (int)(($temp_y)/1000000);
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
        exit(header("Location: map_generator_100.php?x=$x&y=$y"));
    }else{
        $temp_y = $player_coord['health_max']-1;
    }
    
    mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
    
}else if($direction == "down"){
    
    if($player_y == 99){
        if($player_g_y == 99){
            $temp_y = $player_coord['health_max']-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_y = $player_coord['health_max']-99+1000;
        $x = (int)(($player_coord['health'])/1000000);
        $y = (int)(($temp_y)/1000000);
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
        exit(header("Location: map_generator_100.php?x=$x&y=$y"));
    }else{
        $temp_y = $player_coord['health_max']+1;
    }
    
    mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001;");
    
}

exit(header("Location: map_generator_10000.php?move=$temp_x"));

?>