<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
include("../../database/database.php");

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

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$global_x' AND `y` = '$global_y'");
$plase_coord = mysql_fetch_array($select);
if(!$plase_coord){
    $new_id = $global_x.$global_y;
    $new_name = $_POST['name'];
    $master_id = $_SESSION['user_id'];
    $color = "";
    
    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
    exit(header('Location: ../map/map_generator_10000.php?msg='.$new_name.' buided'));
}else{
    exit(header('Location: build_menu.php?msg=alredy busy'));
}
?>