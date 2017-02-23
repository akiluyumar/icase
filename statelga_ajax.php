<?php
    require ("config.php");
    require_once("includes/icase_functions.php"); 
    if (isset($_POST["state"])){
    $st = $_POST['state'];
    
    $res=get_lgas4state($st);
    
    if (mysqli_num_rows($res)>0){
        $arr_lgas = [];
        while ($d = mysqli_fetch_assoc($res)){
            //$arr_lgas[]=$d["lga"]; 
            echo "<option value\"{$d['lga']}\">{$d['lga']}</opyion>";
        }
        //echo json_encode($arr_lgas);
    }

    }
?>