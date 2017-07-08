<?php
    
    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../../index.php'));
    }
    include("../../database/database.php");
    $user_name = $_SESSION['user_name'];
    $form_user = "user_$user_name";
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> origin/Blacksmith_Lucas

    if(!isset($_GET['msg'])){
        $_GET['msg']='';
    }
    if(!isset($_GET['err'])){
            $_GET['err']='';
    }
    if(!isset($_GET['craft'])){
            $_GET['craft']='';
    }
    
<<<<<<< HEAD
>>>>>>> refs/remotes/origin/master
=======
>>>>>>> origin/Blacksmith_Lucas
    
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
<<<<<<< HEAD
<<<<<<< HEAD
    <div> 
=======
>>>>>>> refs/remotes/origin/master
=======
>>>>>>> origin/Blacksmith_Lucas
    <?
        while ($item=mysql_fetch_array($answer)){
            
            if($item['item_count']!=0){
                
                if($_GET['craft']=='resurse1'){
                    $to_1st = "<a href='../craft/craft_material.php?resurse1=".$item['cell_id']."'>"."<img src='../../images/grab.jpg' height = '20' width = '20'></a>";
                    
                }else if($_GET['craft']=='material1'){
                    $to_1st = "<a href='../craft/craft_component.php?material1=".$item['cell_id']."'>"."<img src='../../images/grab.jpg' height = '20' width = '20'></a>";
<<<<<<< HEAD
                    
<<<<<<< HEAD
                }else{unset($to_1st);}
=======
                }else{$to_1st="";}
>>>>>>> refs/remotes/origin/master
=======
                
                }else{$to_1st="";}
>>>>>>> origin/Blacksmith_Lucas
                
                if($_GET['craft']=='resurse2'){
                    $to_2nd = "<a href='../craft/craft_material.php?resurse2=".$item['cell_id']."'>"."<img src='../../images/grab.jpg' height = '20' width = '20'></a>";
                    
                }else if($_GET['craft']=='material2'){
                    $to_2nd = "<a href='../craft/craft_component.php?material2=".$item['cell_id']."'>"."<img src='../../images/grab.jpg' height = '20' width = '20'></a>";
                    
<<<<<<< HEAD
<<<<<<< HEAD
                }else{unset($to_2nd);}
=======
                }else{$to_2nd = "";}
>>>>>>> refs/remotes/origin/master
=======
                }else{$to_2nd = "";}
>>>>>>> origin/Blacksmith_Lucas
                    
                 echo /*"N:".$item['cell_id'].*/"Name: ".$item['item_name']."<br>Count: ".$item['item_count']."<br>Coef= ".$item['item_coef']."<br>Struct: ".$item['item_structure']." <img src='../images/".$item['item_type']."/".$item['item_image']."' height = '20' width = '20'><a href='clear_cell.php?id=".$item['cell_id']."'><img src='../../images/delete_items.jpg' height = '20' width = '20'></a>".$to_1st.$to_2nd."<br><br>";
                
            }
            
        }
        
    ?>
<<<<<<< HEAD
<<<<<<< HEAD
    </div>
=======
    
>>>>>>> refs/remotes/origin/master
=======
>>>>>>> origin/Blacksmith_Lucas
</body>
</html>