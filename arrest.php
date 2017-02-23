<?php
session_start();

require_once("config.php");
require_once("includes/icase_functions.php");

if(isset($_GET['suspect'])) {
    $field = $_GET['suspect'];

    //Get suspect details
    $get_suspect = mysqli_query($conn, "SELECT * FROM tbl_suspects WHERE susp_id='$field'") or die(mysqli_connect_error());
    $suspect = mysqli_fetch_assoc($get_suspect);

    //Get Existing arrest details
    $arr_query = "SELECT * FROM tbl_arrests WHERE susp_id='$field'";
    $arr_result = mysqli_query($conn, $arr_query) or die(mysqli_connect_error());

    $arrest_count = mysqli_num_rows($arr_result);
    $arrest = mysqli_fetch_assoc($arr_result);
}
    $case = $_GET['case'];

if(isset($_POST['arrestBtn'])) {
    $case = $_POST['crno'];
    $arr_id = $_POST['arrid'];
    $susp_id = $_POST['susp_id'];
    $arrest_date = $_POST['arrest_date'];
    $arr_time = $_POST['arr_time'];
    $arrest_story  = $_POST['arrest_story'];
    $ipo = $_POST['ipo'];
    $arr_state = $_POST['arr_state'];
    $arr_location = $_POST['arr_location'];
    $remarks = $_POST['remarks'];
    
    if(empty($arr_id)) {
    $query = sprintf("INSERT INTO tbl_arrests(susp_id, arrest_date, arrest_story, ipo, arr_location, arr_state, remarks, arr_time) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
                            mysql_real_escape_string($susp_id),
                            mysql_real_escape_string($arrest_date),
                            mysql_real_escape_string($arrest_story),
                            mysql_real_escape_string($ipo),
                            mysql_real_escape_string($arr_location),
                            mysql_real_escape_string($arr_state),
                            mysql_real_escape_string($remarks),
                            mysql_real_escape_string($arr_time));
    } else if(!empty($arr_id)) {

    $query = sprintf("UPDATE tbl_arrests SET arrest_date='%s', arrest_story='%s', ipo='%s', arr_location='%s', arr_state='%s', remarks='%s', arr_time='%s' WHERE susp_id='$susp_id' AND arr_id='$arr_id'",
                            mysql_real_escape_string($arrest_date),
                            mysql_real_escape_string($arrest_story),
                            mysql_real_escape_string($ipo),
                            mysql_real_escape_string($arr_location),
                            mysql_real_escape_string($arr_state),
                            mysql_real_escape_string($remarks),
                            mysql_real_escape_string($arr_time));
    }

    $query_result = mysqli_query($conn, $query) or die(mysqli_connect_error());

    if($query_result) {
        header("Location: suspect_details.php?ra=credit&rt=arrest&rs=1&id={$susp_id}&crno={$case}");
    } else {
        $message = "Error! Operation failed";
        echo "<script>alert({$message});</script>";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Arrest</title>
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
                     <h2>Suspect's Arrests Details</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <br />
                
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="text-info">Now enter arrest details</h3>
                        <div class="media success">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object img-responsive" style="height:80px;" src="uploads/suspects/<?php echo $suspect['susp_photo']; ?>" alt="Suspect">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><?php echo $suspect['susp_name']; ?></h4>
                            <strong><?php echo $suspect['susp_nickname']; ?></strong>
                          </div>
                        </div>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Arrest Details
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
<!--                                    <input type="hidden" name="crno" value="<?php //echo $_GET['case']; ?>">-->
                                    <input type="hidden" name="arrid" <?php if($arrest_count !== 0) { ?> value="<?php echo $arrest['arr_id']; ?>" <?php } ?>>
                                    <input type="hidden" name="susp_id" value="<?php echo $field; ?>">
                                    <input type="hidden" name="crno" value="<?php echo $case; ?>">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="arrest_date" class="col-sm-12">Arrest Date</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" placeholder="YYYY-MM-DD" id="dob" data-date-format="yyyy-mm-dd" name="arrest_date" class="form-control" required <?php $arrdate = explode(" ", $arrest['arrest_date']); if($arrest_count !== 0) echo "value=\"{$arrdate[0]}\""; ?> />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="time" class="col-sm-12">Arrest Time</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="text" placeholder="HH:MM:SS" name="arr_time" class="time form-control" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" <?php if($arrest_count !== 0) echo "value=\"{$arrest['arr_time']}\""; ?> />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="arrest_story" class="col-sm-12">Arrest Story</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" name="arrest_story" placeholder="Arrest Story" class="form-control"><?php if($arrest_count !== 0) echo $arrest['arrest_story']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="ipo" class="col-sm-12">IPO</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="ipo" placeholder="IPO" <?php if($arrest_count !== 0) echo "value=\"{$arrest['ipo']}\""; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="arr_state" class="col-sm-12">Arrest State</label>
                                                <div class="col-sm-12">
                                                    <select id="txtstate" name='arr_state' class="form-control selectpicker" Required>
                                                        <option>-- Select Stste --</option>
                                                        <?php $list_state = get_states(); while($state = mysqli_fetch_assoc($list_state)) { ?>
                                                        <option value="<?php echo $state['state']; ?>"<?php if($arrest_count !== 0){ if($arrest['arr_state'] == $state['state']) { echo "selected"; } } ?>><?php echo $state['state']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="arr_location" class="col-sm-12">Arrest Location</label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Arrest Location" name="arr_location" class="form-control" <?php if($arrest_count !== 0) echo "value=\"{$arrest['arr_location']}\""; ?> />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="remarks" class="col-sm-12">Arrest Remark</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" name="remarks" placeholder="Arrest Remark" class="form-control"><?php if($arrest_count !== 0) echo $arrest['remarks']; ?></textarea>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                    <button type="submit" class="btn btn-success" name="arrestBtn">Save</button>
                                </div>
                            </div>
                            </form>
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
