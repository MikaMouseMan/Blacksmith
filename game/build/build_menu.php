<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
 <a href="../map/map_generator_10000.php">Back</a>
 <br><br>
  <form action="build.php" method = "post">
      <?php
          if(isset($_GET['side'])){

              echo "<input type='hidden' name = 'side' value = '".$_GET['side']."'>";

          }
      ?>
   
    <select name="name">
        <option selected desabled>Choise what build</option>
        <option value="road">Road</option>
        <option value="floor">Floor</option>
        <option value="wall">Wall</option>
        <option value="door">Door</option>
        <option value="chest">Chest</option>
    </select>
    <input type="submit" value = "BUILD">
  </form>
</body>
</html>