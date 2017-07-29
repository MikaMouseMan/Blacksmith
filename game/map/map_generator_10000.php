<?php
////////////////////////constant
define ("map_drow_size", 10);//map heigt & wind draw
define ("map_scale_max", 100);//pixel map lenght

session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
include ('../../database/database.php');

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

//midle coord
$x = ((int)(($global_x)/1000))%1000;
$y = ((int)(($global_y)/1000))%1000;

if(isset($_GET['r'])){
$_SESSION['color_r'] = $_GET['r'];
$_SESSION['color_g'] = $_GET['g'];
$_SESSION['color_b'] = $_GET['b'];
}
$r_main = $_SESSION['color_r'];
$g_main = $_SESSION['color_g'];
$b_main = $_SESSION['color_b'];

/////////////////////////////////////////global setting

$mountain_max_hight = 5;
$mountain_count = 10;
$sity_count = 3;
$enemy_camp_count = 6;
//if change map will change too default 5 10 3 6 100


/////////////////////create and fill array base color
for($i = 0; $i < map_scale_max; $i++){
    for($j = 0; $j < map_scale_max; $j++){
        
        $image[$i][$j]['r']= $r_main;
        $image[$i][$j]['g']= $g_main;
        $image[$i][$j]['b']= $b_main;
    }
}

$player_x = (int)($global_x % 1000);
$player_y = (int)($global_y % 1000);

$map_seed = $y.$x.$x.$y;

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
        
        //check frame for x
        if($i < 0){
            $i = 0;
        }else if($i > map_scale_max - 1){
            $i = map_scale_max - 1;
        }
        //check frame for y
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

$r_main = $_SESSION['color_r'];
$g_main = $_SESSION['color_g'];
$b_main = $_SESSION['color_b'];
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Blacksmith</title>    
</head>
<body align = "center">
<a href="simple_player_global_state.php">to map</a>

<div style = "display: inline"><a href="move_on_map.php?direction=left">left</a></div>
<div style = "display: inline"><a href="move_on_map.php?direction=right">right</a> </div>
<div style = "display: inline"><a href="move_on_map.php?direction=up">up</a> </div>
<div style = "display: inline"><a href="move_on_map.php?direction=down">down</a> </div>
<a href="../build/build_menu.php">BUILD</a>
<div style='line-height: 0.9'>
<br>
<?
/////drawing sector
    
///////////////////////////////////////////////////calk x/y min/max for buildig found
$x_min = ((int) ($global_x/1000)) * 1000;
$x_max = ((int) ($global_x/1000)) * 1000 + 99;
$y_min = ((int) ($global_y/1000)) * 1000;
$y_max = ((int) ($global_y/1000)) * 1000 + 99;

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` BETWEEN '$x_min' AND '$x_max' AND `y` BETWEEN  '$y_min' AND '$y_max'");

//////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////calk x/y min/max for draw map
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
   /////////////////////////////////////////////////////////drawing map
    
    while($point = mysql_fetch_array($select)){
        $construction[$point['x']][$point['y']]=$point;        
    }           

    for($i = $y_min; $i < $y_max; $i++){
        for($j = $x_min; $j < $x_max; $j++){       

            if($j == $player_x && $i == $player_y){
                
                $information = "X:".$player_x." Y:".$player_y;
                
                ////////////////draw player
                echo "<img src='../../images/player.png' height='14px' width='14px'>";

            }else if(isset($construction[$j][$i])){
                
                    $r = $construction[$j][$i]['color'];
                    $g = $construction[$j][$i]['color'];
                    $b = $construction[$j][$i]['color'];
                echo "<span style = 'background-color: RGB(".$r.", ".$g.", ".$b.")'>&#11036</span>";
                
            }else{
                
                    $r = $image[$i][$j]['r'];
                    $g = $image[$i][$j]['g'];
                    $b = $image[$i][$j]['b']; 
                echo "<span style = 'background-color: RGB(".$r.", ".$g.", ".$b.")'>&#11036</span>";
                
            }            
        }   
        
    echo "<br>";
    }
    
?>
</div>
</body>
</html>