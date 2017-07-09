<?php

if($_POST['must_craft']==0){
    exit(header('Location: craft_armore_select.php?err=make you choise'));
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
$armore_id = $_POST['must_craft'];
$select = mysql_query("SELECT * FROM `data_armore` WHERE `armore_id` = '$armore_id'");
$armore = mysql_fetch_array($select);

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$structure = $armore['armore_structure'];
    
if($structure == 'hard_crystal_fibre'){
    $structure1 = "hard";
    $structure2 = "crystal";
    $structure3 = "fibre";
}else if($structure == 'hard_crystal'){
    $structure1 = "hard";
    $structure2 = "crystal";
    $structure3 = "";
}else if($structure == 'fibre'){
    $structure1 = "fibre";
    $structure2 = "";
    $structure3 = "";
}else {
    exit(header('Location: craft_component_select.php?err=cant found same structure'));
}

$first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` IN ('301','403') AND `component_structure` IN ('$structure1','$structure2','$structure3')");//plate,linen,tile
$first_name = "plate or linen or tile";
$second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '403'");//linen
$second_name = "linen";
$third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
$third_name = "twine";

?>
<!doctype html>
<html lang = "en">
<head>
<meta charset = "UTF-8">
<title>Blacksmith</title>
</head>
<body>
<a href = "../craft.php">Cansel</a>
<br><a href = "craft_armore_select.php">Enother choise</a>
<br>
<br><?=$_GET['err'].$_GET['msg']?>
<br>To craft <?=$armore['armore_name']?> you need <?=ceil($armore['armore_coef']/30)." ".$first_name?>:

<form action="craft_armore_chek.php" method = "post">
    <input type="hidden" name = "armore" value = "<?=$armore_id?>">
    <select name="first_component">
        <option selected disabled>first component</option>
            <?   
                while($first_component = mysql_fetch_array($first_select)){

                    $item_name = $first_component['component_name'];
                    $item_select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$item_name'");

                    while($item_component = mysql_fetch_array($item_select)){

                        echo "<option value='".$item_component['cell_id']."'>Name: ".$item_component['item_name']." coef: ".$item_component['item_coef']." type: ".$item_component['item_structure']." count: ".$item_component['item_count']."</option>";
                    }
                }
            ?>
    </select>
    <br>And you need <?=ceil($armore['armore_coef']/65)." ".$second_name?>:
    <br>
    <select name="second_component">
        <option selected disabled>Second component</option>
            <?   
                while($second_component = mysql_fetch_array($second_select)){

                    $item_name = $second_component['component_name'];
                    $item_select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$item_name'");

                    while($item_component = mysql_fetch_array($item_select)){

                        echo "<option value='".$item_component['cell_id']."'>Name: ".$item_component['item_name']." coef: ".$item_component['item_coef']." type: ".$item_component['item_structure']." count: ".$item_component['item_count']."</option>";
                    }
                }
            ?>
    </select>
    <br>And you need <?=ceil($armore['armore_coef']/130)." ".$third_name?>:
    <br>
    <select name="tird_component">
        <option selected disabled>Third component</option>
            <?   
                while($tird_component = mysql_fetch_array($third_select)){

                    $item_name = $tird_component['component_name'];
                    $item_select = mysql_query("SELECT * FROM `$form_user` WHERE `item_name` LIKE '$item_name'");

                    while($item_component = mysql_fetch_array($item_select)){

                        echo "<option value='".$item_component['cell_id']."'>Name: ".$item_component['item_name']." coef: ".$item_component['item_coef']." type: ".$item_component['item_structure']." count: ".$item_component['item_count']."</option>";
                    }
                }
            ?>
    </select>
    <br>
    <input type = "submit" value = "Confirm">
</form>
</body>
</html>