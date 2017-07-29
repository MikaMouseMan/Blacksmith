<?php

set_time_limit(0);

include("../../database/database.php");
$select = mysql_query("SELECT * FROM `data_map`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
    
</head>

<body align = "center">    
    <div>
    <a href="../exit.php">EXIT</a>
    </div>
    <div style='line-height: 0.9'>
    <?
    while($point = mysql_fetch_array($select)){

        $r = $point['r'];
        $g = $point['g'];
        $b = $point['b'];
        
        echo "<span style='background-color: RGB(".$r.",".$g.",".$b.")'>&#11036</span>";
        
        if($point['x']==511){
            echo "<br>";
        }

    }
    
    
    ?>
    </div>
</body>
</html>