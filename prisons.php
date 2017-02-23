<?php
require_once("config.php");
require_once("includes/icase_functions.php");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Warders</title>
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
                     <h2>Warders</h2>
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
                                    List Warders
                                    <span class="pull-right">
                                        <button class="btn btn-primary addWardersBtn">Create New</button>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <div class="">
                                    <table class="table table-bordered table-hover table-striped dataTable" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>#</th>
                                                <th>Warder Name</th>
                                                <th>Rank</th>
                                                <th>Sex</th>
                                                <th>Prison</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $get_warders = get_warders(); $length = mysqli_num_rows($get_warders); ?>
                                            <?php if($length === 0) { ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No Warder Found <a href="" class="addWardersBtn">Add New</a></td>
                                            </tr>
                                            <?php } else { ?>
                                            <?php $sn=0; while($warders=mysqli_fetch_assoc($get_warders)) { $sn=$sn+1; ?>
                                            <?php // $sn=0; foreach($ipo_result as $ipo) { $sn=$sn+1; ?>
                                            <tr data-href="suspect_details.php?a=viewdetails&t=ipo&id<?php echo $ipo['crno']; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $warders['ward_no']; ?></td>
                                                <td><?php echo $warders['ward_name']; ?></td>
                                                <td><?php echo $warders['ward_rank']; ?></td>
                                                <td><?php echo $warders['ward_gender']; ?></td>
                                                <td><?php echo ($prison = mysqli_fetch_assoc(get_prison($warders['prison_id']))) ?  $prison['prison_name'] : "None"; ?></td>
                                                <td>
                                                    <a href="delete.php?a=delete&t=warder&id=<?php echo $warders['ward_id']; ?>" onclick="return confirm('Are you sure you want to delete');"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="edit_warder.php?a=edit&t=warder&id=<?php echo $warders['ward_id']; ?>"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="warder_details.php?a=viewdetails&t=warder&id=<?php echo $warders['ward_id']; ?>"><i class="fa fa-search fa-2x"></i></a>&nbsp;
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
                
                <!-- ADD Warders Modal -->
<div class="modal fade" id="addWarders" tabindex="-1" role="dialog" aria-labelledby="addWardersLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addWardersLabel">Warder Details</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form" id="addWarderForm">
              <input type="hidden" name="susp_id" id="bailSuspID" value="">
              <input type="hidden" id="bailCRNO" name="crno" value="">
              
              <div class="form-group">
                  <label class="control-label col-md-4">Prison</label>
                  <div class="col-md-6">
                      <select name="prison_id" class="form-control">
                          <option>-- Select Prison --</option>
                          <?php $list_prison = get_prisons(); ?>
                          <?php $prison_count = mysqli_num_rows($list_prison); if($prison_count !== 0) { ?>
                          <?php while($prisons = mysqli_fetch_assoc($list_prison)) { ?>
                          <option value="<?php echo $prisons['prison_id']; ?>"><?php echo $prisons['prison_name']; ?></option>
                          <?php } } ?>
                      </select>
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">#</label>
                  <div class="col-md-6">
                      <input name="ward_no" class="form-control" placeholder="Warder Number">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Name</label>
                  <div class="col-md-6">
                      <input name="ward_name" class="form-control" placeholder="Warder Name">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Gender</label>
                  <div class="col-md-6">
                      <select name="ward_gender" class="form-control">
                          <option>-- Select Gender --</option>
                          <option value="Female">Female</option>
                          <option value="Male">Male</option>
                      </select>
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Rank</label>
                  <div class="col-md-6">
                      <input type="text" name="ward_rank" class="form-control" placeholder="Warder Rank">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="col-md-4 control-label">Is Warder Boss?</label>
                  <div class="col-md-6">
                      <label>
                          Yes <input type="radio" value="1" name="ward_boss"> No <input type="radio" value="0" name="ward_boss">
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-4">Picture</label>
                  <div class="col-md-2">
                      <input type="file" id="photo">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-8 col-md-offset-4">
                      <input type="hidden" name="ward_pix" id="imgData">
                      <img id="image" class="col-md-8">
                  </div>
              </div>
              <input type="hidden" value="true" name="submitWarder">
                
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="saveWarderBtn" name="saveWarderBtn" class="btn btn-primary"> Save </button>
      </div>
    </div>
  </div>
</div>
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
