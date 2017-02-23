<?php
require_once("config.php");

$uroles_query = "SELECT * FROM tbl_user_roles";
$uroles_result = mysqli_query($conn, $uroles_query) or die(mysqli_connect_error());

//$uroles = mysqli_fetch_assoc($suspects_result);
$uroles_count = mysqli_num_rows($uroles_result);

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
                    <div class="col-md-8">
                     <h2>User Group Roles</h2>
                        <h5></h5>
                    </div>
                    <div class="col-md-4">
                        <span class="icon-box bg-color-red set-icon">
                        </span>
                        <span class="icon-box bg-color-red set-icon">
                        </span>
                        <span class="icon-box bg-color-red set-icon">
                        </span>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    User Group Lists
                                    <span class="pull-right">
                                        <a href="add_user_roles.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Group Name</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($uroles_count === 0) { ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No User Roles found <a href="add_user_roles.php">Create New</a></td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php $sn=0; while($uroles=mysqli_fetch_assoc($uroles_result)) { $sn=$sn+1; ?>
                                            <?php // $sn=0; foreach($uroles_result as $uroles) { $sn=$sn+1; ?>
                                            <tr data-href="urole_details.php?a=viewdetails&t=urole&id<?php echo $uroles['usergroup_id']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $uroles['group_name']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=urole&id=<?php echo $uroles['usergroup_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_urole.php?a=edit&t=urole&id=<?php echo $uroles['usergroup_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
