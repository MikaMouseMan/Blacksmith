<?php
    
    $cell = $_GET['id'];
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    include ("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    mysql_query("UPDATE `$form_user` SET `item_name` = '', `item_count` = '0', `item_coef` = '0', `item_type` = '', `item_structure` = '', `health` = '0', `health_max` = '0' WHERE `$form_user`.`cell_id` = '$cell'");
    
    header('Location: inventory.php?msg=Item deleted!');

?>