<?php
require_once("config.php");

if(isset($_GET['id']) && $_GET['t'] == "judge" && $_GET['a'] == "edit") {
    $field = $_GET['id'];
    
    $query = "SELECT * FROM tbl_judges WHERE judge_id='$field'";
    $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
    
    $crt = mysqli_fetch_assoc($result);
}

//List judge [Selection]
//$moj_query = mysqli_query($conn, "SELECT * FROM tbl_moj") or die(mysqli_connect_error());

//Select judge head from users table
//$crthead_query = mysqli_query($conn, "SELECT * FROM tbl_users") or die(mysqli_connect_error());

$state_query = "SELECT * FROM tbl_states";
$state_result = mysqli_query($conn, $state_query) or die(mysqli_connect_error());

if(isset($_POST['updateBtn'])) {
    $judge_id = $_POST['judge_old_id'];
    $court_id = $_POST['court_id'];
    $judge_name = $_POST['judge_name'];
    $judge_gsm = $_POST['judge_gsm'];
    $judge_email = $_POST['judge_email'];
    $visible = $_POST['visible'];
    $timestamp = date('Y-m-d');
    
//    $pic = $_FILES['photo']['name'];
//    $photo = date('ymd').time().$pic;
    
    
    $update_query = "UPDATE tbl_judges SET court_id='$court_id', judge_name='$judge_name', judge_email='$judge_email', visible='$visible', judge_gsm='$judge_gsm' WHERE judge_id='$judge_id'";
    
    $update_result = mysqli_query($conn, $update_query);
    
    if($update_result) {
        //copy($_FILES['photo']['tmp_name'], "uploads/judge/".$photo);
        header("Location: judges.php?a=edit&t=judge&s=1");
    } else {
        header("Location: judges.php?a=edit&t=judge&s=0");
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Judges</title>
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
                     <h2>Manage judges</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Update judge Record
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <input type="hidden" name="judge_old_id" value="<?php echo $crt['judge_id']; ?>">
                                    
                                    <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">judge Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="judge_name" class="form-control" value="<?php echo $crt['judge_name']; ?>">
                                                </div>
                                            </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">judge Address</label>
                                            <div class="col-sm-8">
                                                <textarea name="judge_email" class="form-control"><?php echo $crt['judge_email']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="control-label col-md-3">State</label>
                                            <div class="col-md-6">
                                                <select name="judge_gsm" class="form-control">
                                                    <option>Select</option>
                                                    <?php foreach($state_result as $state) { ?>
                                                    <option value="<?php echo $state['state']; ?>" <?php if($crt['judge_gsm'] == $state['state']) { echo "selected"; } ?>><?php echo $state['state']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">judge Profile</label>
                                            <div class="col-sm-8">
                                                <textarea name="judge_profile" class="form-control"><?php echo $crt['judge_profile']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Visible</label>
                                            <div class="col-sm-6">
                                                <select name="visible" class="form-control">
                                                    <option value="1" <?php if($crt['visible'] == "1") { echo "selected"; } ?>>Yes</option>
                                                    <option value="0" <?php if($crt['visible'] == "0") { echo "selected"; } ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                <div class="panel-footer">
                                    <div class="form-group text-right">
                                        <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                        <button type="submit" class="btn btn-success" name="updateBtn">Save</button>
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
