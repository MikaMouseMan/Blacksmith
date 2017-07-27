<?php
session_start();
include ('../../database/database.php');

$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1001'");
$player_coord = mysql_fetch_array($select);

if(isset($_GET['r'])){
$_SESSION['color_r'] = $_GET['r'];
$_SESSION['color_g'] = $_GET['g'];
$_SESSION['color_b'] = $_GET['b'];
}
$r_main = $_SESSION['color_r'];
$g_main = $_SESSION['color_g'];
$b_main = $_SESSION['color_b'];

/////////////////////////////////////////global setting

//global setting
//
$mountain_max_hight = 5;
$mountain_count = 10;
$sity_count = 3;
$enemy_camp_count = 6;
$image_size = 100;
//if change map will change too default 5 10 3 6 100


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

<style>
    @keyframes state_1{
      from { background-color: RGB(0,0,0);}
      to  {background-color: RGB(255,255,255);}
    }
</style>

<body>
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