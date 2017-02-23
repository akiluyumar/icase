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

//Fetch tp teams to assign cases to
$case_to_teams = mysqli_query($conn, "SELECT * FROM tbl_teams") or die(mysqli_connect_error());

//Fetch Case Trails / Logs
$casetrails_query = mysqli_query($conn, "SELECT * FROM tbl_case_log WHERE crno='$field' ORDER BY time_date_sent DESC LIMIT 5");
$casetrail_count = mysqli_num_rows($casetrails_query);


    
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
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3>
                                    <label class="control-label">[ <?php echo $casediary['crno']; ?> ]</label>
                                    <span class="pull-right">
                                        <a href="add_casediary.php" class="btn btn-primary">Create New</a>&nbsp;
                                        <a href="casediary.php" class="btn btn-primary">List Cases</a>
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
                                <!--
                                <div class="form-group">
                                    <label class="col-sm-2">Visible</label>
                                    <div class="col-sm-5">
                                        <?php // if($casediary['visible'] == "1") { echo "Yes"; } else { echo "No"; } ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2">Archive</label>
                                    <div class="col-sm-5">
                                        <?php // if($casediary['archive'] == "1") { echo "Yes"; } else { echo "No"; } ?>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Investigation Reports</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php if(!empty($casediary['police_report'])) { 
                                 echo $casediary['police_report'];
                                } else { echo "No Report"; } ?>
                            </div>
                        </div>
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Support Documents</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php if($casedocs_count === 0) { ?>
                                No Document(s) attached <a href="documents.php?a=upload&t=case&case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-upload"></i> Upload a document</a>
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
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Suspects</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php if($suspect_count === 0) { ?>
                                No suspect recorded <a href="add_suspect.php?case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-plus"></i> Add Suspects</a>
                                <?php } ?>
                                <?php // foreach($susp_result as $suspects) { ?>
                                <?php while($suspects=mysqli_fetch_assoc($susp_result)) { ?>
                                <div class="media media-default">
                                  <div class="media-left">
									<a href="suspect_details.php?a=viewdetails&t=suspect&id=<?php echo $suspects['susp_id']; ?>&crno=<?php echo $casediary['crno']; ?>">
                                    <!-- <a href="#"> -->
                                      <img class="media-object" style="height:64px;" src="uploads/suspects/<?php echo $suspects['susp_photo']; ?>" alt="...">
                                    </a>
                                  </div>
                                  <div class="media-body">
                                    <h4 class="media-heading"><?php echo $suspects['susp_name']; ?></h4>
                                    <a onclick="return confirm('Are you sure you want to delete this suspect');" href="delete.php?case=<?php echo $casediary['crno']; ?>&a=delete&t=casesuspect&id=<?php echo $suspects['susp_id']; ?>">Delete</a>
                                  </div>
                                </div>
                                <?php } ?>
                                <?php if($suspect_count !== 0) { ?>
                                <a href="add_suspect.php?case=<?php echo $casediary['crno']; ?>" class="pull-right"><i class="fa fa-plus"></i> Add More Suspects</a>
                                <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Administration</h3>
                            </div>
                            
                            <div class="panel-body">
                                
                                <?php //Please remember to check if user role is equal to administrator here ?>
                                <?php if(!empty($casediary['team'])) { ?>
                                <div class="form-group">
                                    <label class="col-sm-5">Team Assigned to</label>
                                    <div class="col-sm-7" id="teamName" data-team="team" data-crno="<?php echo $field; ?>">
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(empty($casediary['team'])) { ?>
                                <div id="caseTeamsRes"></div>
                                <div class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <input type="hidden" id="caseno" value="<?php echo $field; ?>">
                                        <label class="control-label col-sm-4">Assign to Team</label>
                                        <div class="col-sm-8">
                                            <select id="assign_to_team" class="form-control">
                                                <?php while($caseteams = mysqli_fetch_assoc($case_to_teams)) { ?>
                                                <option value="<?php echo $caseteams['team_name']; ?>"><?php echo $caseteams['team_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button type="button" id="assignBtn" class="btn btn-primary">Assign</button>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Current Case Location / Status</h3>
                            </div>
                            <?php 
                            $getorg_query = mysqli_query($conn, "SELECT org_name, org_id FROM tbl_orgs WHERE org_id='$casediary[org_id]'") or die(mysqli_connect_error());
                            $org = mysqli_fetch_assoc($getorg_query);
                            ?>
                            
                            <div class="panel-body">
                                <div id="fwdResult" role="form" class="form-horizontal"></div>
                                <div class="form-horizontal" role="form">
                                    <input type="hidden" id="getCaseOrg" value="<?php echo $org['org_name']; ?>">
                                    <input type="hidden" id="getCaseOrgID" value="<?php echo $org['org_id']; ?>">
                                    <input type="hidden" id="getCaseState" value="<?php echo $casediary['case_state']; ?>">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Forward to</label>
                                        <div class="col-sm-8">
                                            <select id="getCaseModl" class="form-control">
                                                <option>Select Module</option>
                                                <option value="POLICE">Police</option>
                                                <option value="MINISTRY">Ministry of Justice</option>
                                                <option value="COURT">Court</option>
                                                <option value="PRISONS">Prisons</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button id="okayBtn" class="btn btn-primary">Okay</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Discussions/Case Progress</h3>
                            </div>
                            
                            <div class="panel-body" id="caseLogTrail" style="background-color:#DFDEE3;">
                                
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <?php $i=0; while($casetrail = mysqli_fetch_assoc($casetrails_query)) { $i=$i+1; 
												echo "<tr";
												if (fmod($i,2)==0){echo " bgcolor=\"#E8E7E6\" !important";}
												echo ">";
											?>
												<td>
                                                    <p>
                                    <strong class="text-success"><?php echo $casetrail['sent_from_modl']; ?> to <?php echo $casetrail['sent_to_modl']; ?></strong>
                                    <small class="help-block pull-right">Date: <?php echo $casetrail['time_date_sent']; ?></small><br />
                                    <?php echo $casetrail['sent_message']; ?>
                                </p>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                            </div>
                            <div class="panel-footer">
                                <a href="#" class="pull-right">More Discussions</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
               
    </div>
             <!-- /. PAGE INNER  -->
    
    <!-- Modal -->
<div class="modal fade" id="fwdModal" tabindex="-1" role="dialog" aria-labelledby="fwdModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="fwdModalLabel">Forward Case to</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form">
              <div class="form-group">
                  <label class="control-label col-sm-4">CRNO</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="crno" value="<?php echo $field; ?>">
                  </div>
              </div>
              
              <!-- Forwarding From -->
              <input type="hidden" id="fromModlID">
              <div class="form-group">
                  <label class="control-label col-sm-4">From</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="fromModl">
                  </div>
              </div>
              <!-- Forwarding To -->
              <input type="hidden" id="toModl">
              <div class="form-group">
                <label class="control-label col-sm-4">To</label>
                <div class="col-sm-8">
                    <select id="toModlID" class="form-control">
                    </select>
                </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-sm-4">Message</label>
                  <div class="col-sm-8">
                      <textarea id="fwdMsg" class="form-control" rows="7"></textarea>
                  </div>
              </div>
              
              <div class="form-group">
                  <div class="col-sm-offset-4">
                      <label class="control-label">
                          <input type="checkbox" id="fwdPrivate" value="1"> Private Message
                      </label>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="fwdCaseBtn" class="btn btn-primary">Forward</button>
      </div>
    </div>
  </div>
</div>
    
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
    

</body>
</html>
