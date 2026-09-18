<?php

include 'database.php';

if (!isset($_GET['id'])) {
    die("Teachers ID is missing.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM user WHERE id = $id AND role = 'teacher'";

if (mysqli_query($connection, $sql)) {

    header("Location: teachers.php");
    exit();

} else {

    echo "Error deleting student: " . mysqli_error($connection);

}

?>