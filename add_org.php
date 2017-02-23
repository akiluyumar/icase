<?php
require_once("config.php");

//List Organization [Selection]
$moj_query = mysqli_query($conn, "SELECT * FROM tbl_moj") or die(mysqli_connect_error());

//Select organization head from users table
$orghead_query = mysqli_query($conn, "SELECT * FROM tbl_users") or die(mysqli_connect_error());

$state_query = "SELECT * FROM tbl_states";
$state_result = mysqli_query($conn, $state_query) or die(mysqli_connect_error());

if(isset($_POST['saveBtn'])) {
    $org_name = $_POST['org_name'];
    $org_acronym = $_POST['org_acronym'];
    $org_addr = $_POST['org_addr'];
    $org_head = $_POST['org_head'];
    $head_gsm = $_POST['head_gsm'];
    $state = $_POST['state'];
    $head_email = $_POST['head_email'];
    $org_moj = $_POST['org_moj'];
    $org_profile = $_POST['org_profile'];
    $org_remark = $_POST['org_remark'];
    $visible = $_POST['visible'];
    $timestamp = date('Y-m-d');
    
//    $pic = $_FILES['photo']['name'];
//    $photo = date('ymd').time().$pic;
    
    
    $create_query = "INSERT INTO tbl_orgs(org_name, org_acronym, org_addr, org_head, org_head_gsm, org_head_email, org_moj, org_profile, org_remark, date_added, visible, org_state) VALUES ('$org_name', '$org_acronym', '$org_addr', '$org_head', '$head_gsm', '$head_email', '$org_moj', '$org_profile', '$org_remark', '$timestamp', '$visible', '$state')";
    $create_result = mysqli_query($conn, $create_query) or die(mysqli_connect_error());
    
    if($create_result) {
        //copy($_FILES['photo']['tmp_name'], "uploads/orgs/".$photo);
        header("Location: orgs.php?a=create&t=orgs&s=1");
    } else {
        header("Location: orgs.php?a=create&t=orgs&s=0");
    }
}

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
                     <h2>Manage Organizations</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Add New Organization
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4">Organization Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="org_name" class="form-control" placeholder="Organization Name">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4">Acronym</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="org_acronym" class="form-control" placeholder="Organization Acronym">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address</label>
                                        <div class="col-sm-9">
                                            <textarea name="org_addr" class="form-control" placeholder="Organization Address"></textarea>
                                        </div>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="state" class="control-label col-md-3">State</label>
                                        <div class="col-md-3">
                                            <select name="state" class="form-control">
                                                <option>Select</option>
                                                <?php foreach($state_result as $state) { ?>
                                                <option value="<?php echo $state['state']; ?>"><?php echo $state['state']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Head</label>
                                        <div class="col-sm-5">
                                            <select name="org_head" class="form-control">
                                                <?php while($head = mysqli_fetch_assoc($orghead_query)) { ?>
                                                <option value="<?php echo $head['file_no']; ?>"><?php echo $head['fullname']; ?> ( <?php echo $head['file_no']; ?> )</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ORg. Head GSM</label>
                                        <div class="col-sm-5">
                                            <input type="tel" name="head_gsm" class="form-control" placeholder="07030311329">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Org. Head Email</label>
                                        <div class="col-sm-5">
                                            <input type="email" name="head_email" class="form-control" placeholder="email@example.com">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Send Casefiles to</label>
                                        <div class="col-sm-5">
                                            <select name="org_moj" class="form-control">
                                                <?php while($mojs = mysqli_fetch_assoc($moj_query)) { ?>
                                                <option value="<?php echo $mojs['moj_id']; ?>"><?php echo $mojs['moj_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Organization Profile</label>
                                        <div class="col-sm-9">
                                            <textarea name="org_profile" class="form-control" placeholder="Organization Profile"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Visible</label>
                                        <div class="col-sm-3">
                                            <select name="visible" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Remark</label>
                                        <div class="col-sm-9">
                                            <textarea name="org_remark" placeholder="Organization Remark" class="form-control"></textarea>
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
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
    
   
</body>
</html>
