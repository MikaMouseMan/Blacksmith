<?php
session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}

include('../../database/database.php');
$user_name = $_SESSION['user_name'];
$answer = mysql_query("SELECT * FROM `reg_users` WHERE `user_name` = '$user_name'");
$selected_user = mysql_fetch_array($answer);

$form_user = "user_$user_name";
$answer = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1000'");
$health = mysql_fetch_array($answer);


if($health['health']<$health['health_max']){
    
    
    $time_now = time();
    $curent_time = $health['item_count'];
    
    if(($time_now-$curent_time)>300){
        $temp_health = $health['health'];
        $temp_max_health = $health['health_max']+($health['item_coef']*100);
        while(($time_now-$curent_time)>300){

            $curent_time += 300;
            $temp_health += $temp_max_health/25;

        }
    
        mysql_query("UPDATE `$form_user` SET `health` = '$temp_health', `item_count` = '$time_now' WHERE `$form_user`.`cell_id` = '1000'");
    }
    
}

if($health['health']>=$health['health_max']){
    $curent_time = time();
    $max = $health['health_max'];
    mysql_query("UPDATE `$form_user` SET `health` = '$max', `item_count` = '$curent_time' WHERE `$form_user`.`cell_id` = '1000'");
}

$answer = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1000'");
$health = mysql_fetch_array($answer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
   <a href="../exit.php">EXIT</a>
   <br><a href="../home/blacksmith_home.php">Back</a>
    <br>Player: <?=$selected_user['user_name']?>
    <br>Health: <?=$health['health']."/".$health['health_max']?>
    <br>
    <?
        if($health['health']<$health['health_max']){
            echo "Time left to regen:".(300-(time() - $curent_time))." sec";
        }
    ?>
</body>
</html>