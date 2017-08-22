<?php
//constant
define ("color_const", 64);// 255/3 = 85 255/4=64
define ("map_drow_size", 25);//map heigt & wind draw
define ("map_scale_max", 100);//pixel map lenght

session_start();
include ('../../database/database.php');


$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

//top coord
$x = (int)($global_x/1000000);
$y = (int)($global_y/1000000);

$select = mysql_query("SELECT * FROM `data_map` WHERE `x` = '$x' AND `y` = '$y'");
$map_start_point = mysql_fetch_array($select);

$r_main = $map_start_point['r'];
$g_main = $map_start_point['g'];
$b_main = $map_start_point['b'];

//global setting
//
$mountain_max_hight = 5;
$mountain_count = 10;
$sity_count = 3;
$enemy_camp_count = 6;

/////////////////////create and fill array base color
for($i = 0; $i < map_scale_max; $i++){
    for($j = 0; $j < map_scale_max; $j++){
        
        $image[$i][$j]['r']= $r_main;
        $image[$i][$j]['g']= $g_main;
        $image[$i][$j]['b']= $b_main;
    }
}

///////////player midle coord
$player_x = (int)(($global_x%1000000)/1000);
$player_y = (int)(($global_y%1000000)/1000);

if($x != (int)($global_x/1000000)){
    echo "Missing x!";
}
if($y != (int)($global_y/1000000)){
    echo "Missing y!";
}
    

$map_seed = (int) $x.$y.$r_main.$g_main.$b_main;

srand($map_seed);

///////////////////////////////////////////MOUNTAIN generation

////////////////////////////////higter/deeper color
$r_main -= color_const;
if($r_main < 0){
    $r_main = 0;
}
$g_main -= color_const;
if($g_main < 0){
    $g_main = 0;
}
$b_main -= color_const;
if($b_main < 0){
    $b_main = 0;
}

while($mountain_count > 0){    
    
    $i = rand(0, map_scale_max - 1);
    srand($i);
    $j = rand(0, map_scale_max - 1);
    srand($j);
                         
    $first_circle = 377 * $mountain_max_hight;
                
    $image[$i][$j]['r'] = $r_main;
    $image[$i][$j]['g'] = $g_main;
    $image[$i][$j]['b'] = $b_main;
    
    while($first_circle > 0){
        
        $direction = rand(1,4);
        
        switch($direction){
            case 1: $i -= 1; break;
            case 2: $i += 1;break;
            case 3: $j -= 1;break;
            case 4: $j += 1;break;
        }
        
        //check frame for x out of range
        if($i < 0){
            $i = 0;
        }else if($i > map_scale_max - 1){
            $i = map_scale_max - 1;
        }
        //check frame for y out of range
        if($j < 0){
            $j = 0;
        }else if($j > map_scale_max - 1){
            $j = map_scale_max - 1;
        }
        
        $image[$i][$j]['r']= $r_main;
        $image[$i][$j]['g']= $g_main;
        $image[$i][$j]['b']= $b_main;  
        
        srand(rand($i, $j * 1000));
        
        
            //make stronger 
        if(($i - rand(1, $mountain_max_hight)) > 0){                    
                $image[$i - rand(1, $mountain_max_hight)][$j]['r']= $r_main;
                $image[$i - rand(1, $mountain_max_hight)][$j]['g']= $g_main;
                $image[$i - rand(1, $mountain_max_hight)][$j]['b']= $b_main;      
            }
        if(($i + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$i + rand(1, $mountain_max_hight)][$j]['r']= $r_main;
                $image[$i + rand(1, $mountain_max_hight)][$j]['g']= $g_main;
                $image[$i + rand(1, $mountain_max_hight)][$j]['b']= $b_main;      
            }
        if(($j - rand(1, $mountain_max_hight)) > 0){                    
                $image[$i][$j - rand(1, $mountain_max_hight)]['r']= $r_main;
                $image[$i][$j - rand(1, $mountain_max_hight)]['g']= $g_main;
                $image[$i][$j - rand(1, $mountain_max_hight)]['b']= $b_main;      
            }
        if(($j + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$i][$j + rand(1, $mountain_max_hight)]['r']= $r_main;
                $image[$i][$j + rand(1, $mountain_max_hight)]['g']= $g_main;
                $image[$i][$j + rand(1, $mountain_max_hight)]['b']= $b_main;      
            }
            
                   
            srand(rand($i, $j * 50));
            
        
        $first_circle--;
        
    }
        
$mountain_count--;                     
    
}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Blacksmith</title>
</head>
<body align = "center">
<a href = "player_global_state.php">to map</a>
<div style='line-height: 0.7'>
<?
/////drawing sector
    
    ////////////////////////////////////////////////////calk x/y min/max
if((int)($player_x - map_drow_size/2) < 0){
    $x_min = 0;
    $x_max = map_drow_size;
}else if((int)($player_x + map_drow_size/2) > map_scale_max){
    $x_min = map_scale_max - map_drow_size;
    $x_max = map_scale_max;
}else{
    $x_min = (int)($player_x - map_drow_size/2);
    $x_max = (int)($player_x + map_drow_size/2);
}
    
if((int)($player_y - map_drow_size/2) < 0){
    $y_min = 0;
    $y_max = map_drow_size;
}else if((int)($player_y + map_drow_size/2) > map_scale_max){
    $y_min = map_scale_max - map_drow_size;
    $y_max = map_scale_max;
}else{
    $y_min = (int)($player_y - map_drow_size/2);
    $y_max = (int)($player_y + map_drow_size/2);
}
   /////////////////////////////////////////////////////////
    
for($i = $y_min; $i < $y_max; $i++){
    for($j = $x_min; $j < $x_max; $j++){

        $r = $image[$i][$j]['r'];
        $g = $image[$i][$j]['g'];
        $b = $image[$i][$j]['b'];
        
        $image_point = "error";
        
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
        
        
        if($j == $player_x && $i == $player_y){
            echo "<a href = 'map_generator_10000.php?r=".$r."&g=".$g."&b=".$b."'><img src='../../images/player.png' height='14px' width='14px'></a>";
        }else{
            echo "<img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'>";
        }        
    }
    echo "<br>";
}
?>
</div>
</body>
</html>