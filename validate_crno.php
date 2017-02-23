<?php
include("config.php");
$field = $_POST['crno'];

$query = mysqli_query($conn, "SELECT crno FROM tbl_casediary WHERE crno='$field'");
$count = mysqli_num_rows($query);

if($count === 0) {
    echo "<span class=\"text-danger\">Case with CRNO: {$field} not found</span>";
} else if($count !== 0) {
    echo "valid";
}