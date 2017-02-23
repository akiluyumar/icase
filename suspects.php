<?php
require_once("config.php");

$suspects_query = "SELECT * FROM tbl_suspects";
$suspects_result = mysqli_query($conn, $suspects_query) or die(mysqli_connect_error());

//$suspects = mysqli_fetch_assoc($suspects_result);
$suspects_count = mysqli_num_rows($suspects_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Suspects</title>
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
                     <h2>Suspects</h2>
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
                                    Suspects Lists
                                    <span class="pull-right">
                                        <a href="add_suspect.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Suspect Name</th>
                                                <th>Sex</th>
                                                <th>Date</th>
                                                <th>Controls</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($suspects_count === 0) { ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Suspect found <a href="add_suspect.php">Create New</a></td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php $sn=0; while($suspects=mysqli_fetch_assoc($suspects_result)) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=suspect&id<?php echo $suspects['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $suspects['susp_name']; ?></td>
                                                <td><?php echo $suspects['susp_sex']; ?></td>
                                                <td><?php echo $suspects['susp_datereg']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=suspect&id=<?php echo $suspects['susp_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
<!--                                                    <a href="edit_suspect.php?a=edit&t=suspect&id=<?php //echo $suspects['susp_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;-->
                                                    <a href="suspect_details.php?a=viewdetails&t=suspect&id=<?php echo $suspects['susp_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
