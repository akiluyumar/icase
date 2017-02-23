<?php
include("config.php");

if(isset($_POST['button'])) {
    $crno = $_POST['crno'];
    $team = $_POST['team'];
    $date = date('Y-m-d');
    $query = "UPDATE tbl_casediary SET team='$team', team_assigned_date='$date' WHERE crno='$crno'";
    $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
    
    if($result) {
        echo "Success";
    } else {
        "Failed";
    }
}

if(isset($_POST['getTeam']) && $_POST['getTeam'] == 'true') {
    $crno = $_POST['crno'];
    $query = mysqli_query($conn, "SELECT team FROM tbl_casediary WHERE crno='$crno'") or die(mysqli_connect_error());
    $team = mysqli_fetch_assoc($query);
    
    if($query) {
        echo $team['team'];
    }
}

if(isset($_POST['getprocess'])) {
    $fwdmodule = $_POST['getmodule'];
    $fwdstate = $_POST['getstate'];
    
    if($fwdmodule === "POLICE") {
        $fwd_query = "SELECT org_name as gname, org_id as id FROM tbl_orgs WHERE org_state='$fwdstate'";
    } else if ($fwdmodule === "MINISTRY") {
        $fwd_query = "SELECT moj_name as gname, moj_id as id FROM tbl_moj WHERE moj_state='$fwdstate'";
    } else if ($fwdmodule === "COURT") {
        $fwd_query = "SELECT court_name as gname, court_id as id FROM tbl_courts WHERE court_state='$fwdstate'";
    } else if($fwdmodule === "PRISONS") {
        $fwd_query = "SELECT prison_name  as gname, prison_id as id FROM tbl_prisons WHERE prison_state='$fwdstate'";
    }
   //echo "<script>alert(".$_POST['fwdprocess'].")</script>";
    $fwdquery_result = mysqli_query($conn, $fwd_query) or die(mysqli_connect_error());
    if($fwdquery_result) {
        echo "<option>Select Agency</option>";
        while($module = mysqli_fetch_assoc($fwdquery_result)) {
            echo "<option value=\"{$module['id']}\">{$module['gname']}</option>";
        }
    } else {
        echo "failed";
    }
}
//get Casediary Module
if(isset($_POST['modValidate']) && $_POST['modValidate'] == "true") {
    $field = $_POST['crno'];
    $query = mysqli_query($conn, "SELECT fileloc_modl FROM tbl_casediary WHERE crno='$field'") or die(mysqli_connect_error());
    $row = mysqli_fetch_assoc($query);
    if($query) {
        echo $row['fileloc_modl'];
    }
}
//Send to Case Logs
if(isset($_POST['btn'])) {
    $crno = $_POST['crno'];
    $to = $_POST['toModl'];
    $to_modl_id = $_POST['toModlID'];
    $sent_from_modl = $_POST['fromModl'];
    $from_modl_id = $_POST['fromModlID'];
    $message = $_POST['fwdMessage'];
    $private = $_POST['private'];
    $date = date('Y-m-d H:i:s');

    $query = sprintf("INSERT INTO tbl_case_log(crno, sent_from_modl, from_modl_id, sent_to_modl, to_modl_id, sent_message, time_date_sent, msg_private) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                     $crno,
                     $sent_from_modl,
                     $from_modl_id,
                     $to,
                     $to_modl_id,
                     $message,
                     $date,
                     $private);
    
    $query_result = mysqli_multi_query($conn, $query) or die(mysqli_connect_error());
    
    $update_query = "UPDATE tbl_casediary SET fileloc='$to_modl_id', fileloc_date='$date', fileloc_modl='$to' WHERE crno='$crno'";
    
    $update_result = mysqli_query($conn, $update_query) or die(mysqli_connect_error());
    
    if($query_result && $update_result) {
        echo "Case forwaded successfully";
    } else {
        echo "Forward Case Failed";
    }
}

//Get IPO Team
if(isset($_POST['getIPOTeam']) && $_POST['getIPOTeam'] == "true") {
    $orgid = $_POST['orgid'];
    $query = mysqli_query($conn, "SELECT team_id, team_name FROM tbl_teams WHERE org_id='$orgid'") or die(mysqli_connect_error());
    if($query) {
        echo "<option>-- Select Team --</option>";
        while($team = mysqli_fetch_assoc($query)) {
            echo "<option value=\"{$team['team_id']}\">{$team['team_name']}</option>";
        }
    } else {
        echo "Couldnt Fetch Team";
    }
}

//echo "Just trying this out";

//Add Inmate
if(isset($_POST['checkForm']) && $_POST['checkForm'] === "true") {
    //echo "here";
    $prison_id = $_POST['prison_id'];
    $suspect_id = $_POST['susp_id'];
    $crno = $_POST['crno'];
    $prison_number = $_POST{'prison_no'};
    $offence_title = $_POST['offence_title'];
    $offence_cat = $_POST['offence_cat_id'];
    $offence_details = $_POST['offence_details'];
    $date_committed = $_POST['date_committed'];
    $date_arraigned = $_POST['date_arraigned'];
    $release_date = $_POST['release_date'];
    $court = $_POST['court_id'];
    $status_id = $_POST['status_id'];
    $sentence = $_POST['sentence'];
    $date_sentence_begin = $_POST['sentence_begins'];
    $crime_location = $_POST['crime_location'];
    
    $query = "INSERT INTO tbl_prisoner_file(crno, susp_id, prison_no, prison_id, offence_title, offence_cat_id, offence_details, date_committed, date_arraigned, court_id, status_id, sentence, sentence_begins, crime_location, releaseddate) VALUES ('$crno', '$suspect_id', '$prison_number', '$prison_id', '$offence_title', '$offence_cat', '$offence_details', '$date_committed', '$date_arraigned', '$court', '$status_id', '$sentence', '$date_sentence_begin', '$crime_location', '$release_date')";
    
    $result = mysqli_query($conn, $query);
    
    if($result) {
        echo "Done Successfully";
    }
}

if(isset($_POST['checkBailOut']) && $_POST['checkBailOut'] === "true") {
    $suspect_id = $_POST['susp_id'];
    $crno = $_POST['crno'];
    $bail_date = $_POST['bail_date'];
    $bailer_name = $_POST['bailer_name'];
    $bailer_addr = $_POST['bailer_addr'];
    $bailer_phone = $_POST['bailer_phone'];
    $bail_terms = $_POST['bail_terms'];
    $approved_by = $_POST['approved_by'];
    $entry_date = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO tbl_bails(crno, susp_id, bail_date, bailer_name, bailer_addr, bailer_phone, bail_terms, bail_apprv_by, entry_date) VALUES ('$crno', '$suspect_id', '$bail_date', '$bailer_name', '$bailer_addr', '$bailer_phone', '$bail_terms', '$approved_by', '$entry_date')";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        echo "Bail Information Save successfully";
    } else {
        echo "Bail Information Failed";
    }
    
}
//echo $_POST['submitWarder'];
if(isset($_POST['submitWarder']) && $_POST['submitWarder'] == "true") {
    $ward_no = $_POST['ward_no'];
    $prison_id = $_POST['prison_id'];
    $ward_name = $_POST['ward_name'];
    $ward_pix = $_POST['ward_pix'];
    $ward_gender = $_POST['ward_gender'];
    $ward_rank = $_POST['ward_rank'];
    $date_added = date('Y-m-d H:i:s');
    $ward_boss = $_POST['ward_boss'];
    
    $query = "INSERT INTO tbl_warders(prison_id, ward_no, ward_name, ward_pix, ward_rank, ward_gender, date_added, ward_boss) VALUES ('$prison_id', '$ward_no', '$ward_name', '$ward_pix', '$ward_rank', '$ward_gender', '$date_added', '$ward_boss')";
    
    $result = mysqli_query($conn, $query);
    
    if($result) {
        echo "Success";
    } else {
        die("Failed");
    }
}
    