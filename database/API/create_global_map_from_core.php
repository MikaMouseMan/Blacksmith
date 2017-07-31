<?php
session_start();
if($_SESSION['user_id'] != 1){
    exit(header("Location: ../../index.php"));
}
set_time_limit(0);

include ('../database.php');

$im = imagecreatefrompng("../map_core.png");

$size = getimagesize ("../map_core.png");
$x = $size[0];
$y = $size[1];

mysql_query("TRUNCATE data_map");
mysql_query("TRUNCATE data_spawners");

$ji = 0;
for($i = 0; $i < $y; $i++){
    
    $values_string_new = "";
    $values_string_old = "";
    $values_string2_new = "";
    $values_string2_old = "";
        
    for($j = 0; $j < $x; $j++){
        $rgb = imagecolorat($im, $j, $i);        
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
                        
        $values_string_this = "('".$ji."', '".$j."', '".$i."', '".$r."', '".$g."', '".$b."')";        
         
        srand();
        $x1 = rand(0,99);
        srand();
        $y1 = rand(0,99);
        

        $spawner_x = $j*1000000+$x1*1000;
        $spawner_y = $i*1000000+$y1*1000;
        $coef = rand(1,10);

        $values_string2_this = "('".$ji."', '".$spawner_x."', '".$spawner_y."', '".$coef."')";
        
        $ji++;

        ///////////////////////////////spawner points
        if($values_string2_old != ""){
            
            $values_string2_new = $values_string2_old.", ".$values_string2_this;
            
        }else{
            
            $values_string2_new = $values_string2_this;
            
        }
        $values_string2_old = $values_string2_new;
        ///////////////////////////////
        
        ///////////////////////////////map points
        if($values_string_old != ""){
            
            $values_string_new = $values_string_old.", ".$values_string_this;
            
        }else{
            
            $values_string_new = $values_string_this;
            
        }
        $values_string_old = $values_string_new;
        ///////////////////////////////
    }
    
    mysql_query("INSERT INTO `data_spawners` (`id`, `x`, `y`, `coef`) VALUES $values_string2_new");
    mysql_query("INSERT INTO `data_map` (`id`, `x`, `y`, `r`, `g`, `b`) VALUES $values_string_new");
}
header("Location: api.php?msg=Map update complite.")

?>