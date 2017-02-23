<?php
require_once("config.php");

$courts_query = "SELECT * FROM tbl_courts ";
//$courts_query = "SELECT a.*, b.judge_name FROM tbl_courts a outerjoin tbl_judges b on a.court_id = b.court_id";
//echo $courts_query;
$courts_result = mysqli_query($conn, $courts_query);

$courts_count = mysqli_num_rows($courts_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.court/1999/xhtml">
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
                    <div class="col-md-8">
                     <h2>Manage Courts</h2>
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
                                    courts
                                    <span class="pull-right">
                                        <a href="add_court.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <?php if($courts_count === 0) { ?>
                                    <div class="well text-center">No Court found <a href="add_court.php">Add New</a></div>
                                    <?php } else { ?>
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">S/N</th>
                                                <th>Court Name</th>
                                                <th>State</th>
                                                <th style="text-align:center;">C O N T R O L</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php // $sn=0; foreach($courts_result as $crt) { $sn=$sn+1; ?>
                                            <?php $sn=0; while($crt=mysqli_fetch_assoc($courts_result)) { $sn=$sn+1; ?>
                                            <tr data-href="court_details.php?a=viewdetails&t=court&id<?php echo $crt['court_id']; ?>">
                                                <td style="text-align:center;"><?php echo $sn; ?></td>
                                                <td><?php echo $crt['court_name']; ?></td>
                                                <td><?php echo $crt['court_state']; ?></td>
                                                <td style="text-align:center;">
                                                    <a href="delete.php?a=delete&t=court&id=<?php echo $crt['court_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_court.php?a=edit&t=court&id=<?php echo $crt['court_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="court_details.php?a=viewdetails&t=court&id=<?php echo $crt['court_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
