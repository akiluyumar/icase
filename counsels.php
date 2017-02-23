<?php
require_once("config.php");

$cnsl_query = "SELECT * FROM tbl_counsels";
$cnsl_result = mysqli_query($conn, $cnsl_query) or die(mysqli_connect_error());

//$cnsl = mysqli_fetch_assoc($suspects_result);
$cnsl_count = mysqli_num_rows($cnsl_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Counsela</title>
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
                     <h2>Counsel</h2>
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
					<!---   **************** -->
						<?php if($cnsl_count === 0) { ?>
						<tr>
							<td colspan="7" class="text-center">No Counsel found <a href="add_counsel.php">Add New</a></td>
						</tr>
						<?php } else { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    List of Counsel
                                    <span class="pull-right">
                                        <a href="#" class="btn btn-primary">Add New Counsel</a>
                                      <!--  <a href="add_counsel.php" class="btn btn-primary">Add New Counsel</a> -->
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Counsel Name</th>
                                                <th>Enrolment No</th>
                                                <th>Gender</th>
                                                <th>Office</th>
                                                <th></th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn=0; while($cnsl=mysqli_fetch_assoc($cnsl_result)) { $sn=$sn+1; ?>
                                            <?php // $sn=0; foreach($cnsl_result as $cnsl) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=cnsl&id<?php echo $cnsl['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $cnsl['cnsl_name']; ?></td>
                                                <td><?php echo $cnsl['enrolmentno']; ?></td>
                                                <td><?php echo $cnsl['cnsl_gender']; ?></td>
                                                <td><?php echo $cnsl['moj_id']; ?></td>
                                                <td><?php //echo $cnsl['cnsl_dept']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=counsel&id=<?php echo $cnsl['counsel_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_counsel.php?a=edit&t=counsel&id=<?php echo $cnsl['counsel_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="counsel_details.php?a=viewdetails&t=counsel&id=<?php echo $cnsl['counsel_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
