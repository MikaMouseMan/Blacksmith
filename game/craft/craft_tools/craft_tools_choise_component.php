<?php
    
if($_POST['must_craft']==0){
    exit(header('Location: craft_tools_select.php?err=make you choise'));
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
$tools_id = $_POST['must_craft'];
$select = mysql_query("SELECT * FROM `data_tools` WHERE `tools_id` = '$tools_id'");
$tools = mysql_fetch_array($select);

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

if($tools['tools_name']=='hammer'){
   
    $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '6000' AND '7000'");//hammer head
    $first_name = "hammer head";
    $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
    $second_name = "handle";
    $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '406'");//mixture
    $third_name = "linen";
    
}else if($tools['tools_name']=='saw'){
   
    $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '301'");//plate
    $first_name = "hammer head";
    $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '408'");//tile
    $second_name = "handle";
    $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
    $third_name = "linen";
    
}else if($tools['tools_name']=='showel'){
   
    $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '301'");//plate
    $first_name = "hammer head";
    $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
    $second_name = "handle";
    $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '8000' AND '9000'");//yip
    $third_name = "linen";
    
}else if($tools['tools_name']=='axe'){
   
    $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '7000' AND '8000'");//axe head
    $first_name = "hammer head";
    $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
    $second_name = "handle";
    $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '406'");//mixture
    $third_name = "linen";
    
}else{
    exit(header('Location: ../craft?err=component select error'));
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
    <br><a href = "craft_tools_select.php">Enother choise</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>To craft <?=$tools['tools_name']?> you need <?=ceil($tools['tools_coef']/40)." ".$first_name?>:
        
    <form action="craft_tools_chek.php" method = "post">
        <input type="hidden" name = "tools" value = "<?=$tools_id?>">
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
        <br>And you need <?=ceil($tools['tools_coef']/80)." ".$second_name?>:
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
        <br>And you need <?=ceil($tools['tools_coef']/160)." ".$third_name?>:
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