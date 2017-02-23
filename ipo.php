<?php
require_once("config.php");

$ipo_query = "SELECT * FROM tbl_ipos";
$ipo_result = mysqli_query($conn, $ipo_query) or die(mysqli_connect_error());

//$ipo = mysqli_fetch_assoc($suspects_result);
$ipo_count = mysqli_num_rows($ipo_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : IPOs</title>
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
                     <h2>IPOs</h2>
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
                                    IPO Lists
                                    <span class="pull-right">
                                        <a href="add_ipo.php" class="btn btn-primary">Create New</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>IPO Name</th>
                                                <th>Rank</th>
                                                <th>Sex</th>
                                                <th>Station</th>
                                                <th>Dept</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($ipo_count === 0) { ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No IPO found <a href="add_suspect.php">Add New</a></td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php $sn=0; while($ipo=mysqli_fetch_assoc($ipo_result)) { $sn=$sn+1; ?>
                                            <?php // $sn=0; foreach($ipo_result as $ipo) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=ipo&id<?php echo $ipo['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $ipo['ipo_name']; ?></td>
                                                <td><?php echo $ipo['ipo_rank']; ?></td>
                                                <td><?php echo $ipo['ipo_gender']; ?></td>
                                                <td><?php echo $ipo['ipo_station']; ?></td>
                                                <td><?php echo $ipo['ipo_dept']; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=ipo&id=<?php echo $ipo['ipo_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_ipo.php?a=edit&t=ipo&id=<?php echo $ipo['ipo_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="ipo_details.php?a=viewdetails&t=ipo&id=<?php echo $ipo['ipo_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
