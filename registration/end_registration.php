<?php
///////////start coord global
define("start_coord_x", 10010024);
define("start_coord_y", 10010024);

if($_POST['login']!=""){
    $login = base64_encode($_POST['login']);
}else{
    exit (header('Location: registration.php?err=Empty login'));
};

if($_POST['password'] != ""){
    $password = base64_encode($_POST['password']);
}else {
    exit (header('Location: registration.php?err=Empty password'));
};

if($_POST['user_name'] != ""){
    $user_name = $_POST['user_name'];
}else {
    exit (header('Location: registration.php?err=Empty name'));
};

if($_POST['user_mail'] != ""){
    $user_mail = $_POST['user_mail'];
}else {
    exit (header('Location: registration.php?err=Empty mail'));
};

include('../database/database.php');

$answer = mysql_query("SELECT `id` FROM `reg_users` WHERE `login` = '$login'",$dblink);
$selected_user = mysql_fetch_array($answer);

if(isset($selected_user['id'])){
    exit(header('Location: registration.php?err=Login already use'));
}else {

    $date_reg = date(c);

    //add user to database
    mysql_query("INSERT INTO `reg_users` (`id`, `login`, `password`,`user_name`,`user_mail`,`date_reg`,`date_last`,`inventory_size`) VALUES (NULL, '$login', '$password','$user_name','$user_mail','$date_reg','$date_last','20')");

    $form_name = "user_$user_name";

    //create user database
    mysql_query("CREATE TABLE `$form_name` ( `cell_id` INT NOT NULL ,  `item_name` VARCHAR(255) NOT NULL ,  `item_count` INT NOT NULL , `item_coef` INT NOT NULL ,  `item_type` VARCHAR(255) NOT NULL ,  `item_structure` VARCHAR(255) NOT NULL , `health` INT NOT NULL ,  `health_max` INT NOT NULL , UNIQUE  (`cell_id`)) ENGINE = InnoDB");

    //create empty inventory slots
    for($i = 1; $i <= 20; $i++){
        mysql_query("INSERT INTO `$form_name` (`cell_id`, `item_name`, `item_count`, `item_coef`, `item_type`, `item_structure`, `health`, `health_max`) VALUES ('$i', '', '', '', '', '', '', '')");
    }

    //Create body slots
    mysql_query("INSERT INTO `$form_name` (`cell_id`, `item_name`, `item_count`, `item_coef`, `item_type`, `item_structure`, `health`, `health_max`) VALUES ('1000', 'health', '', '1', '', '', '100', '100'),('1001', 'player coord', '', '', '', '', 'start_coord_x', 'start_coord_y') , ('2001', '', '', '', 'armore_head', '', '', ''), ('2002', '', '', '', 'armore_chest', '', '', ''), ('2003', '', '', '', 'armore_legs', '', '', ''), ('2004', '', '', '', 'armore_hand', '', '', ''), ('2005', '', '', '', 'armore_foot', '', '', ''), ('2006', '', '', '', 'armore_belt', '', '', ''), ('2007', '', '', '', 'armore_back', '', '', ''), ('2100', '', '', '', 'left_hand', '', '', ''), ('2200', '', '', '', 'right_hand', '', '', ''), ('2300', '', '', '', 'two_hand', '', '', '')");
    
    header('Location: login.php?err=Now you can autorize');
}
?>