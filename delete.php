<?php

require_once("config.php");

//Delete Case Diary
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_casediary WHERE crno='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: casediary.php?a=delete&t=casediary&s=1");
    } else {
        header("Location: casediary.php?a=delete&t=casediary&s=0");
    }
}

//Delete Suspects
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "suspect") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_suspects WHERE susp_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: suspects.php?ra=delete&rt=suspect&rs=1");
    } else {
        header("Location: suspects.php?ra=delete&rt=suspect&rs=0");
    }
}

//Delete Case Suspects
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "casesuspect") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    $return = $_GET['case'];
    
    $delete_query = "DELETE FROM tbl_suspects WHERE susp_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: casediary_details.php?a=viewdetails&t=casediary&id={$return}&ra=delete&rt=suspect&rs=1");
    } else {
        header("Location: casediary_details.php?ra=delete&rt=suspect&rs=0");
    }
}

//Delete Case Documents
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "casedoc") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    $crno = $_GET['case'];
    
    $delete_query = "DELETE FROM tbl_case_docs WHERE doc_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: casediary_details.php?ra=delete&rt=casediary&rs=1&a=viewdetails&t=casediary&id={$crno}");
    } else {
        header("Location: casediary_details.php?ra=delete&rt=casediary&rs=0&a=viewdetails&t=casediary+id={$crno}");
    }
}

//Delete IPO
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "ipo") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_ipos WHERE ipo_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: ipo.php?ra=delete&rt=ipo&rs=1");
    } else {
        header("Location: ipo.php?ra=delete&rt=ipo&rs=0");
    }
}

//Delete User Role
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "urole") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_user_roles WHERE usergroup_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: uroles.php?ra=delete&rt=urole&rs=1");
    } else {
        header("Location: uroles.php?ra=delete&rt=urole&rs=0");
    }
}

//Delete User Role
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "org") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_orgs WHERE org_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: orgs.php?ra=delete&rt=org&rs=1");
    } else {
        header("Location: orgs.php?ra=delete&rt=org&rs=0");
    }
}

//********************************************************
//********************************************************

//Delete Court
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "court") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_courts WHERE court_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: courts.php?ra=delete&rt=court&rs=1");
    } else {
        header("Location: courts.php?ra=delete&rt=court&rs=0");
    }
}


//Delete Judges
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "judge") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_judges WHERE judge_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: judges.php?ra=delete&rt=judge&rs=1");
    } else {
        header("Location: judges.php?ra=delete&rt=judge&rs=0");
    }
}

//Delete Counsels
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "counsel") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_counsels WHERE counsel_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: counsels.php?ra=delete&rt=counsel&rs=1");
    } else {
        header("Location: counsels.php?ra=delete&rt=counsel&rs=0");
    }
}

//Delete mojs
if((isset($_GET['a'])) && ($_GET['a'] == "delete") && (isset($_GET['t'])) && ($_GET['t'] == "moj") && (isset($_GET['id']))) {
    $field = $_GET['id'];
    
    $delete_query = "DELETE FROM tbl_mojs WHERE moj_id='$field'";
    $delete_result = mysqli_query($conn, $delete_query) or die(mysqli_connect_error());
    
    if($delete_result) {
        header("location: mojs.php?ra=delete&rt=moj&rs=1");
    } else {
        header("Location: mojs.php?ra=delete&rt=moj&rs=0");
    }
}
