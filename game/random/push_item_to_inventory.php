<?php
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    include("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $item_structure = $_POST['item_structure'];
    $item_type = $_POST['item_type'];
    $item_coef = $_POST['item_coef'];
    $item_name = $_POST['item_name'];    
    $item_count = $_POST['item_count'];
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$item_name' AND `item_coef` = '$item_coef' AND `item_structure` LIKE '$item_structure'");
    $row = mysql_fetch_array($select);
    
    if($row['item_count']>0){
        
        $sum = $item_count+$row['item_count'];
        $temp_cell = $row['cell_id'];
        
        mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");
        
        exit(header('Location: ../home/blacksmith_home.php?msg=item staked'));
        
    }else{
        
        $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_count` = 0");
        $row = mysql_fetch_array($select);
        
        if(!$row){
            
            exit(header('Location: ../home/blacksmith_home.php?err=inventory full item lost'));
        }
        
        $sum = $item_count+$row['item_count'];
        $temp_cell = $row['cell_id'];
        mysql_query("UPDATE `$form_user` SET `item_name` = '$item_name', `item_count` = '$sum', `item_coef` = '$item_coef', `item_type` = '$item_type', `item_structure` = '$item_structure' WHERE `$form_user`.`cell_id` = '$temp_cell'");
        
        exit(header('Location: ../home/blacksmith_home.php?msg=new item added'));
    
    }
    
    
?>