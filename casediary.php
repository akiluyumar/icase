<?php
require_once("config.php");
include("includes/icase_functions.php");

$casediary_query = "SELECT tbl_casediary.*, tbl_orgs.org_name, tbl_orgs.org_acronym FROM tbl_casediary, tbl_orgs  where tbl_casediary.org_id = tbl_orgs.org_id ";
$casediary_result = mysqli_query($conn, $casediary_query) or die(mysqli_connect_error());

//$casediaries = mysqli_fetch_assoc($casediary_result);
$casediary_count = mysqli_num_rows($casediary_result);

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
                    <div class="col-md-8">
                     <h2>Case Diary</h2>
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
                                    All Cases
                                    <span class="pull-right">
                                        <a href="add_casediary.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>CRNO</th>
                                                <th>Case Title</th>
                                                <th>Created by</th>
                                                <th>Date</th>
                                                <th>File Location</th>
                                                <th>Date Sent</th>
                                                <th>Admin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($casediary_count === 0) { ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Casediary found <a href="add_casediary.php">Create New</a></td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php while($casediaries=mysqli_fetch_assoc($casediary_result)) { ?>
                                            <?php // foreach($casediary_result as $casediaries) { ?>
                                            <tr data-href="details.php?a=viewdetails&t=casediary&id<?php echo $casediaries['crno']; ?>">
                                                <td><?php echo $casediaries['crno']; ?></td>
                                                <td><?php echo $casediaries['casetitle']; ?></td>
                                                <!-- <td><?php //echo $casediaries['case_location']; ?></td> -->
                                                <td><?php echo $casediaries['org_acronym']; ?></td>
                                                <td><?php echo $casediaries['casedate']; ?></td>
                                                <td>
                                                    <?php
                                                    $module = get_modl($casediaries['fileloc_modl'], $casediaries['fileloc']);
                                                    echo "{$module['name']}, {$module['state']}";
                                                ?>
                                                </td>
                                                <td><?php echo $casediaries['fileloc_date']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=casediary&id=<?php echo $casediaries['crno']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_casediary.php?a=edit&t=casediary&id=<?php echo $casediaries['crno']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="casediary_details.php?a=viewdetails&t=casediary&id=<?php echo $casediaries['crno']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
