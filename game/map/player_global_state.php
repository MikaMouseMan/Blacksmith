<?php

//constants
define ("color_const", 64);// 255/3 = 85 255/4=64
define ("map_drow_size", 25);//map heigt & wind draw

$size = getimagesize ("../../database/map_core.png");
$map_x_max = $size[0];
$map_y_max = $size[1];

session_start();
if(!$_SESSION['user_name']){
    exit(header('Location: ../../index.php'));
}
if($_SESSION['user_id'] == 1){
    echo "<a href='../../database/API/api.php'>ADMIN</a>";
}
include("../../database/database.php");
$user_name = $_SESSION['user_name'];
$form_user = "user_$user_name";

$select = mysql_query("SELECT * FROM `$form_user` WHERE `cell_id` = '1001'");
$player_coord = mysql_fetch_array($select);

$_SESSION['x'] = $player_coord['health'];
$_SESSION['y'] = $player_coord['health_max'];

$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

if($global_x < 0){
    mysql_query("UPDATE `$form_user` SET `health` = '0' WHERE `$form_user`.`cell_id` = 1001;");
    $_SESSION['x'] = 0;
}else if($global_x > 512099099){
    mysql_query("UPDATE `$form_user` SET `health` = '512099099' WHERE `$form_user`.`cell_id` = 1001;");
    $_SESSION['x'] = 512099099;
}

if($global_y < 0){
    mysql_query("UPDATE `$form_user` SET `health_max` = '0' WHERE `$form_user`.`cell_id` = 1001;");
    $_SESSION['y'] = 0;
}else if($global_y > 512099099){
    mysql_query("UPDATE `$form_user` SET `health_max` = '512099099' WHERE `$form_user`.`cell_id` = 1001;");
    $_SESSION['y'] = 512099099;
}


$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

$player_x = (int)($global_x / 1000000);
$player_y = (int)($global_y / 1000000);


////////////////x draw diapozone
if((int)($player_x - map_drow_size/2) < 0){
    $x_min = 0;
    $x_max = map_drow_size;
}else if((int)($player_x + map_drow_size/2) > $map_x_max){
    $x_min = $map_x_max - map_drow_size;
    $x_max = $map_x_max;
}else{
    $x_min = (int)($player_x - map_drow_size/2);
    $x_max = (int)($player_x + map_drow_size/2);
}
    
////////////////y draw diapozone
if((int)($player_y - map_drow_size/2) < 0){
    $y_min = 0;
    $y_max = map_drow_size;
}else if((int)($player_y + map_drow_size/2) > $map_y_max){
    $y_min = $map_y_max - map_drow_size;
    $y_max = $map_y_max;
}else{
    $y_min = (int)($player_y - map_drow_size/2);
    $y_max = (int)($player_y + map_drow_size/2);
}

////////////////////select from DB to memory all drawing diapozone
$select = mysql_query("SELECT * FROM `data_map` WHERE `x` BETWEEN '$x_min' AND '$x_max' AND `y` BETWEEN '$y_min' AND '$y_max'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body align = "center">
    <div>
    <a href="../exit.php">EXIT</a>
    </div>
    <div style='line-height: 0.7'>
    <?
    //////////////////drawing map
    while($point = mysql_fetch_array($select)){

        $r = $point['r'];
        $g = $point['g'];
        $b = $point['b'];                
            
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
                }
                
            }else if($g > color_const * 2 && $g < color_const * 3 + 1){
                if($b == 0){
                    $image_point = "grassland";//////////////green pure  
                }
                
            }else if($g > color_const && $g < color_const * 2 + 1){
                if($b == 0){
                    $image_point = "grass";//////////////green pure
                }
                
            }else if($g < color_const+1){
                if($b == 0){    
                    $image_point = "hils";//////////////green pure
                }
            }
            
        }else if($r > color_const * 3){ 
            if($g == 0){
                if($b == 0){
                    $image_point = "cold_lava"; //////////////red pure                                
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
                }
                
            }else if($g < color_const + 1){
                if($b == 0){    
                    $image_point = "hard_sand";//////////////yelloy pure
                    
                }else if($b < color_const + 1){
                    $image_point = "high_mountain"; //////////////gray pure                               
                }
            }
        }
        
        if($point['x'] == $player_x && $point['y'] == $player_y){
            echo "<a href = 'map_generator_100.php'><img src='../../images/player.png' height='14px' width='14px'></a>";
        }else{
            echo "<img src='../../images/map/".$image_point.".png?".$r.$g.$b."' height='14px' width='14px'>";
        }
        if($point['x']>$x_max-1){
            echo "<br>";
        }

    }
    ?>
    </div>
</body>
</html>