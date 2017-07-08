<?php
    $first_material_id = $_POST['first_material'];
    $second_material_id = $_POST['second_material'];
    $component_id = $_POST['component'];
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    
    function cant_mix(){
        exit(header('Location: craft_material_select.php?err=cant mix this items'));
    }
    
    //connect DB and load to variable component and resurse
    include("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $select = mysql_query("SELECT * FROM `component_data` WHERE `component_id` = '$component_id'");
    $component = mysql_fetch_array($select);
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$first_material_id'");
    $first_item = mysql_fetch_array($select);
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$second_material_id'");
    $second_item = mysql_fetch_array($select);
    
    //if material like 'wood'
    if($first_item['item_structure'] == 'wood' || $second_item['item_structure'] == 'wood'){
        if($first_item['item_structure'] == 'wood'){
            $second_item = $first_item;
        }else if($second_item['item_structure'] == 'wood'){
            $first_item = $second_item;
        }
        
        $count_need = 1;
        
        if($component['component_coef']<3){
            $need = "wood chunk";
            $multy = 0.1;
        }else if($component['component_coef']<10){
            $need = "wood chunk";
            $multy = 1;
        }else if($component['component_coef']<25){
            $need = "wood double chunk";
            $multy = 2;
        }else if($component['component_coef']<50){
            $need = "wood triple chunk";
            $multy = 3;
        }else{
            $need = "wood triple chunk";
            $multy = 3+($component['component_coef']/50);
        }
        
        if($need == "wood chunk"){
            
            if($first_item['item_name'] == "wood chunk"){
                $new_item_count = 1/$multy;
            }else if($first_item['item_name'] == "wood double chunk"){
                $new_item_count = 2/$multy;
            }else if($first_item['item_name'] == "wood triple chunk"){
                $new_item_count = 3/$multy;
            }else{exit('string 62 craft_component_check');}
            
        }else if($need == "wood double chunk"){
            
            if($first_item['item_name'] == "wood double chunk"){
                $new_item_count = 1;
            }else if($first_item['item_name'] == "wood triple chunk"){
                $new_item_count = 1;
            }else{exit(header('Location: creft_component_select.php?err=Need double wood pies'));}
            
        }else if($need == "wood triple chunk"){
            
            if($first_item['item_name'] == "wood triple chunk"){
                $new_item_count = 1;
            }else{exit(header('Location: creft_component_select.php?err=Need triple wood pies'));}
            
        }
        
        
        $hard_coef = 1.1;
        $new_item_structure = $first_item['item_structure'];
        $new_item_coef = (int)(($first_item['item_coef']*$hard_coef));
        $new_item_name = $component['component_name'];
        $new_item_image = $component['component_name'];
        
        if($first_item['item_count']>$count_need){
            $temp_count1 = $first_item['item_count']-$count_need;
            mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }else{
            
            mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0', `item_image` = 'empty_cell.jpg' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }
        
        $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$new_item_name' AND `item_coef` = '$new_item_coef' AND `item_structure` LIKE '$new_item_structure'");
        $row = mysql_fetch_array($select);
        
        if($row['item_count']>0){
            
            $sum = $new_item_count+$row['item_count'];
            $temp_cell = $row['cell_id'];
            
            mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            exit(header('Location: craft_component_select.php?msg=new item stacked'));
                
        }else{
        
            $select = mysql_query("SELECT `cell_id` FROM `$form_user` WHERE `item_count` = 0");
            $row = mysql_fetch_array($select);
            $temp_cell = $row['cell_id'];
            mysql_query("UPDATE `$form_user` SET `item_name` = '$new_item_name', `item_count` = '$new_item_count', `item_coef` = '$new_item_coef', `item_type` = 'component', `item_structure` = '$new_item_structure', `item_image` = '$new_item_image'  WHERE `$form_user`.`cell_id` = '$temp_cell'");
            
            exit(header('Location: craft_component_select.php?msg=new item added'));
        }
        
    }
    
    if($first_material_id!=$second_material_id){
        if(!$first_material_id||!$second_material_id){
            exit(header('Location: craft_component_select.php?err=Must select both material!'));
        }
    }
    
    //now check on enought material
    $count_need = $component['component_coef'];
    
    if($first_material_id==$second_material_id){
        $count_need *= 2;
        if($first_item['item_count']<$count_need){
            exit(header('Location: craft_component_select.php?err=not enof resurses!'));
        }
    }else{
        if($first_item['item_count']<$count_need){
            exit(header('Location: craft_component_select.php?err=not enof first resurse!'));
        }
        if($second_item['item_count']<$count_need){
            exit(header('Location: craft_material_select.php?err=not enof second resurse!'));
        }
    }
    
    if($first_material_id==$second_material_id){
            
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
            
            if($second_item['item_structure']=="crystal"){
                $new_item_structure = "crystal";$hard_coef = 1.3;
                
            }else{
               $new_item_structure = "hard";$hard_coef = 1.2;
            }
            
        }else if($first_item['item_structure']=="crystal"){
            
            if($second_item['item_structure']=="hard"){
                $new_item_structure = "crystal";$hard_coef = 1.2;
                
            }else if($second_item['item_structure']=="liqid"){
                $new_item_structure = "liqid"; $hard_coef = 1.1;
                
            }else{
                $new_item_structure = "crystal"; $hard_coef = 1.4;
            }
            
        }else if($first_item['item_structure']=="liqid"){
            
            if($second_item['item_structure']=="crystal"){
                $new_item_structure = "liqid"; $hard_coef = 1.1;
                
            }else if($second_item['item_structure']=="fibre"){
                $new_item_structure = "fibre"; $hard_coef = 1.1;
                
            }else{
                $new_item_structure = "liqid"; $hard_coef = 1;
            }
            
        }else if($first_item['item_structure']=="fibre"){
            
            if($second_item['item_structure']=="liqid"){
                $new_item_structure = "fibre"; $hard_coef = 1.1;
                
            }else{
                $new_item_structure = "fibre"; $hard_coef = 1.2;
            }
            
        }else{cant_mix();}
    }

    $new_item_coef = (int)((($first_item['item_coef']+$second_item['item_coef'])/2)*($hard_coef));
    $new_item_name = $component['component_name'];
    $new_item_image = $component['component_name'];
    
    if($first_material_id==$second_material_id){
            
        if($first_item['item_count']>$count_need){
            $temp_count1 = $first_item['item_count']-$count_need;
            mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }else{
        
            mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0', `item_image` = 'empty_cell.jpg' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }
        
    }else{
        if($first_item['item_count']>$count_need){
            $temp_count1 = $first_item['item_count']-$count_need;
            mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }else{
        
            mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0', `item_image` = 'empty_cell.jpg' WHERE `$form_user`.`cell_id` = '$first_material_id'");
        }
        
        if($second_item['item_count']>$count_need){
            $temp_count2 = $second_item['item_count']-$count_need;
            mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count2' WHERE `$form_user`.`cell_id` = '$second_material_id'");
        }else{
            
            mysql_query("UPDATE `$form_user` SET `item_name` = 'empty', `item_count` = '0', `item_coef` = '0', `item_type` = 'none', `item_structure` = '0', `item_image` = 'empty_cell.jpg' WHERE `$form_user`.`cell_id` = '$second_material_id'");
        }
    }
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$new_item_name' AND `item_coef` = '$new_item_coef' AND `item_structure` LIKE '$new_item_structure'");
    $row = mysql_fetch_array($select);
    
    if($row['item_count']>0){
        
        $sum = 1+$row['item_count'];
        $temp_cell = $row['cell_id'];
        
        mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");
        
        header('Location: craft_component_select.php?msg=new item stacked');
            
    }else{
    
        $select = mysql_query("SELECT `cell_id` FROM `$form_user` WHERE `item_count` = 0");
        $row = mysql_fetch_array($select);
        $temp_cell = $row['cell_id'];
        mysql_query("UPDATE `$form_user` SET `item_name` = '$new_item_name', `item_count` = 1, `item_coef` = '$new_item_coef', `item_type` = 'component', `item_structure` = '$new_item_structure', `item_image` = '$new_item_image'  WHERE `$form_user`.`cell_id` = '$temp_cell'");
        
        header('Location: craft_component_select.php?msg=new item added');
    }
    
?>