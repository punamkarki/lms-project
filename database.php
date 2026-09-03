<?php
$connection = mysqli_connect("localhost", "root", "", "library_mgmt_system",4306);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>