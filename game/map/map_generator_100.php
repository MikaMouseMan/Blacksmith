<?php
//constant
define ("map_drow_size", 10);//map heigt & wind draw
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

$mix_color = (int)(($r_main + $g_main + $b_main)/4);

if($r_main >= $g_main && $r_main >= $b_main){
    $r_main = $mix_color;
}else if($g_main >= $r_main && $g_main >= $b_main){
    $g_main = $mix_color;
}else if($b_main >= $r_main && $b_main >= $g_main){
    $b_main = $mix_color;
}else{echo "!";}
while($mountain_count > 0){    
    
    $i = rand(0, map_scale_max-1);
    srand($i);
    $j = rand(0, map_scale_max-1);
    srand($j);
                         
    $first_circle = 377 * $mountain_max_hight;
                
    $image[$i][$j]['r']= $r_main;
    $image[$i][$j]['g']= $g_main;
    $image[$i][$j]['b']= $b_main;
    
    while($first_circle>0){
        
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
<a href = "simple_player_global_state.php">to map</a>
<div style='line-height: 0.9'>
<?
/////drawing sector
    
    ////////////////////////////////////////////////////calk x/y min/max
if($player_x - map_drow_size < 0){
    $x_min = 0;
}else{
    $x_min = $player_x - map_drow_size;
}
if($player_x + map_drow_size > map_scale_max){
    $x_max = map_scale_max;
}else{
    $x_max = $player_x + map_drow_size;
}
    
if($player_y - map_drow_size < 0){
    $y_min = 0;
}else{
    $y_min = $player_y - map_drow_size;
}
if($player_y + map_drow_size > map_scale_max){
    $y_max = map_scale_max;
}else{
    $y_max = $player_y + map_drow_size;
}
   /////////////////////////////////////////////////////////
    
for($i = $y_min; $i < $y_max; $i++){
    for($j = $x_min; $j < $x_max; $j++){

        $r = $image[$i][$j]['r'];
        $g = $image[$i][$j]['g'];
        $b = $image[$i][$j]['b'];
        
        if($j == $player_x && $i == $player_y){
            echo "<a href = 'map_generator_10000.php?r=".$r."&g=".$g."&b=".$b."'><img src='../../images/player.png' height='14px' width='14px'></a>";
        }else{
            echo "<span style = 'background-color: RGB(".$r.", ".$g.", ".$b.")'>&#11036</span>";
        }        
    }
    echo "<br>";
}
?>
</div>
</body>
</html>