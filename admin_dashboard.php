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

</div>
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

  
    <div class="schedule-section">

        <div class="section-header">
            <h2>Book Issue Schedule</h2>
            <p>View books provided to each faculty by day.</p>
        </div>

        <div class="schedule-table">

            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Faculty</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Sunday</td>
                        <td>BSC</td>
                    </tr>

                    <tr>
                        <td>Monday</td>
                        <td>BBS, MBS</td>
                    </tr>

                    <tr>
                        <td>Tuesday</td>
                        <td>BSc CSIT, BIT</td>
                    </tr>

                    <tr>
                        <td>Wednesday</td>
                        <td>BCA, BSW</td>
                    </tr>

                    <tr>
                        <td>Thursday</td>
                        <td>BBA, BBM</td>
                    </tr>

                    <tr>
                        <td>Friday</td>
                        <td>BPA, MPA</td>
                    </tr>

                    <tr>
                        <td>Saturday</td>
                        <td>Closed</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>



    <div class="right-dashboard">


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

</div>
</body>
</html>
