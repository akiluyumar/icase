<?php
require_once("config.php");

//List Court [Selection]
// $moj_query = mysqli_query($conn, "SELECT * FROM tbl_courts");

//Select Court head from users table
// $orghead_query = mysqli_query($conn, "SELECT * FROM tbl_users");

$state_query = "SELECT * FROM tbl_states";
$state_result = mysqli_query($conn, $state_query) ;

if(isset($_POST['saveBtn'])) {
    $court_name = $_POST['court_name'];
    $court_state = $_POST['court_state'];
    $court_addr = $_POST['court_addr'];
    $visible = $_POST['visible'];
    $court_profile = $_POST['court_profile'];
    $date_added = date('Y-m-d');
    
//    $pic = $_FILES['photo']['name'];
//    $photo = date('ymd').time().$pic;
    
    
    $create_query = "INSERT INTO tbl_courts(court_name, court_state, court_addr, visible, date_added, court_profile) VALUES ('$court_name', '$court_state', '$court_addr', '$visible', '$date_added','$court_profile')";
    $create_result = mysqli_query($conn, $create_query) ;
    
    if($create_result) {
        //copy($_FILES['photo']['tmp_name'], "uploads/courts/".$photo);
        header("Location: court_details.php?a=create&t=courts&s=1&id='$court_id'");
    } else {
        header("Location: courts.php?a=create&t=courts&s=0");
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
                                    Add Court
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Court Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="court_name" class="form-control" placeholder="Court Name">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Court Address</label>
                                        <div class="col-sm-8">
                                            <textarea name="court_addr" class="form-control" placeholder="Court Address"></textarea>
                                        </div>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="state" class="control-label col-md-3">State</label>
                                        <div class="col-md-6">
                                            <select name="court_state" class="form-control">
                                                <option>Select</option>
                                                <?php foreach($state_result as $state) { ?>
                                                <option value="<?php echo $state['state']; ?>"><?php echo $state['state']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Court Profile</label>
                                        <div class="col-sm-9">
                                            <textarea name="Court_Profile" placeholder="Court Profile" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                   <div class="form-group">
                                        <label class="control-label col-sm-3">Visible</label>
                                        <div class="col-sm-6">
                                            <select name="visible" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                    <button type="submit" class="btn btn-success" name="saveBtn">Save</button>
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
     
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
    
   
</body>
</html>
