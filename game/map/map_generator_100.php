<?php

//global setting
//
$mountain_max_hight = 15;
$mountain_count = 5;
$sity_count = 3;
$enemy_camp_count = 6;


$x = $_GET['x'];
$y = $_GET['y'];
$map_seed = (int) $x.$y;

srand($map_seed);

include ('../../database/database.php');

$select = mysql_query("SELECT * FROM `data_temp_map` WHERE `x` = '$x' AND `y` = '$y'");
$map_seed = mysql_fetch_array($select);

$r_main = $map_seed['r'];
$g_main = $map_seed['g'];
$b_main = $map_seed['b'];

$im = imagecreate(100,100);
$bgc = imagecolorallocate($im,$r_main,$g_main,$b_main);

while($mountain_count>0){
    
    
    $draw_x = rand(0,99);
    srand($draw_x);
    
    $draw_y = rand(0,99);
    srand($draw_y);
    
    $bgc = imagecolorallocate($im,$r_main/$mountain_max_hight,$g_main/$mountain_max_hight,$b_main/$mountain_max_hight);
    
    $mountain['$mountain_count']['x']=$draw_x;
    $mountain['$mountain_count']['y']=$draw_y;
                         
    $first_circle = 10*$mountain_max_hight;
    
    $second_circle = 5*$mountain_max_hight;
    
    if($draw_x-$mountain_max_hight<0){
        $mountain['$mountain_count']['x'] = $mountain_max_hight;
    }
    if($draw_y-$mountain_max_hight<0){
        $mountain['$mountain_count']['y'] = $mountain_max_hight;
    }
    if($draw_x+$mountain_max_hight>99){
        $mountain['$mountain_count']['x'] = 99-$mountain_max_hight;
    }
    if($draw_y+$mountain_max_hight>99){
        $mountain['$mountain_count']['y'] = 99-$mountain_max_hight;
    }
    
    imagesetpixel($im,$mountain['$mountain_count']['x'],$mountain['$mountain_count']['y'],$bgc);
    
    while($first_circle>0){
        
        imagesetpixel($im,rand($mountain['$mountain_count']['x']-$mountain_max_hight,$mountain['$mountain_count']['x']+$mountain_max_hight),rand($mountain['$mountain_count']['y']-$mountain_max_hight,$mountain['$mountain_count']['y']+$mountain_max_hight),$bgc);
        $first_circle--;
        srand($first_circle+$mountain['$mountain_count']['x']);
    }
    
    
$mountain_count--;                     
    
}
imagepng ($im, 'test.png');
echo "END";
?>