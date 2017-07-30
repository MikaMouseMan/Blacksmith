<?php
session_start();
if($_SESSION['user_id'] != 1){
    exit(header("Location: ../index.php"));
}

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API</title>
</head>
<body>
   <br>
   <br>
   <br>
    <a href="save_global_map_to_db.php">RESAVE CURENT MAP</a> this will update main RGB map in DB from curent image. <br>
    <a href="clear_building_data.php">CLEAR ALL BUILDING DATA ON DATA BASE</a> clear all data about building in DB. <br>    
    <br>
    <br>
    <br><a href="../game/map/player_global_state.php">BACK TO GAME</a> at global map.
    <br>
    <br>
    <br><?=$msg?>
</body>
</html>