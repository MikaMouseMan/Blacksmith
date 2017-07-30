<?php
set_time_limit(0);

include ('database.php');

$im = imagecreatefrompng("map_core.png");

$size = getimagesize ("map_core.png");
$x = $size[0];
$y = $size[1];

mysql_query("TRUNCATE data_map");

$ji = 0;
for($i = 0; $i < $y; $i++){
    
    $values_string_new = "";
    $values_string_old = "";
    
    for($j = 0; $j < $x; $j++){
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
header("Location: api.php?msg=Map update complite.")

?>