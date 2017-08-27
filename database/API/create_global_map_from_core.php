<?php
define ("color_const", 64);// 255/3 = 85 255/4=64

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
                        
        if($r == 0){
            if($g == 0){
                if($b == 0){
                    $image_point = "error";
                    
                }else if($b > color_const * 3){              
                    $image_point = "smal_water"; //////////////blue pure   
                    
                }else if($b > color_const * 2 && $b < color_const * 3 + 1){              
                    $image_point = "midle_water"; //////////////blue pure     
                    
                }else if($b > color_const && $b < color_const * 2){
                    $image_point = "water";//////////////blue pure 
                    
                }else if($b < color_const+1){
                    $image_point = "deep_water";//////////////blue pure 
                }
                
            }else if($g > color_const * 3){
                if($b == 0){
                    $image_point = "flat"; //////////////green pure                               
                }else if($b > color_const * 3){
                    $image_point = "frosty"; ////////////////////////cyan
                }
                
            }else if($g > color_const * 2 && $g < color_const * 3 + 1){
                if($b == 0){
                    $image_point = "grassland";//////////////green pure  
                }else if($b > color_const * 2 && $b < color_const * 3 + 1){
                    $image_point = "cold_frosty"; ////////////////////////cyan
                }
                
            }else if($g > color_const && $g < color_const * 2 + 1){
                if($b == 0){
                    $image_point = "grass";//////////////green pure
                }else if($b > color_const && $b < color_const * 2 + 1){
                    $image_point = "cold"; ////////////////////////cyan
                }
                
            }else if($g < color_const+1){
                if($b == 0){    
                    $image_point = "hils";//////////////green pure
                }else if($b < color_const + 1){
                    $image_point = "wery_cold"; ////////////////////////cyan
                }
            }
            
        }else if($r > color_const * 3){ 
            if($g == 0){
                if($b == 0){
                    $image_point = "cold_lava"; //////////////red pure                                
                }else if($b > color_const * 3){
                    $image_point = "smal_swap"; ////////////////////////fiolet
                }
                
            }else if($g > color_const * 3){
                if($b == 0){
                    $image_point = "lite_sand"; //////////////yelloy pure 
                    
                }else if($b > color_const * 3){
                    $image_point = "low_mountain"; //////////////gray pure                               
                }
            }
        }else if($r > color_const * 2 && $r < color_const * 3 + 1){ 
            if($g == 0){
                if($b == 0){
                    $image_point = "midle_lava"; //////////////red pure                           
                }else if($b > color_const * 2 && $b < color_const * 3 + 1){
                    $image_point = "swap"; ////////////////////////fiolet
                }
                
            }else if($g > color_const * 2 && $g < color_const * 3 + 1){
                if($b == 0){
                    $image_point = "midle_sand"; //////////////yelloy pure   
                    
                }else if($b > color_const * 2 && $b < color_const * 3 + 1){
                    $image_point = "midle_mountain"; //////////////gray pure                            
                }
            }
        }else if($r > color_const && $r < color_const * 2 + 1){
            
            if($g == 0){
                if($b == 0){
                    $image_point = "lava";//////////////red pure 
                }else if($b > color_const && $b < color_const * 2 + 1){
                    $image_point = "deep_swap"; ////////////////////////fiolet
                }
                
            }else if($g > color_const && $g < color_const * 2 + 1){
                
                if($b == 0){
                    $image_point = "sand";//////////////yelloy pure
                    
                }else if($b > color_const && $b < color_const * 2 + 1){
                    $image_point = "mountain"; //////////////gray pure                               
                }
            }            
        }else if($r < color_const + 1){
            
            if($g == 0){
                if($b == 0){
                    $image_point = "hot_lava";//////////////red pure 
                }else if($b < color_const + 1){
                    $image_point = "death_swap"; ////////////////////////fiolet
                }
                
            }else if($g < color_const + 1){
                if($b == 0){    
                    $image_point = "hard_sand";//////////////yelloy pure
                    
                }else if($b < color_const + 1){
                    $image_point = "high_mountain"; //////////////gray pure                               
                }
            }
        }
        
        $values_string_this = "('".$ji."', '".$j."', '".$i."', '".$r."', '".$g."', '".$b."', '".$image_point."')";        
         
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
    mysql_query("INSERT INTO `data_map` (`id`, `x`, `y`, `r`, `g`, `b`, `zone`) VALUES $values_string_new");
}
header("Location: api.php?msg=Map update complite.")

?>