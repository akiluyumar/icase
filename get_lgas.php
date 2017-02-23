<?php
include("config.php");

$field = $_POST['state'];
$query = "SELECT * FROM tbl_lgas WHERE state='$field'";
$result = mysqli_query($conn, $query) or die(mysqli_connect_error());

//$lgas = mysqli_fetch_assoc($result);
$count_lga = mysqli_num_rows($result);

if($count_lga !== 0) {
    foreach($result as $lga) {
        echo "<option value=\"{$lga['lga']}\">{$lga['lga']}</option>";
    }
}