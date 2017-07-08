<?php
    
    if($_POST['must_craft']==0){
        exit(header('Location: craft_weapon_select.php?err=make you choise'));
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
    $weapon_id = $_POST['must_craft'];
    $select = mysql_query("SELECT * FROM `weapon_data` WHERE `weapon_id` = '$weapon_id'");
    $weapon = mysql_fetch_array($select);
    
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $structure = $weapon['weapon_structure'];
    
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
        exit(header('Location: craft_weapon_select.php?err=cant found same structure'));
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
    <br><a href = "craft_weapon_select.php">Enother choise</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>To craft <?=$weapon['weapon_name']?> you need:
        
    <form action="craft_weapon_chek.php" method = "post">
        <input type="hidden" name = "weapon" value = "<?=$weapon_id?>">
        <select name="first_component">
            <option selected disabled>First component</option>
            <?
            $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_structure` IN ('$structure1', '$structure2', '$structure3') AND `item_type` LIKE 'component'");
            
            while($component = mysql_fetch_array($select)){
                echo "<option value='".$component['cell_id']."'>Name: ".$component['item_name']." coef: ".$component['item_coef']." type: ".$component['item_structure']." count: ".$component['item_count']."</option>";
            }
            ?>
        </select>
        <br>
        
        <input type = "submit" value = "Confirm">
    </form>
</body>
</html>