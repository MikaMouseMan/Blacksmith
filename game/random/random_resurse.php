<?php
    $seed = rand(1,5);
    
    include('../../database/database.php');
    
<<<<<<< HEAD
<<<<<<< HEAD
    $select = mysql_query("SELECT * FROM `resurse_data` WHERE `resurse_id` = '$seed'");
=======
    $select = mysql_query("SELECT * FROM `data_resurse` WHERE `resurse_id` = '$seed'");
>>>>>>> refs/remotes/origin/master
=======

    $select = mysql_query("SELECT * FROM `data_resurse` WHERE `resurse_id` = '$seed'");
>>>>>>> origin/Blacksmith_Lucas
    $select_type = mysql_fetch_array($select);
    
    $item_structure = $select_type['resurse_structure'];
    $item_type = "resurse";
    $item_coef = rand($select_type['resurse_coef']/5,$select_type['resurse_coef']);
    $item_name = $select_type['resurse_name'];
    $item_image = $select_type['resurse_image'];
    $item_count = rand(100,200)/$item_coef;
    
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