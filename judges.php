<?php
require_once("config.php");

$jdg_query = "SELECT a.*, b.court_name FROM tbl_judges a, tbl_Courts b where a.court_id=b.court_id ";
$jdg_result = mysqli_query($conn, $jdg_query) or die(mysqli_connect_error());

//$jdg = mysqli_fetch_assoc($suspects_result);
$jdg_count = mysqli_num_rows($jdg_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Judge</title>
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
                     <h2>Judges</h2>
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
						<?php if($jdg_count === 0) { ?>
						<tr>
							<td colspan="7" class="text-center">No Judge found <a href="add_Judge.php">Add Judge</a></td>
						</tr>
						<?php } else { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    List of Judges
                                    <span class="pull-right">
                                        <a href="#" class="btn btn-primary">Add Judge</a>
                                      <!--  <a href="add_Judge.php" class="btn btn-primary">Add New Judge</a> -->
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Judge Name</th>
                                                <th>File No</th>
                                                <th>Gender</th>
                                                <th>Court</th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn=0; while($jdg=mysqli_fetch_assoc($jdg_result)) { $sn=$sn+1; ?>
                                            <?php // $sn=0; foreach($jdg_result as $jdg) { $sn=$sn+1; ?>
                                            <tr data-href="judge_details.php?a=viewdetails&t=jdg&id<?php echo $jdg['judge_id']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $jdg['judge_name']; ?></td>
                                                <td><?php echo $jdg['judge_no']; ?></td>
                                                <td><?php echo $jdg['gender']; ?></td>
                                                <td><?php echo $jdg['court_name']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=judge&id=<?php echo $jdg['judge_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_judge.php?a=edit&t=judge&id=<?php echo $jdg['judge_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="Judge_details.php?a=viewdetails&t=judge&id=<?php echo $jdg['judge_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
