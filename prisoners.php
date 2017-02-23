<?php
require_once("config.php");

$prisoners_query = "SELECT * FROM tbl_prisoner_file";
$prisoners_result = mysqli_query($conn, $prisoners_query) or die(mysqli_connect_error());

//$suspects = mysqli_fetch_assoc($suspects_result);
$prisoners_count = mysqli_num_rows($prisoners_result);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Prisoners</title>
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
                     <h2>Prisoners</h2>
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
                                    Prisoners Lists
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Case</th>
                                                <th>Prisoner Name</th>
                                                <th>Prison Name</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($prisoners_count === 0) { ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Prisoner found </td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php $sn=0; while($prisoners = mysqli_fetch_assoc($prisoners_result)) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=suspect&id<?php echo $suspects['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $prisoners['crno']; ?></td>
                                                <td>
                                                    <?php $get_suspect = mysqli_query($conn, "SELECT susp_name FROM tbl_suspects WHERE susp_id='$prisoners[susp_id]'"); $row = mysqli_fetch_assoc($get_suspect); echo $row['susp_name']; ?>
                                                </td>
                                                <td><?php $get_suspect = mysqli_query($conn, "SELECT prison_name FROM tbl_prisons WHERE prison_id='$prisoners[prison_id]'"); $row = mysqli_fetch_assoc($get_suspect); echo $row['prison_name']; ?></td>
                                                <td><?php $get_suspect = mysqli_query($conn, "SELECT susp_sex FROM tbl_suspects WHERE susp_id='$prisoners[susp_id]'"); $row = mysqli_fetch_assoc($get_suspect); echo $row['susp_sex']; ?></td>
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
