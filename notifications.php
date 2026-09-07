<?php
include 'database.php';

$sql = "SELECT * FROM user
        WHERE role IN ('student', 'teacher')
        AND status = 'pending'
        ORDER BY id DESC";

$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    <link rel="stylesheet" href="notification.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<h1>Registration Requests</h1>

<div class="notification-list">

<?php if (mysqli_num_rows($result) > 0) { ?>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="request">

            <div>
                <i class="fa-solid fa-user"></i>

                <strong>
                    <?php echo $row['name']; ?>
                </strong>

                wants to register as
                <strong>
                    <?php echo ucfirst($row['role']); ?>
                </strong>
            </div>

            <div class="request-buttons">

                <a href="approve.php?id=<?php echo $row['id']; ?>"
                   class="approve">
                    Approve
                </a>

                <a href="reject.php?id=<?php echo $row['id']; ?>"
                   class="reject">
                    Reject
                </a>

            </div>

        </div>

    <?php } ?>

<?php } else { ?>

    <p>No pending registration requests.</p>

<?php } ?>

</div>

</body>
</html>