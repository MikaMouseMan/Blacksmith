<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Blacksmith</title>
</head>
<body>
    <a href = "login.php">Back</a>
    <br>
    <br>Enter login, password to delete you account.
    <form action = "delete_account_check.php" method = "post">
        <input type = "text" name = "user_name">
        <br><input type = "password" name = "user_password">
        <br>
        <br><input type = "submit" value = "DELETE">
    </form>
</body>
</html>