<?php
require_once("config.php");
require_once("includes/icase_functions.php");

//if((isset($_GET['a'])) && ($_GET['a'] == "viewdetails") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    $crno = $_GET['crno'];
    
    //Get Suspects
    $susp_query = "SELECT * FROM tbl_suspects WHERE susp_id='$field'";
    $susp_result = mysqli_query($conn, $susp_query) or die(mysqli_connect_error());
    
    $suspect = mysqli_fetch_assoc($susp_result);
    $suspect_count = mysqli_num_rows($susp_result);
    
    //Get Arrest
    $arr_query = "SELECT * FROM tbl_arrests WHERE susp_id='$field'";
    $arr_result = mysqli_query($conn, $arr_query) or die(mysqli_connect_error());
    $arrest = mysqli_fetch_assoc($arr_result);
    $arrest_count = mysqli_num_rows($arr_result);
	
//} else {
//    header("Location: casediary.php?a=wrong_link");
//}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Suspects</title>
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
                     <h2>Suspect Details</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <!-- START NEW COLUMN -->
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <div class="text-center">
                                        <img src="uploads/suspects/<?php echo $suspect['susp_photo']; ?>" class="img-responsive">
                                    </div>
                                    <h3 class="text-center">
                                        <?php echo $suspect['susp_name']; ?>
                                        <small class="help-block"><?php echo $suspect['susp_nickname']; ?></small>
                                    </h3>
                                </div>

                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <nav>
                                        <p>
                                            <a href="add_suspect.php?case=<?php echo $crno; ?>"><i class="fa fa-plus"></i> Add Suspect</a><br>
                                            <a href="edit_suspect.php?case=<?php echo $crno; ?>&a=edit&t=suspect&id=<?php echo $suspect['susp_id']; ?>"><i class="fa fa-pencil"></i> Edit Suspect</a><br>
                                            <a onclick="return confirm('Are you sure you want to delete this suspect');" href="delete.php?case=<?php echo $crno; ?>&a=delete&t=casesuspect&id=<?php echo $suspect['susp_id']; ?>"><i class="fa fa-trash"></i> Delete Suspect</a>
                                        </p>
                                    </nav>
                                    <div class="separated"></div>
                                    <nav>
                                        <p>
                                            <a href="#" onclick="return confirm('Are you sure you want to send this suspect to Jail');" class="text-danger" role="button">Send to Jail</a><br>
                                            <a href="#" id="bailoutBtn" class="text-success" role="button">Bail Suspect</a>
                                        </p>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Suspect Profile
                                        </h3>
                                    </div>

                                    <div class="panel-body form-horizontal">

                                        <div class="form-group">
                                            <label class="col-sm-4">Sex</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_sex']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Date of Birth</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_dob']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Age</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_age']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Marital Status</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_mstatus']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Tribe</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_tribe']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">State</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_state']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">LGA</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_lga']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Address</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_addr']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Occupation</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_occp']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Date Registered</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_datereg']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Nickname</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_nickname']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Bank Account</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_bank_accts']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Remarks</label>
                                            <div class="col-sm-5">
                                                <?php echo $suspect['susp_remarks']; ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- End Suspect details Row-->
                        <!-- Start ARREST ROW -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Arrest Details
                                        </h3>
                                    </div>

                                    <div class="panel-body form-horizontal">
                                        <?php
                                            if ($arrest_count > 0){ // Arrest record found 
                                        ?>


                                        <div class="form-group">
                                            <label class="col-sm-4">Date Arrested</label>
                                            <div class="col-sm-5">
                                                <?php echo $arrest['arrest_date']; ?> <?php echo $arrest['arr_time']; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4">Details</label>
                                            <div class="col-sm-5">
                                                <?php echo $arrest['arrest_story']; ?>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <p>Details of Arrest not recorded.</p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>                 
                        </div>
                        <!-- END ARREST ROW -->
                        <!-- START BAIL ROW -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Bail Details</h3>
                                    </div>
                                    
                                    <input type="hidden" id="bailSuspect" value="<?php echo $suspect['susp_id']; ?>">
                                    <input type="hidden" id="bailCase" value="<?php echo $suspect['crno']; ?>">

                                    <div class="panel-body form-horizontal" id="bailInfo">

                                    </div>
                                </div>
                            </div>                 
                        </div>
                        
                        
                    </div>
                    
                    <!-- START NEW COLUMN -->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <span class="pull-center">
                                        <a href="arrest.php?suspect=<?php echo $suspect['susp_id']; ?>&case=<?php echo $crno; ?>" class="btn btn-primary">Update Arrest Info</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!--	<a href="suspects.php" class="btn btn-primary">List All Suspect</a> -->
                                        <a href="casediary_details.php?a=viewdetails&t=casediary&id=<?php echo $crno; ?>" class="btn btn-primary">Case Diary</a>
                                    </span>
                               </div>

                            </div>
                        </div>
                        <!-- START PRISON ROW -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Prisons
                                            <span class="pull-right">
                                                [ <a href="#" id="priRecordModalBtn">+ Update Prison Info</a> ]
                                            </span>
                                        </h3>
                                    </div>
                                    
                                    <div class="panel-body" id="prisonsInfo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
				
                 <!-- /. ROW  -->
				 
				 <!-- /. ROW ARREST  -->
				 
                
				
                 <!-- /. ROW  -->
				 
				 <!-- /. ROW BAIL  -->
				 
                
				
                 <!-- /. ROW  -->
                <?php include("includes/modals.php"); ?>
                
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
