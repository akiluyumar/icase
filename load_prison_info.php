<?php
require_once("config.php");

if(isset($_REQUEST['bailSuspect']) && isset($_REQUEST['bailCase'])) {
    $suspect = $_REQUEST['bailSuspect'];
    $case = $_REQUEST['bailCase'];

    $prison_query = "SELECT * FROM tbl_prisoner_file WHERE susp_id='$suspect' AND crno='$case'";
    $prison_result = mysqli_query($conn, $prison_query);
    
    $prison = mysqli_fetch_assoc($prison_result);
    $count_prison = mysqli_num_rows($prison_result);
}
?>

<?php if($count_prison !== 0) { ?>
<div class="form-group">
    <label class="control-label col-sm-4">Bailed Date</label>
    <div class="col-sm-6">
        <?php echo $rows['bail_date']; ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-4">Bailer Name</label>
    <div class="col-md-6">
        <?php echo $rows['bailer_name']; ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-4">Bail Approved By</label>
    <div class="col-sm-6">
        <?php echo $rows['bail_apprv_by']; ?>
    </div>
</div>
<?php } else { ?>
<p>No prison info or records entered</p>
<?php } ?>