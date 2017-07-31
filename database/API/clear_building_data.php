<?php
session_start();
if($_SESSION['user_id'] != 1){
    exit(header("Location: ../../index.php"));
}
include ('../database.php');
mysql_query("TRUNCATE data_buildings_on_map");
header("Location: api.php?msg=All buildig deleted.");
?>