<?php

$host = "localhost";
$db = "icase";
$user = "root";
$password = "wakayi";

$conn = mysqli_connect($host, $user, $password) or die(mysqli_connect_error());

mysqli_select_db($conn, $db);