<?php

    session_start();
    if(!$_SESSION['user_name']){
        exit(header('Location: ../index.php'));
    }
    $_SESSION = array();
    session_destroy();
    header('Location: ../index.php');
?>