<?php
if(!isset($_GET['msg'])){
    $msg = "";
}else {
    $msg = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
 
<?php
    if(!isset($_GET['floor'])){ 
    echo "<a href='../map/map_generator_10000.php'>Back</a><br><br>";
    echo "<form action='build.php' method = 'post'>";
          if(isset($_GET['side'])){

              echo "<input type='hidden' name = 'side' value = '".$_GET['side']."'>";

          }
      
   
    echo "<select name='name'>
        <option value='road'>Road</option>
        <option value='floor'>Floor</option>
        <option value='wall'>Wall</option>
        <option value='door'>Door</option>
        <option value='chest'>Chest</option>
        </select>
        <input type='submit' value = 'BUILD'>
      </form>";
    }else{
        echo "<a href='../map/map_generator_10000.php'>Back</a><br><br>";
        
        echo "<form action='build.php' method = 'post'>
            <select name='name'>
            <option value='chest'>Chest</option>
            </select>
            <input type='submit' value = 'BUILD'>
         </form>";
    }
?>
  <br>
  <br>
  <br><?=$msg?>
</body>
</html>