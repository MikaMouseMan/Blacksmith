<?php
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../index.php'));
    }

    if(!isset($_GET['msg'])){
        $_GET['msg']='';
    }
    if(!isset($_GET['err'])){
            $_GET['err']='';
    }
 
    include('../database/database.php');
    $user_name=$_SESSION['user_name'];
    $answer = mysql_query("SELECT * FROM `reg_users` WHERE `user_name` = '$user_name'");
    $selected_user = mysql_fetch_array($answer);
    $d1=time()+1;
    $d2=strtotime($selected_user['date_reg']);
    $diff=$d1-$d2;
    $days = (($diff/60)/60)/24;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    Main menu
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>
    <a href="exit.php">EXIT</a>
    <div>
        <br>Player: <?=$selected_user['user_name']?>
        <br>Start playing: <?=$selected_user['date_reg']?>
        <br>You register <?=(int)$days?> days ago.
    </div>
    <div>
        <a href="inventory/inventory.php"><img src="../images/inventory.jpg"></a>
        <a href="craft/craft.php"><img src="../images/craft.jpg"></a>
        <a href="upgrade/upgrade_material.php"><img src="../images/qestion.jpg"></a>
        <br><a href="random/random_resurse.php">Random resurse</a>
        <br><a href="random/random_material.php">Random material</a>
        <br><a href="random/random_component.php">Random component</a>
    </div>
</body>
</html>