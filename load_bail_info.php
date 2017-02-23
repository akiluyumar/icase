<?php
require_once("config.php");

if(isset($_REQUEST['bailSuspect']) && isset($_REQUEST['bailCase'])) {
    $suspect = $_REQUEST['bailSuspect'];
    $case = $_REQUEST['bailCase'];

    $bail_query = "SELECT * FROM tbl_bails WHERE susp_id='$suspect' AND crno='$case'";
    $bail_result = mysqli_query($conn, $bail_query);
    
    $bail = mysqli_fetch_assoc($bail_result);
    $count_bail = mysqli_num_rows($bail_result);
    
}
?>

<?php if($count_bail !== 0) { ?>
<div class="form-group">
    <label class="control-label col-sm-4">Bailed Date</label>
    <div class="col-sm-6">
        <?php echo $bail['bail_date']; ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-4">Bailer Name</label>
    <div class="col-md-6">
        <?php echo $bail['bailer_name']; ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-4">Bail Approved By</label>
    <div class="col-sm-6">
        <?php echo $bail['bail_apprv_by']; ?>
    </div>
</div>
<?php } else { ?>
<p>No Bail info or record found</p>
<?php } ?>