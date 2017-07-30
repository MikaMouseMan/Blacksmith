<?php
include ('database.php');
mysql_query("TRUNCATE data_buildings_on_map");
header("Location: api.php?msg=All buildig deleted.");
?>