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
    if(!isset($_GET['craft'])){
            $_GET['craft']='';
    }
    
    
    if($_GET['craft']=='resurse1'||$_GET['craft']=='resurse2'){
        
        $answer = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'resurse'");
        
    }else if($_GET['craft']=='material1'||$_GET['craft']=='material2'){
        
        $answer = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'material'");
        
    }else if($_GET['craft']=='component1'||$_GET['craft']=='component2'){
        
        $answer = mysql_query("SELECT * FROM `$form_user` WHERE `item_type` LIKE 'component'");
        
    }else $answer = mysql_query("SELECT * FROM `$form_user`");
    
    
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href='../main_menu.php'>Back</a>
    <br>
    <br><?=$_GET['msg']?><?=$_GET['err']?>
    <br>
    <br>
    <?
        while ($item=mysql_fetch_array($answer)){
            
            if($item['item_count']!=0){
                                
                 echo "Name: ".$item['item_name']."<br>Count: ".$item['item_count']."<br>Coef= ".$item['item_coef']."<br>Struct: ".$item['item_structure']." <img src='../../images/".$item['item_type']."/".$item['item_name'].".png"."' height = '20' width = '20'><a href='clear_cell.php?id=".$item['cell_id']."'><img src='../../images/buttons/delete_items.png' height = '20' width = '20'></a><br><br>";
                
            }
            
        }
        
    ?>

</body>
</html>