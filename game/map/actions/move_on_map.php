<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}


//////////////////check busy
if(!(($_SESSION['last_action'] + $_SESSION['busy_time']) < time())){
    $left = (time() - $_SESSION['last_action'] - $_SESSION['busy_time']) * (-1);
    exit(header("Location: ../map_generator_10000.php?msg=Not ready ".$left." sec left."));
}

include ('../../../database/database.php');

$_SESSION['busy_time'] = 0;////drop busy if can

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

$direction = $_GET['direction'];

$player_x = $global_x % 1000;
$player_y = $global_y % 1000;

$player_g_x = (int)(($global_x % 1000000)/1000);
$player_g_y = (int)(($global_y % 1000000)/1000);

///////////select all construction around player to check colision
$x_min = $global_x-1;
$x_max = $global_x+1;
$y_min = $global_y-1;
$y_max = $global_y+1;

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` BETWEEN '$x_min' AND '$x_max' AND `y` BETWEEN '$y_min' AND '$y_max'");
while($point = mysql_fetch_array($select)){
    $temp_x = $point['x'] % 1000;
    $temp_y = $point['y'] % 1000;
    $construction[$temp_x][$temp_y] = $point;
}
/////////////////////

if($direction == "left"){
    $x_coef = -1;
    $y_coef = 0;
}else if($direction == "right"){
    $x_coef = 1;
    $y_coef = 0;
}else if($direction == "up"){
    $x_coef = 0;
    $y_coef = -1;
}else if($direction == "down"){
    $x_coef = 0;
    $y_coef = 1;
}

$_SESSION['busy_time'] += 3;

//////////////colision check
if(isset($construction[$player_x + $x_coef][$player_y + $y_coef])){
    if($construction[$player_x + $x_coef][$player_y + $y_coef]['name']=="wall"){
        exit(header("Location: ../map_generator_10000.php?msg=Cant go ".$direction.". Wall."));
    }else if($construction[$player_x + $x_coef][$player_y + $y_coef]['name']=="road"){
        $_SESSION['busy_time'] -= 1;
    }else if($construction[$player_x + $x_coef][$player_y + $y_coef]['name']=="door"){
        if(!isset($_GET['pass'])){ 
            $door_id = $construction[$player_x + $x_coef][$player_y + $y_coef]['id'];
            exit(header("Location: door_action.php?x_coef=".$x_coef."&y_coef=".$y_coef."&direction=".$direction));
        }else{            
            if($_GET['pass'] == "denaid"){
                $_SESSION['busy_time'] += 3;
                exit(header("Location: ../map_generator_10000.php?msg=Wrong password"));
            }
        }
    }
}
$_SESSION['last_action'] = time();



$temp_x = $global_x;
$temp_y = $global_y;

if($direction == "left"){
        
    if($player_x == 0){
        
        if($player_g_x == 0){
            ////if player on global edge left side
            $temp_x = $global_x+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['x'] = $temp_x;
            exit(header("Location: ../player_global_state.php"));
            
        }
        
        ////if player on midle edge left side
        $temp_x = $global_x+99-1000;
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['x'] = $temp_x;
        exit(header("Location: ../map_generator_100.php"));
        
    }
        
}else if($direction == "right"){
        
    if($player_x == 99){
        if($player_g_x == 99){
            $temp_x = $global_x-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['x'] = $temp_x;
            exit(header("Location: ../player_global_state.php"));
        }
        $temp_x = $global_x-99+1000;
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_x' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['x'] = $temp_x;
        exit(header("Location: ../map_generator_100.php"));
    }
        
}else if($direction == "up"){
        
    if($player_y == 0){
        if($player_g_y == 0){
            $temp_y = $global_y+99+99000-1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['y'] = $temp_y;
            exit(header("Location: ../player_global_state.php"));
        }
        $temp_y = $global_y+99-1000;
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['y'] = $temp_y;
        exit(header("Location: ../map_generator_100.php"));
    }    
    
}else if($direction == "down"){
        
    if($player_y == 99){
        if($player_g_y == 99){
            $temp_y = $global_y-99-99000+1000000;
            mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
            $_SESSION['y'] = $temp_y;
            exit(header("Location: ../player_global_state.php"));
        }
        $temp_y = $global_y-99+1000;
        mysql_query("UPDATE `$form_user` SET `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
        $_SESSION['y'] = $temp_y;
        exit(header("Location: ../map_generator_100.php"));
    }    
}

////move on free direction
$temp_x = $global_x + $x_coef;        
$_SESSION['x'] = $temp_x;

$temp_y = $global_y + $y_coef;
$_SESSION['y'] = $temp_y;

mysql_query("UPDATE `$form_user` SET `health` = '$temp_x', `health_max` = '$temp_y' WHERE `$form_user`.`cell_id` = 1001");
exit(header("Location: ../map_generator_10000.php"));

?>