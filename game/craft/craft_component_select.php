<?php
    
    include("../../database/database.php");
    $select = mysql_query("SELECT * FROM `component_data`");
    
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
    <form action="craft_component_choise_materials.php" method = "post">
        <select name="must_craft">
            <option selected desabled>Choise what create</option>
            <?
            while($element = mysql_fetch_array($select)){
                echo "<option value = '".$element['component_id']."'>".$element['component_name']."</option>";
            }
            ?>
        </select>
        <input type="submit" value = "craft">
    </form>
</body>
</html>