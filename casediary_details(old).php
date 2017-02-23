<?php
require_once("config.php");

//if((isset($_GET['a'])) && ($_GET['a'] == "viewdetails") && (isset($_GET['t'])) && ($_GET['t'] == "casediary") && (isset($_GET['id']))) {
    
    $field = $_GET['id'];
    
    $fetch_query = "SELECT * FROM tbl_casediary WHERE crno='$field' LIMIT 1";
    $fetch_result = mysqli_query($conn, $fetch_query) or die(mysqli_connect_error());

    $casediary = mysqli_fetch_assoc($fetch_result);
    
    //Get Suspects
    //$susp_query = "SELECT * FROM tbl_suspects WHERE susp_id IN(SELECT susp_id FROM tbl_arrests  WHERE crno='$field')";
    $susp_query = "SELECT * FROM tbl_suspects WHERE crno='$field'";
    $susp_result = mysqli_query($conn, $susp_query) or die(mysqli_connect_error());
    
    //$suspects = mysqli_fetch_assoc($susp_result);
    $suspect_count = mysqli_num_rows($susp_result);
    
    //Get Case Docs
    $casedocs_query = "SELECT * FROM tbl_case_docs WHERE crno='$field'";
    $casedocs_result = mysqli_query($conn, $casedocs_query) or die(mysqli_connect_error());

    $casedocs_count = mysqli_num_rows($casedocs_result);

  
//} else {
//    header("Location: casediary.php?a=wrong_link");
//}

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
                    <div class="col-md-12">
                     <h2>Case Diary</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Case <label class="control-label">[ <?php echo $casediary['crno']; ?> ]</label> Details
                                    <span class="pull-right">
                                        <a href="add_casediary.php" class="btn btn-primary">Create New</a>&nbsp;
                                        <a href="casediary.php" class="btn btn-primary">List All Casediaries</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2">CRNO</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['crno']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Team</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['team']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Case Date</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['casedate']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Case Title</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['casetitle']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Offences</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['offences']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Nature of Offence</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['nature_of_offence']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Items Recovered</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['items_recovered']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Send Case to</label>
                                    <div class="col-sm-5">
                                        <?php if($casediary['send_case_to'] == "MoJ") { echo "Ministry of Justice"; } else { echo $casediary['send_case_to']; } ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Case Officer</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['invest_offr']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Case Location</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['case_location']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Case State</label>
                                    <div class="col-sm-5">
                                        <?php echo $casediary['case_state']; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Visible</label>
                                    <div class="col-sm-5">
                                        <?php if($casediary['visible'] == "1") { echo "Yes"; } else { echo "No"; } ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Archive</label>
                                    <div class="col-sm-5">
                                        <?php if($casediary['archive'] == "1") { echo "Yes"; } else { echo "No"; } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Administration</h3>
                            </div>
                            
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Support Documents</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php if($casedocs_count === 0) { ?>
                                No Document(s) for this case  <a href="documents.php?a=upload&t=case&case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-upload"></i> Upload a document</a>
                                <?php } else { ?>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Document Title</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php // foreach($casedocs_result as $doc) { ?>
                                        <?php while($doc=mysqli_fetch_assoc($casedocs_result)) { ?>
                                        <tr>
                                            <td><?php echo $doc['doc_title']; ?></td>
                                            <td><a href="delete.php?a=delete&t=casedoc&id=<?php echo $doc['doc_id']; ?>&case=<?php echo $doc['crno']; ?>"><i class="fa fa-trash"></i></a> | <a href="uploads/docs/<?php echo $doc['doc_location']; ?>" target="_blank">View</a></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if($casedocs_count !== 0) { ?>
                                <a href="documents.php?a=upload&t=case&case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-upload"></i>Upload More</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Suspects</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php if($suspect_count === 0) { ?>
                                No suspect yet for this case <a href="add_suspect.php?case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-plus"></i> Add Suspects</a>
                                <?php } ?>
                                <?php // foreach($susp_result as $suspects) { ?>
                                <?php while($suspects=mysqli_fetch_assoc($susp_result)) { ?>
                                <div class="media media-default">
                                  <div class="media-left">
                                    <a href="#">
                                      <img class="media-object" style="height:64px;" src="uploads/suspects/<?php echo $suspects['susp_photo']; ?>" alt="...">
                                    </a>
                                  </div>
                                  <div class="media-body">
                                    <h4 class="media-heading"><?php echo $suspects['susp_name']; ?></h4>
                                    <a href="delete.php?a=delete&t=suspect&id=<?php echo $suspects['susp_photo']; ?>">Delete</a>
                                  </div>
                                </div>
                                <?php } ?>
                                <?php if($suspect_count !== 0) { ?>
                                <a href="add_suspect.php?case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-plus"></i> Add More Suspects</a>
                                <?php } ?>
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
