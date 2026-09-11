<?php
include 'admin_head.php';
include 'database.php';

$sql = "SELECT * FROM user WHERE role = 'student' ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

$total_sql = "SELECT COUNT(*) AS total FROM user WHERE role = 'student'";
$total_result = mysqli_query($connection, $total_sql);
$total_students = mysqli_fetch_assoc($total_result)['total'];

$pending_sql = "SELECT COUNT(*) AS pending FROM user 
                WHERE role = 'student' AND status = 'pending'";
$pending_result = mysqli_query($connection, $pending_sql);
$pending_students = mysqli_fetch_assoc($pending_result)['pending'];

$approved_sql = "SELECT COUNT(*) AS approved FROM user 
                 WHERE role = 'student' AND status = 'approved'";
$approved_result = mysqli_query($connection, $approved_sql);
$approved_students = mysqli_fetch_assoc($approved_result)['approved'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="students.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
</head>

<body>

<div class="student-page">

    <h1>Students</h1>
    <p>Manage registered students</p>

    <div class="cards">

        <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <div>
                <h3>Total Students</h3>
                <h2><?php echo $total_students; ?></h2>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-clock"></i>
            <div>
                <h3>Pending</h3>
                <h2><?php echo $pending_students; ?></h2>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-circle-check"></i>
            <div>
                <h3>Approved</h3>
                <h2><?php echo $approved_students; ?></h2>
            </div>
        </div>
          <div class="card">
          <i class="fa-solid fa-user-plus"></i>
            <div>
                <h3>Add Students</h3>
               
            </div>
        </div>

    </div>




        <h2>Student List</h2>
    <div class="table-box">


        <table class="table">

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?php echo $row['name']; ?>
                </td>

                <td>
                    <?php echo $row['email']; ?>
                </td>

                <td>
                    <?php echo $row['phone']; ?>
                </td>

                <td>
                    <?php echo ucfirst($row['role']); ?>
                </td>

                <td>
                    <?php echo ucfirst($row['status']); ?>
                </td>
<td class="actions">

    <!-- <?php if($row['status'] == 'pending') { ?>
        <a class="approve-btn"
           href="approve.php?id=<?php echo $row['id']; ?>">
            Approve
        </a>
    <?php } ?> -->

    <a class="edit-btn"
       href="edit.php?id=<?php echo $row['id']; ?>">
        <i class="fa-solid fa-pen"></i> Edit
    </a>

    <a class="delete-btn"
       href="delete.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this student?');">
        <i class="fa-solid fa-trash"></i> Delete
    </a>

</td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>