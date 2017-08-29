<?php
////////////////////////constant
define ("map_drow_size", 90);//map heigt & wind draw
define ("map_scale_max", 100);//pixel map lenght

session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
if($_SESSION['user_id'] == 1){
    echo "<a href='../../database/API/api.php'>ADMIN</a><br>";
}
include ('../../database/database.php');

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

//midle coord
$x = ((int)(($global_x)/1000))%1000;
$y = ((int)(($global_y)/1000))%1000;

$player_x = (int)($global_x % 1000);
$player_y = (int)($global_y % 1000);

$map_seed = (int)($global_x / 1000) + (int)($global_y / 1000);

srand($map_seed);


if(!isset($_GET['msg'])){
    $msg = "";
}else{
    $msg = $_GET['msg'];
}

if(isset($_GET['zone'])){
$_SESSION['zone'] = $_GET['zone'];
}
$zone_main = $_SESSION['zone'];

/////////////////////////////////////////global setting

$mountain_max_hight = rand(5, 15);
$mountain_count = rand(3, 10);
$tree_count = rand(32, 128);
$sity_count = 3;//////////////////
$enemy_camp_count = 6;////////////

/////////////////////create and fill array base color
for($i = 0; $i < map_scale_max; $i++){
    for($j = 0; $j < map_scale_max; $j++){
        
        $image[$j][$i]['zone']= $zone_main;
    }
}

////////////////////////////////////////////////////TREE generation
while($tree_count > 0){    
    
    $i = rand(0, map_scale_max - 1);
    srand($i);
    $j = rand(0, map_scale_max - 1);
    srand($j);     
    
    $first_circle = 64;
                
    $image[$j][$i]['zone'] = "tree";
    
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
        
        $image[$j][$i]['zone']= "tree"; 
        
        srand(rand($j, $i * 1000));        
        
            //fill up around seed 
        if(($i - rand(1, 2)) > 0){                    
                $image[$i - rand(1, 2)][$j]['zone'] = "tree";     
            }
        if(($i + rand(1, 2)) < map_scale_max - 1){                    
                $image[$i + rand(1, 2)][$j]['zone'] = "tree";      
            }
        if(($j - rand(1, 2)) > 0){                    
                $image[$i][$j - rand(1, 2)]['zone'] = "tree";      
            }
        if(($j + rand(1, 2)) < map_scale_max - 1){                    
                $image[$i][$j + rand(1, 2)]['zone'] = "tree";      
            }       
                               
            srand(rand($i, $j + $tree_count));
                    
        $first_circle--;
        
    }
                
$tree_count--;                     
    
}

///////////////////////////////////////////MOUNTAIN generation

switch($zone_main){
            case "flat": $next_zone = "grassland"; break;
            case "grassland": $next_zone = "grass"; break;
        
            case "frosty": $next_zone = "cold_frosty"; break;
            case "cold_frosty": $next_zone = "cold"; break;
        
            case "cold_lava": $next_zone = "lava"; break;
            case "lava": $next_zone = "midle_lava"; break;
        
            case "smal_water": $next_zone = "water"; break;
            case "water": $next_zone = "midle_water"; break;
        
            case "lite_sand": $next_zone = "sand"; break;
            case "sand": $next_zone = "midle_sand"; break;
        
            case "low_mountain": $next_zone = "mountain"; break;
            case "mountain": $next_zone = "midle_mountain"; break;
        
            case "smal_swap": $next_zone = "swap"; break;
            case "swap": $next_zone = "deep_swap"; break;
        }

while($mountain_count > 0){    
    
    $i = rand(0, map_scale_max-1);
    srand($i);
    $j = rand(0, map_scale_max-1);
    srand($j);
                         
    $first_circle = 377 * $mountain_max_hight;
                
    $image[$j][$i]['zone']= $next_zone;
    
    while($first_circle > 0){
        
        $direction = rand(1, 4);
        
        switch($direction){
            case 1: $j -= 1; break;
            case 2: $j += 1;break;
            case 3: $i -= 1;break;
            case 4: $i += 1;break;
        }
        
        //check frame for x
        if($j < 0){
            $j = 0;
        }else if($j > map_scale_max - 1){
            $j = map_scale_max - 1;
        }
        //check frame for y
        if($i < 0){
            $i = 0;
        }else if($i > map_scale_max - 1){
            $i = map_scale_max - 1;
        }
        
        $image[$j][$i]['zone'] = $next_zone; 
        
        srand(rand($i, $j * 1000));
        
        
            //make stronger 
        if(($i - rand(1, $mountain_max_hight)) > 0){                    
                $image[$j - rand(1, $mountain_max_hight)][$i]['zone'] = $next_zone;    
            }
        if(($i + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$j + rand(1, $mountain_max_hight)][$i]['zone'] = $next_zone;     
            }
        if(($j - rand(1, $mountain_max_hight)) > 0){                    
                $image[$j][$i - rand(1, $mountain_max_hight)]['zone'] = $next_zone;     
            }
        if(($j + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$j][$i + rand(1, $mountain_max_hight)]['zone'] = $next_zone;    
            }
            
                   
            srand(rand($j, $i * 50));
            
        
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
<a href="player_global_state.php">to map</a>
<br>
<div style='line-height: 0.7'>
<br>
<?
/////drawing sector
    
///////////////////////////////////////////////////calk x/y min/max for buildig found
$x_min = ((int) ($global_x/1000)) * 1000;
$x_max = ((int) ($global_x/1000)) * 1000 + 99;
$y_min = ((int) ($global_y/1000)) * 1000;
$y_max = ((int) ($global_y/1000)) * 1000 + 99;

$select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` BETWEEN '$x_min' AND '$x_max' AND `y` BETWEEN  '$y_min' AND '$y_max'");    

    while($point = mysql_fetch_array($select)){
        $temp_x = $point['x'] % 1000;
        $temp_y = $point['y'] % 1000;
        $construction[$temp_x][$temp_y] = $point;
    }
//////////////////////////////////////////////////
    
////////////////////////////////////////////////////calk x/y min/max for draw map
if((int)($player_x - map_drow_size / 2) < 0){
    $x_min = 0;
    $x_max = map_drow_size;
}else if((int)($player_x + map_drow_size / 2) > map_scale_max){
    $x_min = map_scale_max - map_drow_size;
    $x_max = map_scale_max;
}else{
    $x_min = (int)($player_x - map_drow_size / 2);
    $x_max = (int)($player_x + map_drow_size / 2);
}
    
if((int)($player_y - map_drow_size / 2) < 0){
    $y_min = 0;
    $y_max = map_drow_size;
}else if((int)($player_y + map_drow_size / 2) > map_scale_max){
    $y_min = map_scale_max - map_drow_size;
    $y_max = map_scale_max;
}else{
    $y_min = (int)($player_y - map_drow_size / 2);
    $y_max = (int)($player_y + map_drow_size / 2);
}
/////////////////////////////////////////////////////////drawing map
    
    $information = "";//clear string for print info at and of map
        
    for($i = $y_min; $i < $y_max; $i++){
        for($j = $x_min; $j < $x_max; $j++){       

            $zone = $image[$j][$i]['zone'];
                    
            if($j == $player_x && $i == $player_y){
                
                $information = "X:".$player_x." Y:".$player_y;
                
                ////////////////draw player
                echo "<img src='../../images/player.gif?".game_ver."' height='14px' width='14px'>";

            }else if(isset($construction[$j][$i])){
                
                /////////////////draw construction
                $image_point = $construction[$j][$i]['name'];

                /////////////if this construction niar player
                if($j == $player_x-1 && $i == $player_y){
                    
                    echo "<a href = 'actions/action.php?side=left'><img src='../../images/construction/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x+1 && $i == $player_y){
                    
                    echo "<a href = 'actions/action.php?side=right'><img src='../../images/construction/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y-1){
                    
                    echo "<a href = 'actions/action.php?side=up'><img src='../../images/construction/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y+1){
                    
                    echo "<a href = 'actions/action.php?side=down'><img src='../../images/construction/".$image_point.".png' height='14px' width='14px'></a>";
                    
                }else{
                    
                    echo "<img src='../../images/construction/".$image_point.".png?".game_ver."' height='14px' width='14px'>";
                }
                
            }else{
                /////////////////draw terrain                    
                
                $image_point = $image[$j][$i]['zone'];        
        
                /////////////if empty niar player
                                
                if($j == $player_x-1 && $i == $player_y){
                    
                    echo "<a href = '../build/build_menu.php?side=left'><img src='../../images/map/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x+1 && $i == $player_y){
                    
                    echo "<a href = '../build/build_menu.php?side=right'><img src='../../images/map/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y-1){
                    
                    echo "<a href = '../build/build_menu.php?side=up'><img src='../../images/map/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y+1){
                    
                    echo "<a href = '../build/build_menu.php?side=down'><img src='../../images/map/".$image_point.".png?".game_ver."' height='14px' width='14px'></a>";
                    
                }else{
                    
                    echo "<img src='../../images/map/".$image_point.".png?".game_ver."' height='14px' width='14px'>";
                }
                
            }      
            
            ///////////////information about construction under player
            if($j == $player_x && $i == $player_y){
                    
                if(isset($construction[$j][$i])){
                    $temp_id = $construction[$j][$i]['master_id'];
                    $select = mysql_query("SELECT * FROM `reg_users` WHERE `id` = '$temp_id'");
                    $temp_name = mysql_fetch_array($select);
                    
                    $information .= "<br>Construction: ".$construction[$j][$i]['name']."<br>Builder: ".$temp_name['user_name']."<br><a href = 'actions/action.php?side=midle'>Actions</a>";
                }
            }
        }   
        
    echo "<br>";
    }
    
?>
<br>
<!-- movement directions -->
<div style = "display: inline"><a href="actions/move_on_map.php?direction=left"><img src="../../images/buttons/left.png"></a></div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=right"><img src="../../images/buttons/right.png"></a> </div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=up"><img src="../../images/buttons/up.png"></a> </div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=down"><img src="../../images/buttons/down.png"></a> </div>
</div>
<div>
    <a href="../player/player_stats.php"><img src="../../images/player.png"></a>
</div>
<div>
<?
    echo $information;
    echo "<br>".$msg;
?>
</div>
</body>
</html>