<?php
////////////////////////constant
define ("color_const", 85);// 255/3
define ("map_drow_size", 25);//map heigt & wind draw
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

if(!isset($_GET['msg'])){
    $msg = "";
}else{
    $msg = $_GET['msg'];
}

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
        
        $image[$j][$i]['r']= $r_main;
        $image[$j][$i]['g']= $g_main;
        $image[$j][$i]['b']= $b_main;
    }
}

$player_x = (int)($global_x % 1000);
$player_y = (int)($global_y % 1000);

$map_seed = $y.$x.$x.$y;

srand($map_seed);

///////////////////////////////////////////MOUNTAIN generation

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
    
    $i = rand(0, map_scale_max-1);
    srand($i);
    $j = rand(0, map_scale_max-1);
    srand($j);
                         
    $first_circle = 377 * $mountain_max_hight;
                
    $image[$j][$i]['r']= $r_main;
    $image[$j][$i]['g']= $g_main;
    $image[$j][$i]['b']= $b_main;
    
    while($first_circle>0){
        
        $direction = rand(1,4);
        
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
        
        $image[$j][$i]['r']= $r_main;
        $image[$j][$i]['g']= $g_main;
        $image[$j][$i]['b']= $b_main;  
        
        srand(rand($i, $j * 1000));
        
        
            //make stronger 
        if(($i - rand(1, $mountain_max_hight)) > 0){                    
                $image[$j - rand(1, $mountain_max_hight)][$i]['r']= $r_main;
                $image[$j - rand(1, $mountain_max_hight)][$i]['g']= $g_main;
                $image[$j - rand(1, $mountain_max_hight)][$i]['b']= $b_main;      
            }
        if(($i + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$j + rand(1, $mountain_max_hight)][$i]['r']= $r_main;
                $image[$j + rand(1, $mountain_max_hight)][$i]['g']= $g_main;
                $image[$j + rand(1, $mountain_max_hight)][$i]['b']= $b_main;      
            }
        if(($j - rand(1, $mountain_max_hight)) > 0){                    
                $image[$j][$i - rand(1, $mountain_max_hight)]['r']= $r_main;
                $image[$j][$i - rand(1, $mountain_max_hight)]['g']= $g_main;
                $image[$j][$i - rand(1, $mountain_max_hight)]['b']= $b_main;      
            }
        if(($j + rand(1, $mountain_max_hight)) < map_scale_max - 1){                    
                $image[$j][$i + rand(1, $mountain_max_hight)]['r']= $r_main;
                $image[$j][$i + rand(1, $mountain_max_hight)]['g']= $g_main;
                $image[$j][$i + rand(1, $mountain_max_hight)]['b']= $b_main;      
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
        $construction[$temp_x][$temp_y]=$point;
    }
//////////////////////////////////////////////////
    
////////////////////////////////////////////////////calk x/y min/max for draw map
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
/////////////////////////////////////////////////////////drawing map
    
    $information = "";//clear string for print info at and of map
    
    $coef_l = 0;    $coef_r = 0;    $coef_u = 0;    $coef_d = 0;///////////coef for hard calc
    
    for($i = $y_min; $i < $y_max; $i++){
        for($j = $x_min; $j < $x_max; $j++){       

            $r = $image[$j][$i]['r'];
            $g = $image[$j][$i]['g'];
            $b = $image[$j][$i]['b'];
            
            if($r == 0){
                if($g == 0){
                    $coef = $b;////////////////////////////only blue
                }else{
                    if($b == 0){
                        $coef = $g;////////////////////////only green
                    }
                    $coef = (int)(($g + $b) / 2);////////////////////////green blue
                }
            }else{
                if($g == 0){
                    if($b == 0){
                        $coef = $g;////////////////////////only red
                    }
                    $coef = (int)(($r + $b) / 2);////////////////////////red blue
                }else{
                    if($b == 0){
                        $coef = (int)(($r + $g) / 2);////////////////////red green
                    }
                    $coef = (int)(($r + $g + $b) / 3);////////////////////////all colors
                }
            }           
            
            if($j == $player_x && $i == $player_y){
                
                $information = "X:".$player_x." Y:".$player_y;
                
                ////////////////draw player
                echo "<img src='../../images/player.gif' height='14px' width='14px'>";

            }else if(isset($construction[$j][$i])){
                
                /////////////////draw construction
                $image_point = $construction[$j][$i]['name'];

                /////////////if this construction niar player
                if($j == $player_x-1 && $i == $player_y){
                    
                    echo "<a href = 'actions/action.php?side=left'><img src='../../images/construction/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x+1 && $i == $player_y){
                    
                    echo "<a href = 'actions/action.php?side=right'><img src='../../images/construction/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y-1){
                    
                    echo "<a href = 'actions/action.php?side=up'><img src='../../images/construction/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    
                }else if($j == $player_x && $i == $player_y+1){
                    
                    echo "<a href = 'actions/action.php?side=down'><img src='../../images/construction/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    
                }else{
                    
                    echo "<img src='../../images/construction/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'>";
                }
                
            }else{
                /////////////////draw terrain                    
                
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
        
                /////////////if empty niar player
                                
                if($j == $player_x-1 && $i == $player_y){
                    
                    echo "<a href = '../build/build_menu.php?side=left&coef=$coef'><img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    $coef_l = $coef;
                    
                }else if($j == $player_x+1 && $i == $player_y){
                    
                    echo "<a href = '../build/build_menu.php?side=right&coef=$coef'><img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    $coef_r = $coef;
                    
                }else if($j == $player_x && $i == $player_y-1){
                    
                    echo "<a href = '../build/build_menu.php?side=up&coef=$coef'><img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    $coef_u = $coef;
                    
                }else if($j == $player_x && $i == $player_y+1){
                    
                    echo "<a href = '../build/build_menu.php?side=down&coef=$coef'><img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'></a>";
                    $coef_d = $coef;
                    
                }else{
                    
                    echo "<img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'>";
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
<div style = "display: inline"><a href="actions/move_on_map.php?direction=left&coef=<?=$coef_l?>"><img src="../../images/buttons/left.png"></a></div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=right&coef=<?=$coef_r?>"><img src="../../images/buttons/right.png"></a> </div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=up&coef=<?=$coef_u?>"><img src="../../images/buttons/up.png"></a> </div>
<div style = "display: inline"><a href="actions/move_on_map.php?direction=down&coef=<?=$coef_d?>"><img src="../../images/buttons/down.png"></a> </div>
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