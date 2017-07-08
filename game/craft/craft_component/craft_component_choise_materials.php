<?php
    
    if($_POST['must_craft']==0){
        exit(header('Location: craft_component_select.php?err=make you choise'));
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
    $component_id = $_POST['must_craft'];
    $select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '$component_id'");
    $component = mysql_fetch_array($select);
    
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $structure = $component['component_structure'];
    
    if($structure == 'hard_crystal_wood'){
        $structure1 = "hard";
        $structure2 = "crystal";
        $structure3 = "wood";
    }else if($structure == 'hard_crystal'){
        $structure1 = "hard";
        $structure2 = "crystal";
        $structure3 = "empty";
    }else if($structure == 'hard_wood'){
        $structure1 = "hard";
        $structure2 = "wood";
        $structure3 = "empty";
    }else if($structure == 'hard'){
        $structure1 = "hard";
        $structure2 = "empty";
        $structure3 = "empty";
    }else if($structure == 'crystal'){
        $structure1 = "crystal";
        $structure2 = "empty";
        $structure3 = "empty";
    }else if($structure == 'wood'){
        $structure1 = "wood";
        $structure2 = "empty";
        $structure3 = "empty";
    }else if($structure == 'fibre'){
        $structure1 = "fibre";
        $structure2 = "empty";
        $structure3 = "empty";
    }else if($structure == 'liqid'){
        $structure1 = "liqid";
        $structure2 = "empty";
        $structure3 = "empty";
    }else {
        exit(header('Location: craft_component_select.php?err=cant found same structure'));
    }
    
    
?>
<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href = "../craft.php">Cansel</a>
    <br><a href = "craft_component_select.php">Enother choise</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>To craft <?=$component['component_name']?> you need <?=$component['component_coef']?> count both materials
    <br>
    
    <?
    if($structure=="wood" or $structure1=="wood" or $structure2=="wood" or $structure3=="wood"){
        if($component['component_coef']<10){
            echo "if you use wood you need chunk wood.";
        }else if($component['component_coef']<25){
            echo "if you use wood you need double chunk wood.";
        }elseif($component['component_coef']<50){
            echo "if you use wood you need triple chunk wood.";
        }else{echo "if you use wood you need ".(int)(1+($component['component_coef']/50))." triple chunks wood.";}
    }
    ?>
        
    <form action="craft_component_chek.php" method = "post">
        <input type="hidden" name = "component" value = "<?=$component_id?>">
        <select name="first_material">
            <option selected disabled>First material</option>
            <?
            $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_structure` IN ('$structure1', '$structure2', '$structure3') AND `item_type` LIKE 'material'");
            
            while($material = mysql_fetch_array($select)){
                echo "<option value='".$material['cell_id']."'>Name: ".$material['item_name']." coef: ".$material['item_coef']." type: ".$material['item_structure']." count: ".$material['item_count']."</option>";
            }
            ?>
        </select>
        <br>
        <select name="second_material">
            <option selected disabled>Second material</option>
            <?
            $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_structure` IN ('$structure1', '$structure2', '$structure3') AND `item_type` LIKE 'material'");
            
            while($material = mysql_fetch_array($select)){
                echo "<option value='".$material['cell_id']."'>Name: ".$material['item_name']." coef: ".$material['item_coef']." type: ".$material['item_structure']." count: ".$material['item_count']."</option>";
            }
            ?>
        </select>
        <input type = "submit" value = "Confirm">
    </form>
</body>
</html>