<?php
require_once("config.php");

$orgs_query = "SELECT * FROM tbl_orgs";
$orgs_result = mysqli_query($conn, $orgs_query) or die(mysqli_connect_error());

//$ipo = mysqli_fetch_assoc($suspects_result);
$orgs_count = mysqli_num_rows($orgs_result);

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
                    <div class="col-md-8">
                     <h2>Manage Organizations</h2>
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
                                    Organizations
                                    <span class="pull-right">
                                        <a href="add_org.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                            <?php if($orgs_count === 0) { ?>
                                            <div class="well text-center">No Organization found <a href="add_org.php">Add New</a></div>
                                            <?php } else { ?>
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Organization Name</th>
                                                <th>Acronym</th>
                                                <th>Head</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php // $sn=0; foreach($orgs_result as $orgs) { $sn=$sn+1; ?>
                                            <?php $sn=0; while($orgs=mysqli_fetch_assoc($orgs_result)) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=ipo&id<?php echo $orgs['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $orgs['org_name']; ?></td>
                                                <td><?php echo $orgs['org_acronym']; ?></td>
                                                <td><?php echo $orgs['org_head']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=org&id=<?php echo $orgs['org_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_org.php?a=edit&t=org&id=<?php echo $orgs['org_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="org_details.php?a=viewdetails&t=org&id=<?php echo $orgs['org_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
