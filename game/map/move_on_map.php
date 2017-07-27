<?php
session_start();
include ('../../database/database.php');

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

$direction = $_GET['direction'];

$player_x = $global_x % 1000;
$player_y = $global_y % 1000;

$player_g_x = (int)(($global_x % 1000000)/1000);
$player_g_y = (int)(($global_y % 1000000)/1000);

if($direction == "left"){
    
    if($player_x == 0){
        if($player_g_x == 0){
            $temp_x = $global_x+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['x'] = $temp_x;
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_x = $global_x+99-1000;
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['x'] = $temp_x;
        exit(header("Location: map_generator_100.php"));
    }else{
        $temp_x = $global_x-1;
        $_SESSION['x'] = $temp_x;
    }
    
    mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
    
}else if($direction == "right"){
    
    if($player_x == 99){
        if($player_g_x == 99){
            $temp_x = $global_x-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['x'] = $temp_x;
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_x = $global_x-99+1000;
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['x'] = $temp_x;
        exit(header("Location: map_generator_100.php"));
    }else{
        $temp_x = $global_x+1;        
        $_SESSION['x'] = $temp_x;
    }
    
    mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
    
}else if($direction == "up"){
    
    if($player_y == 0){
        if($player_g_y == 0){
            $temp_y = $global_y+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['y'] = $temp_y;
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_y = $global_y+99-1000;
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['y'] = $temp_y;
        exit(header("Location: map_generator_100.php"));
    }else{
        $temp_y = $global_y-1;
        $_SESSION['y'] = $temp_y;
    }
    
    mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
    
}else if($direction == "down"){
    
    if($player_y == 99){
        if($player_g_y == 99){
            $temp_y = $global_y-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['y'] = $temp_y;
            exit(header("Location: simple_player_global_state.php"));
        }
        $temp_y = $global_y-99+1000;
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['y'] = $temp_y;
        exit(header("Location: map_generator_100.php"));
    }else{
        $temp_y = $global_y+1;
        $_SESSION['y'] = $temp_y;
    }
    
    mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
    
}

exit(header("Location: map_generator_10000.php?move=$temp_x"));

?>