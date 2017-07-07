<?php
    $seed = rand(1,5);
    if($seed == 5){$seed += rand(0,2);}
    
    
    include('../../database/database.php');
    
    
    
    $select = mysql_query("SELECT * FROM `material_data` WHERE `material_id` = '$seed'");
    $select_type = mysql_fetch_array($select);
    $resurse = $select_type['material_structure'];
    $select = mysql_query("SELECT * FROM `resurse_data` WHERE `resurse_structure` LIKE '$resurse'");
    $resurse = mysql_fetch_array($select);
    
    $item_structure = $select_type['material_structure'];
    $item_type = "material";
    $item_coef = (int)rand($resurse['resurse_coef']/5,$resurse['resurse_coef'])*1.5;
    $item_name = $select_type['material_name'];
    $item_image = $select_type['material_image'];
    $item_count = 3; // rand(2,4);
    
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