<?php
require_once("config.php");

//if((isset($_GET['a'])) && ($_GET['a'] == "viewdetails") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    
    //Get Suspects
    $court_query = "SELECT * FROM tbl_courts WHERE court_id='$field'";
    $court_result = mysqli_query($conn, $court_query);
    
   $court = mysqli_fetch_assoc($court_result);
    $court_count = mysqli_num_rows($court_result);
    
//} else {
//    header("Location: casediary.php?a=wrong_link");
//}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Courts</title>
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
                     <h2>Court</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Court Details
                                    <span class="pull-right">
                                        <a href="add_court.php" class="btn btn-primary">Add New</a>&nbsp;
                                        <a href="courts.php" class="btn btn-primary">List Courts</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body form-horizontal">
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Court Name</label>
                                    <div class="col-sm-5">
                                        <?php echo $court['court_name']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">Address</label>
                                    <div class="col-sm-5">
                                        <?php echo $court['court_addr']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4">State</label>
                                    <div class="col-sm-5">
                                        <?php echo $court['court_state']; ?>
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label class="col-sm-4">Court's Profile</label>
                                    <div class="col-sm-5">
                                        <?php echo $court['court_profile']; ?>
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
                                        <?php echo $court['addedby']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-5">Date Added</label>
                                    <div class="col-sm-6">
                                        <?php echo $court['date_added']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-5">Visible</label>
                                    <div class="col-sm-6">
                                        <?php echo $court['visible']; ?>
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
