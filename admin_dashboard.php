 <?php
include 'database.php';


$sql = "SELECT * FROM user WHERE role IN ('student', 'teacher') ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

$student_sql = "SELECT COUNT(*) AS total_students FROM user WHERE role = 'student'";
$student_result = mysqli_query($connection, $student_sql);
$student_data = mysqli_fetch_assoc($student_result);
$total_students = $student_data['total_students'];

$teacher_sql = "SELECT COUNT(*) AS total_teachers FROM user WHERE role = 'teacher'";
$teacher_result = mysqli_query($connection, $teacher_sql);
$teacher_data = mysqli_fetch_assoc($teacher_result);
$total_teachers = $teacher_data['total_teachers'];

$noticestmt = $connection->prepare("SELECT id, title, description, created_at FROM notices ORDER BY created_at DESC LIMIT 3");
$noticestmt->execute();
$notices = $noticestmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="admin_dashboard.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
      <?php
      include 'admin_head.php'
      ?>

   <div class="main-content">

    <div class="welcome">
        <h1>Welcome, Admin!</h1>
        <p>Manage your library efficiently from your dashboard.</p>
    </div>

</div>
<div class="stats">

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-book"></i>
        </div>
     <div>
            <p>Total Books</p>
            <h2>1,250</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <p>Students</p>
     <h2><?php echo $total_students; ?></h2>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-person-chalkboard"></i>
        </div>
        <div>
            <p>Teachers</p>
            <h2><?php echo $total_teachers; ?></h2>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <div>
            <p>Issued Books</p>
            <h2>85</h2>
        </div>
    </div>
</div>

<div class="dashboard-box">


    <div class="notice-box">

        <div class="box-header">
            <h2>Recent Notices</h2>
            <a href="notice.php">View All</a>
        </div>

        <?php if($notices->num_rows > 0): ?>

            <?php while($notice = $notices->fetch_assoc()): ?>

                <div class="notice-item">

                    <div class="notice-icon">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>

                    <div class="notice-content">

                        <div>
                            <h4>
                                <?= htmlspecialchars($notice['title']) ?>
                            </h4>

                            <p>
                                <?= htmlspecialchars($notice['description']) ?>
                            </p>
                        </div>

                        <div>
                            <small>
                                <?= date("F d, Y", strtotime($notice["created_at"])) ?>
                            </small>
                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="no-notice">
                <i class="fa-regular fa-bell-slash"></i>
                <p>No recent notices available.</p>
            </div>

        <?php endif; ?>

    </div>

    <div class="librarian-box">

        <div class="librarian">

            <div class="libraian-icon">
                <i class="fa-solid fa-user-tie"></i>
            </div>

            <h2>Add Librarian</h2>

            <p>
                Create a new account for librarian
                and give access to them.
            </p>

            <a href="librarian.php" class="librarian-btn">
                <i class="fa-solid fa-user-plus"></i>
                Add Librarian
            </a>

        </div>

    </div>

</div>
</body>
</html>
