<?php

include 'database.php';

$id = $_GET['id'];

$sql = "UPDATE user 
        SET status = 'approved' 
        WHERE id = $id";

mysqli_query($connection, $sql);

header("Location: notifications.php");
exit();

?>