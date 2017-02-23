<?php
require_once("config.php");

$mojs_query = "SELECT * FROM tbl_moj";
$mojs_result = mysqli_query($conn, $mojs_query) or die(mysqli_connect_error());

//$ipo = mysqli_fetch_assoc($suspects_result);
$mojs_count = mysqli_num_rows($mojs_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Ministries</title>
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
                     <h2>Manage Ministries</h2>
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
                                    Ministries
                                    <span class="pull-right">
                                        <a href="add_moj.php" class="btn btn-primary">Add New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                            <?php if($mojs_count === 0) { ?>
                                            <div class="well text-center">No Ministry found <a href="add_moj.php">Add New</a></div>
                                            <?php } else { ?>
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">S/N</th>
                                                <th>Ministry</th>
                                                <th>State</th>
                                                <th>Head</th>
                                                <th style="text-align:center;">C O N T R O L</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php // $sn=0; foreach($mojs_result as $mojs) { $sn=$sn+1; ?>
                                            <?php $sn=0; while($mojs=mysqli_fetch_assoc($mojs_result)) { $sn=$sn+1; ?>
                                            <tr data-href="moj_details.php?a=viewdetails&t=moj&id<?php echo $mojs['moj_id']; ?>">
                                                <td style="text-align:center;"><?php echo $sn; ?></td>
                                                <td><?php echo $mojs['moj_name']; ?></td>
                                                <td><?php echo $mojs['moj_state']; ?></td>
                                                <td><?php echo $mojs['moj_head']; ?></td>
                                                <td style="text-align:center;">
                                                    <a href="delete.php?a=delete&t=moj&id=<?php echo $mojs['moj_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_org.php?a=edit&t=moj&id=<?php echo $mojs['moj_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="moj_details.php?a=viewdetails&t=moj&id=<?php echo $mojs['moj_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
