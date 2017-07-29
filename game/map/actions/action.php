<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
include ('../../../database/database.php');

$player_id = $_SESSION['user_id'];

$side = $_GET['side'];

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

if($side == "left"){
    
    $x = $global_x - 1;
    $y = $global_y;
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$x' AND `y` = '$y'");
    $point = mysql_fetch_array($select);
    
    
}else if($side == "right"){
    
    $x = $global_x + 1;
    $y = $global_y;
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$x' AND `y` = '$y'");
    $point = mysql_fetch_array($select);
    
    
}else if($side == "up"){
    
    $x = $global_x;
    $y = $global_y - 1;
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$x' AND `y` = '$y'");
    $point = mysql_fetch_array($select);
    
    
}else if($side == "down"){
    
    $x = $global_x;
    $y = $global_y + 1;
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$x' AND `y` = '$y'");
    $point = mysql_fetch_array($select);
    
    
}else if($side == "midle"){
    
    $x = $global_x;
    $y = $global_y;
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$x' AND `y` = '$y'");
    $point = mysql_fetch_array($select);
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href="../map_generator_10000.php">BACK</a>
    <br><br>
    <div>        
        <a href="../../build/build_menu.php">BUILD</a>
    </div>
    <div>
       <form action="destroy_construction.php" method = "post">
          <input type="hidden" name = "construction_x" value="<?=$point['x']?>" >
          <input type="hidden" name = "construction_y" value="<?=$point['y']?>" >
          <input type="hidden" name = "construction_master_id" value="<?=$point['master_id']?>" >
          <input type="hidden" name = "construction_player_id" value="<?=$player_id?>" >
           <button>DESTROY</button>  
       </form>        
    </div>
</body>
</html>