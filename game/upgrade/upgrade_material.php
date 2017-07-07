<?php
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    include("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
    
    $select = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'material'");
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href="../main_menu.php">Back</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>
    <br>
    <br>
    <form action="upgrade_material.php" method = "post">
        <select name="must_upgrade">
            <option selected desabled>Choise what upgrade</option>
            <?
            while($item = mysql_fetch_array($select)){
                echo "<option value = '".$item['item_id']."'>".$item['item_structure']." ".$item['item_name']." H: ".$item['item_coef']."</option>";
            }
            ?>
        </select>
        <input type="submit" value = "craft">
    </form>
</body>
</html>