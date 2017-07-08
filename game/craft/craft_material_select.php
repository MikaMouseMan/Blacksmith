<?php
    
    include("../../database/database.php");
    $select = mysql_query("SELECT * FROM `material_data`");
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href="craft.php">Back</a>
    <br>
    <br><?=$_GET['err'].$_GET['msg']?>
    <br>
    <form action="craft_material_choise_resurse.php" method = "post">
        <select name="must_craft">
            <option selected desabled>Choise what create</option>
            <?
            while($element = mysql_fetch_array($select)){
                echo "<option value = '".$element['material_id']."'>".$element['material_name']."</option>";
            }
            ?>
        </select>
        <input type="submit" value = "craft">
    </form>
</body>
</html>