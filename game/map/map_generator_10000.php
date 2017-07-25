<?php
session_start();
include ('../../database/database.php');

$x = $_GET['x'];
$y = $_GET['y'];

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1001'");
$player_coord = mysql_fetch_array($select);

$r_main = $_GET['r'];
$g_main = $_GET['g'];
$b_main = $_GET['b'];

//global setting
//
$mountain_max_hight = 5;
$mountain_count = 10;
$sity_count = 3;
$enemy_camp_count = 6;
$image_size = 100;

/////////////////////create and fill array base color
for($i = 0; $i < $image_size; $i++){
    for($j = 0; $j < $image_size; $j++){
        
        $image[$i][$j]['r']= $r_main;
        $image[$i][$j]['g']= $g_main;
        $image[$i][$j]['b']= $b_main;
    }
}

$player_x = (int)($player_coord['health']%1000);
$player_y = (int)($player_coord['health_max']%1000);

if($x != (int)(($player_coord['health']%1000000)/1000)){
    $player_x = 101;
}
if($y != (int)(($player_coord['health_max']%1000000)/1000)){
    $player_y = 101;
}

$map_seed = (int) $y.$x.$y;

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
    
    $i = rand(0, $image_size-1);
    srand($i);
    $j = rand(0, $image_size-1);
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
        }else if($i > $image_size - 1){
            $i = $image_size - 1;
        }
        //check frame for y
        if($j < 0){
            $j = 0;
        }else if($j > $image_size - 1){
            $j = $image_size - 1;
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
        if(($i + rand(1, $mountain_max_hight)) < $image_size - 1){                    
                $image[$i + rand(1, $mountain_max_hight)][$j]['r']= $r_main;
                $image[$i + rand(1, $mountain_max_hight)][$j]['g']= $g_main;
                $image[$i + rand(1, $mountain_max_hight)][$j]['b']= $b_main;      
            }
        if(($j - rand(1, $mountain_max_hight)) > 0){                    
                $image[$i][$j - rand(1, $mountain_max_hight)]['r']= $r_main;
                $image[$i][$j - rand(1, $mountain_max_hight)]['g']= $g_main;
                $image[$i][$j - rand(1, $mountain_max_hight)]['b']= $b_main;      
            }
        if(($j + rand(1, $mountain_max_hight)) < $image_size - 1){                    
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
    <link rel="stylesheet" href="../../style/blacksmith.css">
</head>

<style>
    @keyframes state_1{
      from { background-color: RGB(0,0,0);}
      to  {background-color: RGB(255,255,255);}
    }
</style>

<body align = "center" >
<a href="simple_player_global_state.php">to map</a>
<div style = "font-size: 10px">
<?
/////drawing sector

for($i = 0; $i < $image_size; $i++){
    for($j = 0; $j < $image_size; $j++){

        $r = $image[$i][$j]['r'];
        $g = $image[$i][$j]['g'];
        $b = $image[$i][$j]['b'];
        
        if($j == $player_x && $i == $player_y){
            echo "<a style = 'animation: state_1 2s infinite'>&#8195</a>";
        }else{
            echo "<a style = 'background-color: RGB(".$r.", ".$g.", ".$b.")'>&#8195</a>";
        }        
    }
    echo "<br>";
}
?>
</div>
</body>
</html>