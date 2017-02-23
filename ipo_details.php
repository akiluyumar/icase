<?php
require_once("config.php");

//if((isset($_GET['a'])) && ($_GET['a'] == "viewdetails") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    
    $fetch_query = "SELECT * FROM tbl_ipos WHERE ipo_id='$field' LIMIT 1";
    $fetch_result = mysqli_query($conn, $fetch_query) or die(mysqli_connect_error());

    $ipo = mysqli_fetch_assoc($fetch_result);
    
//} else {
//    header("Location: casediary.php?a=wrong_link");
//}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : IPO</title>
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
                     <h2>IPOs</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default col-md-8">
                            <div class="panel-heading">
                                <h3>
                                    IPO Profile [ <?php echo $ipo['ipo_id']; ?> ]
                                    <span class="pull-right">
                                        <a href="add_ipo.php" class="btn btn-primary">Add New</a>&nbsp;
                                        <a href="ipo.php" class="btn btn-primary">List All IPOs</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3">Name</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_name']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Rank</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_rank']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Team</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_team']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">GSM</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_gsm']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Gender</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_gender']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Is IPO Head</label>
                                    <div class="col-sm-5">
                                        <?php if($ipo['ipo_is_team_head'] == "1") { echo "Yes"; } else { echo "No"; } ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Station</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_station']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">E-mail</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_email']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">State</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_state']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3">Department</label>
                                    <div class="col-sm-5">
                                        <?php echo $ipo['ipo_dept']; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="uploads/ipos/<?php echo $ipo['ipo_photo']; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Administration</h3>
                            </div>
                            
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            
                            <div class="panel-body">
                                
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
