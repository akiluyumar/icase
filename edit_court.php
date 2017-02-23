<?php
require_once("config.php");

if(isset($_GET['id']) && $_GET['t'] == "court" && $_GET['a'] == "edit") {
    $field = $_GET['id'];
    
    $query = "SELECT * FROM tbl_courts WHERE court_id='$field'";
    $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
    
    $crt = mysqli_fetch_assoc($result);
}

//List Court [Selection]
//$moj_query = mysqli_query($conn, "SELECT * FROM tbl_moj") or die(mysqli_connect_error());

//Select Court head from users table
//$crthead_query = mysqli_query($conn, "SELECT * FROM tbl_users") or die(mysqli_connect_error());

$state_query = "SELECT * FROM tbl_states";
$state_result = mysqli_query($conn, $state_query) or die(mysqli_connect_error());

if(isset($_POST['updateBtn'])) {
    $court_id = $_POST['court_old_id'];
    $court_name = $_POST['court_name'];
    $court_addr = $_POST['court_addr'];
    $court_state = $_POST['court_state'];
    $court_profile = $_POST['court_profile'];
    $visible = $_POST['visible'];
    $timestamp = date('Y-m-d');
    
//    $pic = $_FILES['photo']['name'];
//    $photo = date('ymd').time().$pic;
    
    
    $update_query = "UPDATE tbl_courts SET court_name='$court_name', court_addr='$court_addr', court_profile='$court_profile', visible='$visible', court_state='$court_state' WHERE court_id='$court_id'";
    
    $update_result = mysqli_query($conn, $update_query);
    
    if($update_result) {
        //copy($_FILES['photo']['tmp_name'], "uploads/court/".$photo);
        header("Location: courts.php?a=edit&t=court&s=1");
    } else {
        header("Location: courts.php?a=edit&t=court&s=0");
    }
}

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
                     <h2>Manage Courts</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Update Court Record
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <input type="hidden" name="court_old_id" value="<?php echo $crt['court_id']; ?>">
                                    
                                    <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Court Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="court_name" class="form-control" value="<?php echo $crt['court_name']; ?>">
                                                </div>
                                            </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Court Address</label>
                                            <div class="col-sm-8">
                                                <textarea name="court_addr" class="form-control"><?php echo $crt['court_addr']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="control-label col-md-3">State</label>
                                            <div class="col-md-6">
                                                <select name="court_state" class="form-control">
                                                    <option>Select</option>
                                                    <?php foreach($state_result as $state) { ?>
                                                    <option value="<?php echo $state['state']; ?>" <?php if($crt['court_state'] == $state['state']) { echo "selected"; } ?>><?php echo $state['state']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Court Profile</label>
                                            <div class="col-sm-8">
                                                <textarea name="court_profile" class="form-control"><?php echo $crt['court_profile']; ?></textarea>
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
