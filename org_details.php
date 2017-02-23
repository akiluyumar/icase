<?php
require_once("config.php");

//if((isset($_GET['a'])) && ($_GET['a'] == "viewdetails") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    
    //Get Suspects
    $org_query = "SELECT * FROM tbl_orgs WHERE org_id='$field'";
    $org_result = mysqli_query($conn, $org_query) or die(mysqli_connect_error());
    
    $org = mysqli_fetch_assoc($org_result);
    $org_count = mysqli_num_rows($org_result);
    
//} else {
//    header("Location: casediary.php?a=wrong_link");
//}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Organizations</title>
	<?php include("includes/head.phtml"); ?>
</head>
<body>
    <div id="wrapper">
        <?php include("includes/header.phtml"); ?> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Organization</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Organization Details
                                    <span class="pull-right">
                                        <a href="add_org.php" class="btn btn-primary">Add New</a>&nbsp;
                                        <a href="orgs.php" class="btn btn-primary">List All</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body form-horizontal">
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Organization Name</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_name']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Organization Acronym</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_acronym']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Address</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_addr']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">State</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_state']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Organization Head</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_head']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Head GSM</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_head_gsm']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Head E-mail</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_head_email']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Ministry of Justice</label>
                                    <div class="col-sm-5">
                                        <?php 
                                        $moj_query = mysqli_query($conn, "SELECT * FROM tbl_moj WHERE moj_id='$org[org_moj]'");
                                        $moj = mysqli_fetch_assoc($moj_query);
                                        
                                        echo $moj['moj_name'];
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Organization's Profile</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_profile']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Remark</label>
                                    <div class="col-sm-5">
                                        <?php echo $org['org_remark']; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Statistics</h3>
                            </div>
                            
                            <div class="panel-body form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-5">Added By</label>
                                    <div class="col-sm-6">
                                        <?php echo $org['addedby']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-5">Date Added</label>
                                    <div class="col-sm-6">
                                        <?php echo $org['date_added']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-5">Visible</label>
                                    <div class="col-sm-6">
                                        <?php echo $org['visible']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                 <!-- /. ROW  -->
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
    
   
</body>
</html>
