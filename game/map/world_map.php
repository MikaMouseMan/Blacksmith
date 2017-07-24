<?php

set_time_limit(0);

include("../../database/database.php");
$select = mysql_query("SELECT * FROM `data_temp_map`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
    
</head>

<body>
    <a href="../exit.php">EXIT</a>
    <br><a href="map_select_zone.php">Back</a><br>
    <?
    while($point = mysql_fetch_array($select)){

        $r = $point['r'];
        $g = $point['g'];
        $b = $point['b'];
        
        echo "<a href = 'map_generator_100.php?x=".$point['x']."&y=".$point['y']."' style='background-color: RGB(".$r.",".$g.",".$b.")'>&#8195</a>";
        
        if($point['x']==511){
            echo "<br>";
        }

    }
    
    
    ?>
</body>
</html>