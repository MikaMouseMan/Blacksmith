<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
include("../../database/database.php");
include('../../database/functions/construct_functions.php');

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1001'");
$player_coord = mysql_fetch_array($select);

$global_x = $player_coord['health'];
$global_y = $player_coord['health_max'];

if(isset($_POST['side'])){
    
    $side = $_POST['side'];
    
    if($side == "left"){

        $global_x -= 1;  

    }else if($side == "right"){

        $global_x += 1;
        
    }else if($side == "up"){
        
        $global_y -= 1;

    }else if($side == "down"){

        $global_y += 1;

    }else if($side == "midle"){
        //all is fine
    }
}
$building = $_POST['name'];
$user_id = $_SESSION['user_id'];

if(is_no_constructions($global_x, $global_y)){
    
    if($building = "road"){
        
        build_road($global_x, $global_y, $user_id);
        
    }else if($building = "wall"){
        
        build_wall($global_x, $global_y, $user_id);
        
    }else if($building = "floor"){
        
        build_floor($global_x, $global_y, $user_id);
        
    }else if($building = "door"){
        
        build_door($global_x, $global_y, $user_id);
    }
    
    exit(header('Location: ../map/map_generator_10000.php?msg='.$new_name.' buided'));
}else{
    exit(header('Location: build_menu.php?msg=alredy busy'));
}
?>