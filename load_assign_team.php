<?php
require_once("config.php");


$field = $_REQUEST['cid'];

$query = mysqli_query($conn, "SELECT team, team_received, team_assigned_date FROM tbl_casediary WHERE crno='$field'") or die(mysqli_connect_error());

$team_count = mysqli_num_rows($query);
$team = mysqli_fetch_assoc($query);

?>
<?php //Please remember to check if user role is equal to administrator here ?>
<?php if(!empty($team['team'])) { ?>
<?php if($team_count !== 0) { ?>

<div class="form-horizontal" role="form">
<div class="form-group">
    <label class="col-sm-5">Date Assigned</label>
    <div class="col-sm-7">
        <?php echo $team['team_assigned_date']; ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-5">Team Assigned to</label>
    <div class="col-sm-7">
        <?php echo $team['team']; ?>
        <?php if($team['team_received'] !== "1") { echo "
[ <strong class=\"text-success\">Pending Approval</strong> ]"; } ?>
    </div>
</div>
</div>
<?php if($team['team_received'] !== "1") { ?>
<p class="pull-right">
    <?php $calcDate =  date_add(date_create($team['team_assigned_date']), date_interval_create_from_date_string("10 days")); $resultDate = date_format($calcDate, "Y-m-d"); ?>
    <a href="#" class="btn <?php if($resultDate >= date('Y-m-d')) { echo "btn-danger"; } else { echo "btn-info"; } ?>" role="button">Revoke</a>
    
</p>
<?php } } } ?>