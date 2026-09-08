<?php
include 'admin_head.php';
include 'database.php';

$sql = "SELECT * FROM user WHERE role = 'teacher' ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

$total_sql = "SELECT COUNT(*) AS total FROM user WHERE role = 'teacher'";
$total_result = mysqli_query($connection, $total_sql);
$total_teachers= mysqli_fetch_assoc($total_result)['total'];

$pending_sql = "SELECT COUNT(*) AS pending FROM user 
                WHERE role = 'teacher' AND status = 'pending'";
$pending_result = mysqli_query($connection, $pending_sql);
$pending_teachers = mysqli_fetch_assoc($pending_result)['pending'];

$approved_sql = "SELECT COUNT(*) AS approved FROM user 
                 WHERE role = 'teacher' AND status = 'approved'";
$approved_result = mysqli_query($connection, $approved_sql);
$approved_teachers = mysqli_fetch_assoc($approved_result)['approved'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teachers</title>
    <link rel="stylesheet" href="students.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
</head>

<body>

<div class="student-page">

    <h1>Teachers</h1>
    <p>Manage registered Teachers</p>

    <div class="cards">

        <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <div>
                <h3>Total Teachers</h3>
                <h2><?php echo $total_teachers; ?></h2>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-clock"></i>
            <div>
                <h3>Pending</h3>
                <h2><?php echo $pending_teachers; ?></h2>
            </div>
        </div>

        <div class="card">
            <i class="fa-solid fa-circle-check"></i>
            <div>
                <h3>Approved</h3>
                <h2><?php echo $approved_teachers; ?></h2>
            </div>
        </div>
          <div class="card">
          <i class="fa-solid fa-user-plus"></i>
            <div>
                <h3>Add Teachers</h3>
               
            </div>
        </div>

    </div>




        <h2>Teacher List</h2>
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

                <td>

                    <?php if($row['status'] == 'pending') { ?>

                        <a href="approve.php?id=<?php echo $row['id']; ?>">
                            Approve
                        </a>

                    <?php } ?>

                    <a href="delete_student.php?id=<?php echo $row['id']; ?>">
                        Delete
                    </a>
                     <a href="edit_student.php?id=<?php echo $row['id']; ?>">
                        Edit
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>