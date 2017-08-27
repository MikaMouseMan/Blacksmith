<?php
//constant
define ("map_drow_size", 90);//map heigt & wind draw
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

$zone_main = $map_start_point['zone'];

/////////////////////create and fill array base color
for($i = 0; $i < map_scale_max; $i++){
    for($j = 0; $j < map_scale_max; $j++){
        
        $image[$j][$i]['zone']= $zone_main;
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
    

$map_seed = $x.$y;

srand($map_seed);

//generation setting
//
$harder_spot_randge = rand(5, 15);
$harder_spot_count = rand(3, 10);
$lake_count = rand(2, 6);
$mount_hight = rand(4, 15);
$mount_count = rand(1, 10);

switch($zone_main){
            case "flat": $next_zone = "grassland"; break;
            case "grassland": $next_zone = "grass"; break;
            case "grass": $next_zone = "hils"; break;
        
            case "frosty": $next_zone = "cold_frosty"; break;
            case "cold_frosty": $next_zone = "cold"; break;
            case "cold": $next_zone = "very_cold"; break;
        
            case "cold_lava": $next_zone = "lava"; break;
            case "lava": $next_zone = "midle_lava"; break;
            case "midle_lava": $next_zone = "hot_lava"; break;
        
            case "smal_water": $next_zone = "water"; break;
            case "water": $next_zone = "midle_water"; break;
            case "midle_water": $next_zone = "deep_water"; break;
        
            case "lite_sand": $next_zone = "sand"; break;
            case "sand": $next_zone = "midle_sand"; break;
            case "midle_sand": $next_zone = "hard_sand"; break;
        
            case "low_mountain": $next_zone = "mountain"; break;
            case "mountain": $next_zone = "midle_mountain"; break;
            case "midle_mountain": $next_zone = "hight_mountain"; break;
        
            case "smal_swap": $next_zone = "swap"; break;
            case "swap": $next_zone = "deep_swap"; break;
            case "deep_swap": $next_zone = "death_swap"; break;
        }

///////////////////////////////////////////HARDER zone generation

while($harder_spot_count > 0){    
    
    $i = rand(0, map_scale_max - 1);
    srand($i);
    $j = rand(0, map_scale_max - 1);
    srand($j);
                         
    $first_circle = 128 * $harder_spot_randge;
                
    $image[$j][$i]['zone'] = $next_zone;
    
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
        
        $image[$j][$i]['zone']= $next_zone; 
        
        srand(rand($j, $i * 1000));
        
        
            //fill up around seed 
        if(($i - rand(1, $harder_spot_randge)) > 0){                    
                $image[$i - rand(1, $harder_spot_randge)][$j]['zone'] = $next_zone;     
            }
        if(($i + rand(1, $harder_spot_randge)) < map_scale_max - 1){                    
                $image[$i + rand(1, $harder_spot_randge)][$j]['zone'] = $next_zone;      
            }
        if(($j - rand(1, $harder_spot_randge)) > 0){                    
                $image[$i][$j - rand(1, $harder_spot_randge)]['zone'] = $next_zone;      
            }
        if(($j + rand(1, $harder_spot_randge)) < map_scale_max - 1){                    
                $image[$i][$j + rand(1, $harder_spot_randge)]['zone'] = $next_zone;      
            }
                               
            srand(rand($i, $j * 50));
                    
        $first_circle--;
        
    }
        
$harder_spot_count--;                     
    
}

///////////////////////////////////////////LAKE zone

while($lake_count > 0){    
    
    $i = rand(0, map_scale_max - 1);
    srand($i);
    $j = rand(0, map_scale_max - 1);
    srand($j);     
    
    $first_circle = 64;
                
    $image[$j][$i]['zone'] = "smal_water";
    
    while($first_circle > 0){
        
        $direction = rand(1,4);
        
        switch($direction){
            case 1: $i -= 1; break;
            case 2: $i += 1; break;
            case 3: $j -= 1; break;
            case 4: $j += 1; break;
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
        
        $image[$j][$i]['zone']= "smal_water"; 
        
        srand(rand($j, $i * 1000));        
        
            //fill up around seed 
        if(($i - rand(1, 2)) > 0){                    
                $image[$i - rand(1, 2)][$j]['zone'] = "smal_water";     
            }
        if(($i + rand(1, 2)) < map_scale_max - 1){                    
                $image[$i + rand(1, 2)][$j]['zone'] = "smal_water";      
            }
        if(($j - rand(1, 2)) > 0){                    
                $image[$i][$j - rand(1, 2)]['zone'] = "smal_water";      
            }
        if(($j + rand(1, 2)) < map_scale_max - 1){                    
                $image[$i][$j + rand(1, 2)]['zone'] = "smal_water";      
            }       
                               
            srand(rand($i, $j * 50));
                    
        $first_circle--;
        
    }
                
$lake_count--;                     
    
}

///////////////////////////////////////////MOUNTAIN zone generation

while($mount_count > 0){    
    
    $i = rand(0, map_scale_max - 1);
    srand($i);
    $j = rand(0, map_scale_max - 1);
    srand($j);     
    
    $first_circle = 64 * $mount_hight;
                
    $image[$j][$i]['zone'] = "low_mountain";
    
    while($first_circle > 0){
        
        $direction = rand(1,4);
        
        switch($direction){
            case 1: $i -= 1; break;
            case 2: $i += 1; break;
            case 3: $j -= 1; break;
            case 4: $j += 1; break;
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
        
        $image[$j][$i]['zone']= "low_mountain"; 
        
        srand(rand($j, $i * 1000));        
        
            //fill up around seed 
        if(($i - rand(1, $mount_hight)) > 0){                    
                $image[$i - rand(1, $mount_hight)][$j]['zone'] = "low_mountain";     
            }
        if(($i + rand(1, $mount_hight)) < map_scale_max - 1){                    
                $image[$i + rand(1, $mount_hight)][$j]['zone'] = "low_mountain";      
            }
        if(($j - rand(1, $mount_hight)) > 0){                    
                $image[$i][$j - rand(1, $mount_hight)]['zone'] = "low_mountain";      
            }
        if(($j + rand(1, $mount_hight)) < map_scale_max - 1){                    
                $image[$i][$j + rand(1, $mount_hight)]['zone'] = "low_mountain";      
            }       
                               
            srand(rand($i, $j * 50));
                    
        $first_circle--;
        
    }
                
$mount_count--;                     
    
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
        
        $image_point = $image[$j][$i]['zone'];        
        
        if($j == $player_x && $i == $player_y){
            echo "<a href = 'map_generator_10000.php?zone=".$image_point."'><img src='../../images/player.gif' height='14px' width='14px'></a>";
        }else{
            echo "<img src='../../images/map/".$image_point.".png' height='14px' width='14px'>";
        }        
    }
    echo "<br>";
}
?>
</div>
</body>
</html>