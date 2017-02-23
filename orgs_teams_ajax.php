<?php
    require ("config.php");
    require_once("includes/icase_functions.php"); 
    if (isset($_GET["ipo_org_id"])){
    $curr_org = $_GET['ipo_org_id'];
    
    $res=get_teams4org($curr_org);
    
    if (mysqli_num_rows($res)>0){
        $arr_teams = [];
        while ($d = mysqli_fetch($res)){
            $arr_teams[]=$d["team_name"]; 
        }
        echo json_encode($arr_teams);
    }

    }
?>