<?
if(!isset($_GET['msg'])){
    $_GET['msg']='';
}
if(!isset($_GET['err'])){
        $_GET['err']='';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <h1>Log in</h1>
    <form method = "post" action = "chek_login.php">
    <br><?echo $_GET['err']?>
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
    <br>Want to delete account? <a href="delete_account.php">DELETE</a>
</body>
</html>