<?php

if(!$_POST['tools']){
    exit(header('Location: craft_tools_select.php?err=ERROR tools not transmit!!!'));
}else if(!$_POST['first_component']){
    exit(header('Location: craft_tools_select.php?err=You dont select first component'));
}else if(!$_POST['second_component']){
    exit(header('Location: craft_tools_select.php?err=You dont select second component'));
}else if(!$_POST['tird_component']){
    exit(header('Location: craft_tools_select.php?err=You dont select third component'));
}

$tools_id = $_POST['tools'];
$first_component_id = $_POST['first_component'];
$second_component_id = $_POST['second_component'];
$third_component_id = $_POST['tird_component'];

session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../../index.php'));
}

function cant_mix(){
    exit(header('Location: craft_tools_select.php?err=cant mix this items'));
}

//connect DB and load to variable component 
include("../../../database/database.php");
$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$tools_select = mysql_query("SELECT * FROM `data_tools` WHERE `tools_id` = '$tools_id'");
$tools = mysql_fetch_array($tools_select);

$first_select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$first_component_id'");
$first_item = mysql_fetch_array($first_select);

$second_select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$second_component_id'");
$second_item = mysql_fetch_array($second_select);

$third_select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '$third_component_id'");
$third_item = mysql_fetch_array($third_select);

$first_item_need = ceil($tools['tools_coef']/40);
$second_item_need = ceil($tools['tools_coef']/80);
$third_item_need = ceil($tools['tools_coef']/160);


if($first_item['item_count']<$first_item_need){
    
    exit(header('Location: craft_tools_select.php?err=Not enoght first item'));
        
}else if($second_item['item_count']<$second_item_need){
    
    exit(header('Location: craft_tools_select.php?err=Not enoght second item'));
    
}else if($third_item['item_count']<$third_item_need){
    
    exit(header('Location: craft_tools_select.php?err=Not enoght third item'));
    
}

$new_item_name = $tools['tools_name'];
$new_item_type = "tools";
$new_item_structure = $first_item['item_structure'];
$new_item_count = 1;

$new_item_coef = (int)(($first_item['item_coef']*$tools['tools_coef'])+($second_item['item_coef']*$third_item['item_coef']));    
$new_item_health_max = ($new_item_coef*($first_item_need+$second_item_need))/100;
$new_item_health = $new_item_health_max;


if($first_item['item_count']>$first_item_need){
    $temp_count1 = $first_item['item_count']-$first_item_need;
    mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$first_component_id'");
}else{

    mysql_query("UPDATE `$form_user` SET `item_name` = '', `item_count` = '0', `item_coef` = '0', `item_type` = '', `item_structure` = '' WHERE `$form_user`.`cell_id` = '$first_component_id'");
}

if($second_item['item_count']>$second_item_need){
    $temp_count1 = $second_item['item_count']-$second_item_need;
    mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$second_component_id'");
}else{

    mysql_query("UPDATE `$form_user` SET `item_name` = '', `item_count` = '0', `item_coef` = '0', `item_type` = '', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$second_component_id'");
}

if($third_item['item_count']>$third_item_need){
    $temp_count1 = $third_item['item_count']-$third_item_need;
    mysql_query("UPDATE `$form_user` SET `item_count` = '$temp_count1' WHERE `$form_user`.`cell_id` = '$third_component_id'");
}else{

    mysql_query("UPDATE `$form_user` SET `item_name` = '', `item_count` = '0', `item_coef` = '0', `item_type` = '', `item_structure` = '0' WHERE `$form_user`.`cell_id` = '$third_component_id'");
}

$select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$new_item_name' AND `item_coef` = '$new_item_coef' AND `item_structure` LIKE '$new_item_structure'");
$row = mysql_fetch_array($select);

if($row['item_count']>0){

    $sum = $new_item_count+$row['item_count'];
    $temp_cell = $row['cell_id'];

    mysql_query("UPDATE `$form_user` SET `item_count` = '$sum' WHERE `$form_user`.`cell_id` = '$temp_cell'");

    exit(header('Location: craft_tools_select.php?msg=new item stacked'));

}else{

    $select = mysql_query("SELECT `cell_id` FROM `$form_user` WHERE `item_count` = '0'");
    $row = mysql_fetch_array($select);
    $temp_cell = $row['cell_id'];
    mysql_query("UPDATE `$form_user` SET `item_name` = '$new_item_name', `item_count` = '$new_item_count', `item_coef` = '$new_item_coef', `item_type` = 'tools', `item_structure` = '$new_item_structure', `health_max` = '$new_item_health_max', `health` = '$new_item_health' WHERE `$form_user`.`cell_id` = '$temp_cell'");

    exit(header('Location: craft_tools_select.php?msg=new item added'));
}
?>