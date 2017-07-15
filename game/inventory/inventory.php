<?php
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    include("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";


    if(!isset($_GET['msg'])){
        $_GET['msg']='';
    }
    if(!isset($_GET['err'])){
            $_GET['err']='';
    }
    
    $answer = mysql_query("SELECT * FROM `$form_user`");
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href='../home/blacksmith_home.php'>Back</a>
    <br>
    <br><?=$_GET['msg']?><?=$_GET['err']?>
    <br>
    <br>
    <?
        while ($item = mysql_fetch_array($answer)){
                        
            if($item['item_count']!=0 and $item['cell_id']<1000){
                                
                 echo "Name: ".$item['item_name']." Type: ".$item['item_type']."<br>Count: ".$item['item_count']." Coef: ".$item['item_coef']."<br>Struct: ".$item['item_structure'];
                if($item['health'] != '0'){
                    echo "<br>Health ".$item['health']."/".$item['health_max'];
                }
                echo " <img src='../../images/".$item['item_type']."/".$item['item_name'].".png"."' height = '20' width = '20'><a href='clear_cell.php?id=".$item['cell_id']."'><img src='../../images/buttons/delete_items.png' height = '20' width = '20'></a><br><br>";                
                
            }
            
        }
        
    ?>

</body>
</html>