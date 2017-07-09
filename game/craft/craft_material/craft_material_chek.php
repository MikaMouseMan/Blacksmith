<?php
    if($_POST['must_craft']>4){//if wood
        $first = $_POST['first_resurse'];
        $material_id = $_POST['must_craft'];
        
    }else if($_POST['first_resurse']>0&&$_POST['second_resurse']>0){
        $first = $_POST['first_resurse'];
        $second = $_POST['second_resurse'];
        $material_id = $_POST['must_craft'];
        
    }else{exit(header('Location: craft_material_select.php?err=choise both resurse'));};
    
    function cant_mix(){
        exit(header('Location: craft_material_select.php?err=cant mix this items'));
    }
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../../index.php'));
    }
    
    include("../../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $select = mysql_query("SELECT * FROM `data_material` WHERE `material_id` = '$material_id'");
    $material = mysql_fetch_array($select);
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$first'");
    $first_item = mysql_fetch_array($select);
    
    if($material['material_structure']=='wood'){
        $count_need = 1;
        
        //WOOD
        
        $new_item_structure = $first_item['item_structure'];
        $new_item_coef = $first_item['item_coef'];
        $new_item_name = $material['material_name'];
        
        if($first_item['item_count']>$count_need){
            $temp_count1 = $first_item['item_count']-$count_need;
            mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first'");
        }else{
            mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$first'");
        }
        
        
        $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$new_item_name' AND `item_coef` = '$new_item_coef' AND `item_structure` LIKE '$new_item_structure'");
        $row = mysql_fetch_array($select);
        
        if($row['item_count']>0){
            
            $sum = 1+$row['item_count'];
            $temp_cell = $row['cell_id'];
            
            mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            exit(header('Location: craft_material_select.php?msg=new item stacked'));
                
        }else{
        
            $select = mysql_query("SELECT `cell_id` FROM `$form_user` WHERE `item_count` = 0");
            $row = mysql_fetch_array($select);
            $temp_cell = $row['cell_id'];
            mysql_query("UPDATE `$form_user` SET `item_name` = '$new_item_name', `item_count` = 1, `item_coef` = '$new_item_coef', `item_type` = 'material', `item_structure` = '$new_item_structure' WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            exit(header('Location: craft_material_select.php?msg=new item added'));
        }
        
        //WOOD
        
        
    }else{
        
        $count_need = $material['material_coef'];
        
        if($first_item['item_count']<$count_need){
            exit(header('Location: craft_material_select.php?err=not enof first resurse!'));
        }
        
        if($first==$second){
          
            if($first_item['item_count']<$count_need*2){
                exit(header('Location: craft_material_select.php?err=not enof resurses!'));
            }
        }
    
        
        $select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$second'");
        $second_item = mysql_fetch_array($select);
        
        if($second_item['item_count']<$count_need){
            
            exit(header('Location: craft_material_select.php?err=not enof second resurse!'));
        }
        
        if($first==$second){
            
            $new_item_structure = $first_item['item_structure'];
            if($first_item['item_structure']=="hard"){
                $hard_coef = 1.2;
            }
            if($first_item['item_structure']=="crystal"){
                $hard_coef = 1.4;
            }
            if($first_item['item_structure']=="fibre"){
                $hard_coef = 1.2;
            }
            if($first_item['item_structure']=="liqid"){
                $hard_coef = 1.1;
            }
            
        }else{
            
            if($first_item['item_structure']=="hard"){
                
                $new_item_structure = "hard";$hard_coef = 1.2;
                
            }else if($first_item['item_structure']=="crystal"){
                
                $new_item_structure = "crystal";$hard_coef = 1.3;
                
            }else if($first_item['item_structure']=="liqid"){
                
                $new_item_structure = "liqid";$hard_coef = 1.1;
                
            }else if($first_item['item_structure']=="fibre"){
                
                $new_item_structure = "fibre";$hard_coef = 1.2;
                
            }else cant_mix();
        }
        
        $new_item_coef = (int)((($first_item['item_coef']+$second_item['item_coef'])/2)*($hard_coef));
        $new_item_name = $material['material_name'];
        
        if($first == $second){
            
            if($first_item['item_count']>$count_need*2){
                $temp_count1 = $first_item['item_count']-$count_need*2;
                mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first'");
            }else{
            
                mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$first'");
            }
            
        }else{
            if($first_item['item_count']>$count_need){
                $temp_count1 = $first_item['item_count']-$count_need;
                mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first'");
            }else{
            
                mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$first'");
            }
            
            if($second_item['item_count']>$count_need){
                $temp_count2 = $second_item['item_count']-$count_need;
                mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count2' WHERE `$form_user`.`cell_id` = '$second'");
            }else{
                
                mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$second'");
            }
        }
        
        $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$new_item_name' AND `item_coef` = '$new_item_coef' AND `item_structure` LIKE '$new_item_structure'");
        $row = mysql_fetch_array($select);
        
        if($row['item_count']>0){
            
            $sum = 1+$row['item_count'];
            $temp_cell = $row['cell_id'];
            
            mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            header('Location: craft_material_select.php?msg=new item stacked');
                
        }else{
        
            $select = mysql_query("SELECT `cell_id` FROM `$form_user` WHERE `item_count` = 0");
            $row = mysql_fetch_array($select);
            $temp_cell = $row['cell_id'];
            mysql_query("UPDATE `$form_user` SET `item_name` = '$new_item_name', `item_count` = 1, `item_coef` = '$new_item_coef', `item_type` = 'material', `item_structure` = '$new_item_structure' WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            header('Location: craft_material_select.php?msg=new item added');
        }
    }
?>
