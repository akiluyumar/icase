<?php
require_once("config.php");

if(isset($_GET['a']) && $_GET['a'] == "edit" && isset($_GET['t']) && $_GET['t'] == "urole" && isset($_GET['id'])) {
    $field = $_GET['id'];
    
    $query = "SELECT * FROM tbl_user_roles WHERE usergroup_id='$field'";
    $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
    $user_role = mysqli_fetch_assoc($result);
    
}
    if(isset($_POST['roleBtn'])) {
        $groupid = $_POST['groupid'];
        $grpname = $_POST['group_name'];
        $remark = $_POST['remark'];
        
        $can_add = ($_POST['can_add'] == "1") ? "1" : "0";
        $can_adm = ($_POST['can_adm'] == "1") ? "1" : "0";
        $can_edit = ($_POST['can_edit'] == "1") ? "1" : "0";
        $can_del = ($_POST['can_del'] == "1") ? "1" : "0";
        $police_mdl = ($_POST['police_mdl'] == "1") ? "1" : "0";
        $moj_mdl = ($_POST['moj_mdl'] == "1") ? "1" : "0";
        $court_mdl = ($_POST['court_mdl'] == "1") ? "1" : "0";
        $prisons_mdl = ($_POST['prisons_mdl'] == "1") ? "1" : "0";
        $desk_officer = ($_POST['desk_officer'] == "1") ? "1" : "0";
        
        
        $update_query = "UPDATE tbl_user_roles SET group_name='$grpname', can_admin='$can_adm', can_add='$can_add', can_edit='$can_edit', can_del='$can_del', group_remark='$remark', police_modl='$police_mdl', prisons_modl='$prisons_mdl', moj_modl='$moj_mdl', court_modl='$court_mdl', desk_officer='$desk_officer' WHERE usergroup_id='$groupid'";
        
        $update_result = mysqli_query($conn, $update_query) or die(mysqli_connect_error());

        if($update_result) {
            header("Location: uroles.php?a=edit&t=uroles&s=1");
        } else {
            header("Location: uroles.php?a=edit&t=uroles&s=0");
        }
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : User Roles</title>
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
                     <h2>Manage User Roles</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Manage Roles
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <form method="post" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                
                            <div class="panel-body">
                                <input type="hidden" name="groupid" value="<?php echo $user_role['usergroup_id']; ?>">
                                <div class="form-group">
                                    <label for="group_name" class="col-sm-3 control-label">Group Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="group_name" class="form-control" id="group_name" value="<?php echo $user_role['group_name']; ?>">
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Roles</label>
                                    <div class="col-sm-offset-3 col-sm-10">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="can_adm" <?php if($user_role['can_admin'] == "1") { echo "checked"; } ?>> Can Admin
                                        </label>
                                      </div>
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="can_add" <?php if($user_role['can_add'] == "1") { echo "checked"; } ?>> Can Add
                                        </label>
                                      </div>
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="can_edit" <?php if($user_role['can_edit'] == "1") { echo "checked"; } ?>> Can Edit
                                        </label>
                                      </div>
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="can_del" <?php if($user_role['can_del'] == "1") { echo "checked"; } ?>> Can Delete
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                
                                  <div class="form-group">
                                    <label for="remark" class="col-sm-3 control-label">Remark</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="remark" name="remark"><?php echo $user_role['group_remark']; ?></textarea>
                                    </div>
                                  </div>
                                    
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Assign to Module</label>
                                    <div class="col-sm-offset-3 col-sm-10">
                                        <div class="checkbox">
                                            <label for="police_mdl" class="control-label">
                                                <input type="checkbox" name="police_mdl" value="1" <?php if($user_role['police_modl'] == "1") { echo "checked"; } ?>> Police
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label for="moj_mdl" class="control-label">
                                                <input type="checkbox" name="moj_mdl" value="1" <?php if($user_role['moj_modl'] == "1") { echo "checked"; } else {} ?>> Ministry of Justice
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label for="court_mdl" class="control-label">
                                                <input type="checkbox" name="court_mdl" value="1" <?php if($user_role['court_modl'] == "1") { echo "checked"; } ?>> Court
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label for="prisons_mdl" class="control-label">
                                                <input type="checkbox" name="prisons_mdl" value="1" <?php if($user_role['prisons_modl'] == "1") { echo "checked"; } ?>> Prisons
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label for="desk_officer" class="control-label">
                                                <input type="checkbox" name="desk_officer" value="1" <?php if($user_role['desk_officer'] == "1") { echo "checked"; } ?>> Desk Officer<span class="help-block">Check if Yes</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-3">
                                        <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                        <button type="submit" class="btn btn-success" name="roleBtn">Save</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel-footer">
                            </div>
                                
                            </form>
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
    </div>
    
   
</body>
</html>
