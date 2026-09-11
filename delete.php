<?php

include 'database.php';

if (!isset($_GET['id'])) {
    die("Student ID is missing.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM user WHERE id = $id AND role = 'student'";

if (mysqli_query($connection, $sql)) {

    header("Location: students.php");
    exit();

} else {

    echo "Error deleting student: " . mysqli_error($connection);

}

?>