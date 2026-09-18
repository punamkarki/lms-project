
<?php
include "database.php";

$student_id = $_SESSION['user_id'] ?? 0;


$notification_count = 0;

$notification_sql = "
    SELECT COUNT(*) AS total
    FROM notices
";

$notification_result = mysqli_query(
    $connection,
    $notification_sql
);

if ($notification_result) {
    $notification_data = mysqli_fetch_assoc(
        $notification_result
    );

    $notification_count = $notification_data['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <link rel="stylesheet"
          href="admin_dashboard.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<header class="headers">

    <div class="heads">

        <div class="dashboard">

            <p>

                <i class="fa-solid fa-bars"></i>

                Student

            </p>

        </div>


        <nav class="mains">


   

            <div class="search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       placeholder="Search books...">

            </div>


        
            <div class="menus notification">

                <a href="student_notifications.php">

                    <i class="fa-solid fa-bell"></i>

                    <?php if ($notification_count > 0) { ?>

                        <span class="notification-count">

                            <?php echo $notification_count; ?>

                        </span>

                    <?php } ?>

                </a>

            </div>


    

            <div class="menus">

                <a href="student_profile.php">

                    <i class="fa-regular fa-circle-user"></i>

                </a>

            </div>



            <a href="student_logout.php"
               class="menus">

                Logout

            </a>


        </nav>

    </div>

</header>


<div class="sidebar">


    <div class="logo">

        <i class="fa-solid fa-book-open"></i>

        <span>LIBRARY</span>

    </div>


    <ul class="menu">

        <li>

            <a href="student_dashboard.php">

                <i class="fa-solid fa-house"></i>

                <span>Dashboard</span>

            </a>

        </li>



        <li>

            <a href="student_books.php">

                <i class="fa-solid fa-book"></i>

                <span>Browse Books</span>

            </a>

        </li>




        <li>

            <a href="my_books.php">

                <i class="fa-solid fa-book-open-reader"></i>

                <span>My Books</span>

            </a>

        </li>



       

        <li>

            <a href="student_history.php">

                <i class="fa-solid fa-clock-rotate-left"></i>

                <span>Issue History</span>

            </a>

        </li>

\

        <li>

            <a href="student_overdue.php">

                <i class="fa-solid fa-clock"></i>

                <span>Overdue Books</span>

            </a>

        </li>

        <li>

            <a href="student_profile.php">

                <i class="fa-solid fa-user"></i>

                <span>My Profile</span>

            </a>

        </li>



        <!-- Settings -->

        <li>

            <a href="student_settings.php">

                <i class="fa-solid fa-gear"></i>

                <span>Settings</span>

            </a>

        </li>


    </ul>



    <!-- Sidebar Bottom -->

    <div class="sidebar-bottom">

        <a href="student_help.php">

            <i class="fa-solid fa-circle-question"></i>

            <span>Need Help?</span>

        </a>

    </div>


</div>



<!-- ================================
     ACTIVE MENU SCRIPT
================================ -->

<script>

let page = location.pathname
    .split('/')
    .pop();

document.querySelectorAll('.menu li a').forEach(a => {

    if (a.getAttribute('href') === page) {

        a.parentElement.classList.add('active');

    }

});

</script>


</body>

</html>