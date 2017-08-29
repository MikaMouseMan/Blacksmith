<?php
////////////////////////////////////////////check on empty
function is_no_constructions($global_x, $global_y){
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` = '$global_x' AND `y` = '$global_y'");
    $building = mysql_fetch_array($select);
    if(!$building){
        return true;
    }else return false;
    
}

function is_no_constructions_block($global_x1, $global_y1, $global_x2, $global_y2){
    
    $select = mysql_query("SELECT * FROM `data_buildings_on_map` WHERE `x` BETWEEN '$global_x1' AND '$global_x2' AND `y` BETWEEN '$global_y1' AND '$global_y2'");
    $building = mysql_fetch_array($select);
    if(!$building){
        return true;
    }else return false;
    
}

//////////////////////deconstruct
function clear_cell($global_x, $global_y){
    
    $id = $global_x.$global_y;
    mysql_query("DELETE FROM `data_buildings_on_map` WHERE `data_buildings_on_map`.`id` LIKE '$id'");
}

function clear_cell_block($global_x1, $global_y1, $global_x2, $global_y2){
        
    for($i = $global_y1; $i <= $global_y2; $i++){
        for($j = $global_x1; $j <= $global_x2; $j++){

            $id = $j.$i;
            mysql_query("DELETE FROM `data_buildings_on_map` WHERE `data_buildings_on_map`.`id` LIKE '$id'");
        }
    }
}

/////////////////////////////////////////////////////////////Plant tree
function build_tree($global_x, $global_y, $player_id = 1){
        
    $new_id = $global_x.$global_y;
    $new_name = "tree";
    $master_id = $player_id;
    $color = "";
    $health = 1;
    $health_max = 1;

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '$health', '$health_max', '$master_id', '$color')");
    
}


///////////////point
function build_road($global_x, $global_y, $player_id = 1){
        
    $new_id = $global_x.$global_y;
    $new_name = "road";
    $master_id = $player_id;
    $color = "";

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
    
}

function build_wall($global_x, $global_y, $player_id = 1){
        
    $new_id = $global_x.$global_y;
    $new_name = "wall";
    $master_id = $player_id;
    $color = "";

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
 
}

function build_door($global_x, $global_y, $player_id = 1){
        
    $new_id = $global_x.$global_y;
    $new_name = "door";
    $master_id = $player_id;
    $color = "";

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
 
}

function build_floor($global_x, $global_y, $player_id = 1){
            
    $new_id = $global_x.$global_y;
    $new_name = "floor";
    $master_id = $player_id;
    $color = "";

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
 
}

///////////////line/block
function build_road_block($global_x1, $global_y1, $global_x2, $global_y2, $player_id = 1){
    
    for($i = $global_y1; $i <= $global_y2; $i++){
        for($j = $global_x1; $j <= $global_x2; $j++){

            build_road($j, $i, $player_id);
        }
    }
        
}

function build_floor_block($global_x1, $global_y1, $global_x2, $global_y2, $player_id = 1){
    
    for($i = $global_y1; $i <= $global_y2; $i++){
        for($j = $global_x1; $j <= $global_x2; $j++){

            build_floor($j, $i, $player_id);
        }
    }
    
}

function build_wall_block($global_x1, $global_y1, $global_x2, $global_y2, $player_id = 1){
    
    for($i = $global_y1; $i <= $global_y2; $i++){
        for($j = $global_x1; $j <= $global_x2; $j++){

            build_wall($j, $i, $player_id);
        }
    }
    
}

//////////////empty home
function build_home_empty($global_x1, $global_y1, $global_x2, $global_y2, $door_side, $player_id = 1){
    
    clear_cell_block($global_x1, $global_y1, $global_x2, $global_y2);
    
    build_wall_block($global_x1, $global_y1, $global_x2, $global_y2, $player_id);
    
    clear_cell_block($global_x1 + 1, $global_y1 + 1, $global_x2 - 1, $global_y2 - 1);
    
    build_floor_block($global_x1, $global_y1, $global_x2, $global_y2, $player_id);
    
    if($door_side == "up"){
        
        $global_x = (int)(($global_x2 + $global_x1)/2);
        $global_y = $global_y1;
        
    }else if($door_side == "down"){
        
        $global_x = (int)(($global_x2 + $global_x1)/2);
        $global_y = $global_y2;
        
    }else if($door_side == "left"){
        
        $global_x = $global_x1;
        $global_y = (int)(($global_y2 + $global_y1)/2);
        
    }else if($door_side == "right"){
        
        $global_x = $global_x2;
        $global_y = (int)(($global_y2 + $global_y1)/2);
        
    }
    
    clear_cell($global_x, $global_y);
    build_door($global_x, $global_y, $player_id);    
    
}

//////////////home
function build_home($global_x1, $global_y1, $global_x2, $global_y2, $door_side, $player_id = 1){
    
}

/////////////environment
function build_environment($global_x, $global_y){
    
    $new_id = $global_x.$global_y;
    $new_name = "environment";
    $master_id = time();
    $color = "";

    mysql_query("INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES ('$new_id', '$global_x', '$global_y', '$new_name', '1', '1', '$master_id', '$color')");
    
}

?>