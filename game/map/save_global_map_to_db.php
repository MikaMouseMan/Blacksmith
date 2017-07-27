<?php
set_time_limit(0);

include ('../../database/database.php');

$im = imagecreatefrompng("map_image.png");

mysql_query("TRUNCATE data_map");

$ji = 0;
for($i = 0; $i < 512; $i++){
    
    $values_string_new = "";
    $values_string_old = "";
    
    for($j = 0; $j < 512; $j++){
        $rgb = imagecolorat($im, $j, $i);        
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
                
        $ji++;
        $values_string_this = "('".$ji."', '".$j."', '".$i."', '".$r."', '".$g."', '".$b."')";
        
        if($values_string_old != ""){
            
            $values_string_new = $values_string_old.", ".$values_string_this;
            
        }else{
            
            $values_string_new = $values_string_this;
            
        }
        $values_string_old = $values_string_new;
    }
    
    mysql_query("INSERT INTO `data_map` (`id`, `x`, `y`, `r`, `g`, `b`) VALUES $values_string_new");
}

?>