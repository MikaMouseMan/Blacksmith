<?php
    $seed = rand(1,5);
    
    include('../../database/database.php');
    $select = mysql_query("SELECT * FROM `data_resurse` WHERE `resurse_id` = '$seed'");
    $select_type = mysql_fetch_array($select);
    $structure = $select_type['resurse_structure'];
    $structure1 = $structure."_crystal";
    $structure2 = $structure1."_wood";
    $structure3 = $structure."_wood";
    

    $select = mysql_query("SELECT * FROM `data_component` WHERE `component_structure` IN ('$structure', '$structure1', '$structure2', '$structure3')");
    
    if(!$select){
        exit(header('Location: ../main_menu.php?err=cant found random component'));
    }
    
    while($select_type = mysql_fetch_array($select)){
        
        $temp_id[] = $select_type['component_id'];
    };
    
    $seed = rand(0,count($temp_id)-1);
    $component_id = $temp_id[$seed];
    

    $select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '$component_id'");
    
    $select_type = mysql_fetch_array($select);
    
    $item_structure = $select_type['component_structure'];
    $item_type = "component";
    $item_coef = rand(50/$select_type['component_coef'],100/$select_type['component_coef']);
    $item_name = $select_type['component_name'];
    $item_image = $select_type['component_image'];
    $item_count = 1;//rand(1,2);
    
    $adress = "push_item_to_inventory.php";
?>

<form action="<?=$adress?>" method = "post" id = "id" >
    <input type="hidden" name = 'item_structure' value = '<?=$item_structure?>'>
    <input type="hidden" name = 'item_type' value = '<?=$item_type?>'>
    <input type="hidden" name = 'item_coef' value = '<?=$item_coef?>'>
    <input type="hidden" name = 'item_name' value = '<?=$item_name?>'>
    <input type="hidden" name = 'item_image' value = '<?=$item_image?>'>
    <input type="hidden" name = 'item_count' value = '<?=$item_count?>'>
    
</form>

<script>
    document.forms['id'].submit();
</script>