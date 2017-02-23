<?php
require_once("config.php");

if((isset($_GET['a'])) && ($_GET['a'] == "edit") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    
    $fetch_query = "SELECT * FROM tbl_casediary WHERE crno='$field' LIMIT 1";
    $fetch_result = mysqli_query($conn, $fetch_query) or die(mysqli_connect_error());

    $casediary = mysqli_fetch_assoc($fetch_result);
} else {
    header("Location: casediary.php?a=wrong_link");
}

if(isset($_POST['editCaseBtn'])) {
        $crno = $_POST['crno'];
        $casedate = $_POST['casedate'];
        $casetitle = $_POST['casetitle'];
        $offences  = $_POST['offences'];
        $natureofoffence = $_POST['noo'];
        $itemsrecovered = $_POST['itemsrec'];
        $caseofficer = $_POST['caseoffr'];
        $caselocation = $_POST['caseloc'];
        $visible = $_POST['visible'];
        $archive = $_POST['archive'];
        $casestate = $_POST['case_state'];
        $police_report = $_POST['police_report'];
        
        $edit_query = "UPDATE tbl_casediary SET casedate='$casedate', casetitle='$casetitle', offences='$offences', nature_of_offence='$natureofoffence', items_recovered='$itemsrecovered', police_report='$police_report', invest_offr='$caseofficer', case_location='$caselocation', visible='$visible', archive='$archive', case_state='$casestate' WHERE crno='$crno'";
        
        $edit_result = mysqli_query($conn, $edit_query) or die(mysqli_connect_error());
        
        if($edit_result) {
            header("Location: casediary.php?a=edit&t=casediary&s=1");
        } else {
            header("Location: casediary.php?a=edit&t=casediary&s=0");
        }
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Case Diary</title>
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
                     <h2>Case Diary</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Edit Casediary
                                    <span class="pull-right">
                                        <a href="casediary.php" class="btn btn-primary">List All Casediaries</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="crno" class="col-sm-12">Case Registration No.</label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="CRNO" name="crno" class="form-control" readonly value="<?php echo $casediary['crno']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="casedate" class="col-sm-12">Case Date</label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Case Date" name="casedate" class="form-control" required value="<?php echo $casediary['casedate']; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="casetitle" class="col-sm-12">Case Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="casetitle" placeholder="Case Title" required value="<?php echo $casediary['casetitle']; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="offences" class="col-sm-12">Offences</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="offences" rows="4" placeholder="Offences"><?php echo $casediary['offences']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="noo" class="col-sm-12">Nature of Offence</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="noo" rows="4" placeholder="Nature of Offence"><?php echo $casediary['nature_of_offence']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="itemsrec" class="col-sm-12">Items Recovered</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="itemsrec" rows="4" placeholder="Items Recovered"><?php echo $casediary['items_recovered']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="itemsrec" class="col-sm-12">Police Report</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="police_report" rows="4" placeholder="Enter Police Report"><?php echo $casediary['police_report']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="caseoffr" class="col-sm-12">Case Officer</label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Case Officer" name="caseoffr" class="form-control" value="<?php echo $casediary['invest_offr']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="caseloc" class="col-sm-12">Case Location</label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Case Location" name="caseloc" class="form-control" required value="<?php echo $casediary['case_location']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="case_state" class="col-sm-12">Case State</label>
                                        <div class="col-sm-6">
                                            <?php 
                                            $state_query = mysqli_query($conn, "SELECT state FROM tbl_states") or die(mysqli_connect_error());
                                            ?>
                                            <select name="case_state" class="form-control">
                                                <?php while($state = mysqli_fetch_assoc($state_query)) { ?>
                                                <option value="<?php echo $state['state']; ?>" <?php if($casediary['case_state'] == $state['state']) { echo "selected"; } ?>><?php echo $state['state']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="visible" class="col-sm-12">Visible</label>
                                        <div class="col-sm-5">
                                            <select name="visible" class="form-control">
                                                <option>Visible</option>
                                                <option value="1" <?php if($casediary['visible'] == "1") { echo "selected"; } ?>>Yes</option>
                                                <option value="0" <?php if($casediary['visible'] == "0") { echo "selected"; } ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="archive" class="col-sm-12">Archive</label>
                                        <div class="col-sm-5">
                                            <select name="archive" class="form-control">
                                                <option>Archive</option>
                                                <option value="1" <?php if($casediary['archive'] == "1") { echo "selected"; } ?>>Yes</option>
                                                <option value="0" <?php if($casediary['archive'] == "0") { echo "selected"; } ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <button class="btn btn-success" type="submit" name="editCaseBtn">Update</button>
                                </div>
                            </div>
                            </form>
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
