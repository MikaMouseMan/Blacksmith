<<<<<<< HEAD
=======
<?
if(!isset($_GET['msg'])){
    $_GET['msg']='';
}
if(!isset($_GET['err'])){
        $_GET['err']='';
}
?>
>>>>>>> refs/remotes/origin/master
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <h1>Log in</h1>
    <form method = "post" action = "chek_login.php">
<<<<<<< HEAD
    <br><?=$_GET[err]?>
=======
    <br><?echo $_GET['err']?>
>>>>>>> refs/remotes/origin/master
    <br>
    Login: <input type="text" name = "login">
    <br>
    <br>
    Password: <input type="password" name = "password">
    <br>
    <br>
    <input type="submit" value = "Chek">
    </form>
    Dont have account? <a href="registration.php">Registration</a>
</body>
</html>