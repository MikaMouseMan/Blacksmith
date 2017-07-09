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
    $select = mysql_query("SELECT * FROM `data_weapon` WHERE `weapon_id` = '$weapon_id'");
    $weapon = mysql_fetch_array($select);
    
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
        
    if($weapon_id<2000){//sword        
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '2000' AND '3000'");//blade
        $first_name = "blade component";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
        $second_name = "handle";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '9000' AND '10000'"); //garde
        $third_name = "garde";
        
    }else if($weapon_id<3000){//bow        
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '3000' AND '4000'");//bow component
        $first_name = "bow component";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '402'");//cord
        $second_name = "cord";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<4000){//pike        
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '8000' AND '9000'");//tip
        $first_name = "tip";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '4000' AND '5000'");//rod
        $second_name = "rod";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<5000){//hammer       
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '6000' AND '7000'");//hammer head
        $first_name = "hammer head";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
        $second_name = "handle";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<6000){//axe       
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '7000' AND '8000'");//axe head
        $first_name = "axe head";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
        $second_name = "handle";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<7000){//arrow, throwable      
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '8000' AND '9000'");//tip
        $first_name = "tip";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '4000' AND '5000'");//rod
        $second_name = "rod";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<8000){//staff      
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '4000' AND '5000'");//rod
        $first_name = "rod";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '405'");//diamond
        $second_name = "diamond";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '406'"); //mixture
        $third_name = "mixture";
        
    }else if($weapon_id<9000){//book      
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '407'");//paper
        $first_name = "paper";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '403'");//linen
        $second_name = "linen";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '404'"); //twine
        $third_name = "twine";
        
    }else if($weapon_id<10000){//shield     
    
        $first_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` IN ('301','408')");//plate,tile
        $first_name = "plate or tile";
        $second_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` BETWEEN '1000' AND '2000'");//handle
        $second_name = "handle";
        $third_select = mysql_query("SELECT * FROM `data_component` WHERE `component_id` = '403'");//linen
        $third_name = "linen";
        
    }else{exit(header('Location: ../craft?err=component select error'));}
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
    <br>To craft <?=$weapon['weapon_name']?> you need <?=ceil($weapon['weapon_coef']/40)." ".$first_name?>:
        
    <form action="craft_weapon_chek.php" method = "post">
        <input type="hidden" name = "weapon" value = "<?=$weapon_id?>">
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
        <br>And you need <?=ceil($weapon['weapon_coef']/80)." ".$second_name?>:
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
        <br>And you need <?=ceil($weapon['weapon_coef']/160)." ".$third_name?>:
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