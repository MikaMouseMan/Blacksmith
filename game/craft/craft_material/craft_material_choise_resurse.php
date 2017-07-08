<?php
    if($_POST['must_craft']==0){
        exit(header('Location: craft_material_select.php?err=make you choise'));
    };
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../../index.php'));
    }
    
    if(!isset($_GET['msg'])){
        $_GET['msg']='';
    }
    if(!isset($_GET['err'])){
        $_GET['err']='';
    }
    
    include("../../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $material_id = $_POST['must_craft'];
    $select = mysql_query("SELECT * FROM `data_material` WHERE `material_id` = '$material_id'");
    $material = mysql_fetch_array($select);
    
    $material_structure = $material['material_structure'];
    $msg = "Need ".$material['material_coef']." count both resurse.";
    
    if($material_structure == 'hard'){
        $alternativ_structure1 = '';
        
    }else if($material_structure == 'crystal'){
        $alternativ_structure1 = 'hard';
        
    }else if($material_structure == 'fibre'){
        $alternativ_structure1 = 'liqid';
        
    }else if($material_structure == 'liqid'){
        $alternativ_structure1 = 'crystal';
        
    }else if($material_structure == 'wood'){
        $alternativ_structure1 = '';
        $msg = "Need 1 log.";
    }
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href="../craft.php">Back</a>
    <br><a href = "craft_material_select.php">Enother choise</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>
    <br><?=$msg?>
    <br><form action="craft_material_chek.php" method = "post">
        <input type="hidden" name = "must_craft" value = "<?=$material_id?>">
        <select name = "first_resurse">
            <option selected disabled>Choise first resurse</option>
            <?
            $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'resurse' AND `item_structure` LIKE '$material_structure'");
            
            while($first = mysql_fetch_array($select)){
                echo "<option value='".$first['cell_id']."'>Name: ".$first['item_name']." coef: ".$first['item_coef']." type: ".$first['item_structure']." count: ".$first['item_count']."</option>";
            }
            ?>
        </select>
        <br>
        
        <select name = "second_resurse">
            <option selected disabled>Choise second resurse</option>
            <?
            $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'resurse' AND `item_structure` IN ('$material_structure', '$alternativ_structure1')");
                
            while($second = mysql_fetch_array($select)){
                echo "<option value='".$second['cell_id']."'>Name: ".$second['item_name']." coef: ".$second['item_coef']." type: ".$second['item_structure']." count: ".$second['item_count']."</option>";
            };
            ?>
        </select>
        <input type="submit" value = 'Craft'>
    </form>
</body>
</html>