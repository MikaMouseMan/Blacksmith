<?php

$im = imagecreatefrompng("test_image.png");

for($i=0;$i<100;$i++){
    for($j=0;$j<100;$j++){
        $rgb = imagecolorat($im, $i, $j);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        
        $temp_im = imagecreate(1,1);
        $bgc = imagecolorallocate ($temp_im, $r, $g, $b);
        imagesetpixel ( $temp_im , 0 , 0 , $bgc );
        if($r > $g && $r > $b){
            $color="red";
        }else if ($g > $b && $g > $r){
            $color="green";
        }else{$color="blue";}
        echo "<smal style='line-height: 0.5'><a href='?color=`".$color."`' style='background-color: RGB(".$r.",".$g.",".$b.")'>&nbsp&nbsp</a></smal>";
    }   
    echo "<br>";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div><?=$_GET['color']?></div>
</body>
</html>