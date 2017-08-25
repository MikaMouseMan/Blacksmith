<?php

session_start();
if($_SESSION['user_id'] != 1){
    exit(header("Location: ../../index.php"));
}
include ('../database.php');
include('../functions/construct_functions.php');

$user_id = $_SESSION['user_id'];
$global_x = $_SESSION['x'];
$global_y = $_SESSION['y'];

build_environment($global_x + 1, $global_y);
//build_home_empty($global_x - 4, $global_y - 4, $global_x + 4, $global_y + 4, "up", 1);

?>