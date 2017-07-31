<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}

if(isset($_GET['direction'])){
    $direction = $_GET['direction'];
}

include ('../../database/database.php');

$x_coef = $_GET['x_coef'];
$y_coef = $_GET['y_coef'];

$global_x = $_SESSION['x'] + $x_coef;
$global_y = $_SESSION['y'] + $y_coef;

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$global_x' AND `y` = '$global_y'");
$door = mysql_fetch_array($select);
$door_id = $door['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
   <div>
        To enter write password<br>
        <form action="check_lock_code.php" method="post">
            <input type="hidden" name = "door_id" value = "<?=$door_id?>">
            <input type="hidden" name = "direction" value = "<?=$direction?>">
            <input type="password" name = "password">
            <input type="submit" value = "Enter">
        </form>
   </div>
    
    <div>
       To change password 
        <form action="change_code.php" method="post">
        <input type="hidden" name = "door_id" value = "<?=$door_id?>">
        Write old
        <input type="password" name = "old_password"><br>
        Write new
        <input type="password" name = "new_password">
        <input type="submit" value = "Enter">
        </form>
    </div>
    
</body>
</html>