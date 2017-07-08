<?php
    
   // header('Location: login.php?err=Registration is close!')

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <hi>Register new flash</hi>
    <br>
<<<<<<< HEAD
    <br><?=$_GET['err']?>
=======
    <br><?echo $_GET['err']?>
>>>>>>> refs/remotes/origin/master
    <form method = "post" action = "end_registration.php">
        Login: <input type="text" name = "login">
        <br>
        <br>
        Password: <input type="password" name = "password">
        <br>
        <br>
        Visible name: <input type="text" name = "user_name">
        <br>
        <br>
        Mail: <input type="text" name = "user_mail">
        <br>
        <br>
        <input type="submit" value = "Register">
    </form>
    <br>
    <br>
    <a href="login.php">Back</a>
    
</body>
</html>