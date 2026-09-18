
<?php
session_start();

include "database.php";
include "student_head.php";


$student_id = $_SESSION['user_id'] ?? 0;


$total_sql = "SELECT COUNT(*) AS total FROM books";
$total_result = mysqli_query($connection, $total_sql);
$total_titles = mysqli_fetch_assoc($total_result)['total'] ?? 0;


$available_sql = "
    SELECT COALESCE(SUM(available_quantity), 0) AS total
    FROM books
";
$available_result = mysqli_query($connection, $available_sql);
$available_copies = mysqli_fetch_assoc($available_result)['total'] ?? 0;


$issued_sql = "
    SELECT COUNT(*) AS total
    FROM book_issues
    WHERE student_id = ?
    AND return_date IS NULL
";

$stmt = mysqli_prepare($connection, $issued_sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);

    $issued_result = mysqli_stmt_get_result($stmt);
    $issued_books = mysqli_fetch_assoc($issued_result)['total'] ?? 0;

    mysqli_stmt_close($stmt);
} else {
    $issued_books = 0;
}


$overdue_sql = "
    SELECT COUNT(*) AS total
    FROM book_issues
    WHERE student_id = ?
    AND due_date < CURDATE()
    AND return_date IS NULL
";

$stmt = mysqli_prepare($connection, $overdue_sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);

    $overdue_result = mysqli_stmt_get_result($stmt);
    $overdue_books = mysqli_fetch_assoc($overdue_result)['total'] ?? 0;

    mysqli_stmt_close($stmt);
} else {
    $overdue_books = 0;
}


$books_sql = "
    SELECT *
    FROM books
    ORDER BY id DESC
    LIMIT 5
";

$books_result = mysqli_query($connection, $books_sql);

if (!$books_result) {
    die("Error loading books: " . mysqli_error($connection));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"  href="student_dashboard.css">

</head>

<body>

<main class="student-page">

  

    <div class="page-header">

        <div>

            <h1>
                Welcome, Student!
            </h1>

            <p>
                Explore books, manage your issues and track returns.
            </p>

        </div>

    </div>


  

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <div>

                <h3>Total Book Titles</h3>

                <h2>
                    <?= (int)$total_titles; ?>
                </h2>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>

                <h3>Available Books</h3>

                <h2>
                    <?= (int)$available_copies; ?>
                </h2>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div>

                <h3>My Issued Books</h3>

                <h2>
                    <?= (int)$issued_books; ?>
                </h2>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div>

                <h3>Overdue Books</h3>

                <h2>
                    <?= (int)$overdue_books; ?>
                </h2>

            </div>

        </div>

    </div>


    <!-- Quick Actions -->

    <div class="section-title">

        <h2>Quick Actions</h2>

    </div>


    <div class="quick-actions">


        <a href="student_books.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <div>

                <h3>Browse Books</h3>

                <p>
                    Explore available library books
                </p>

            </div>

        </a>


        <a href="my_books.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div>

                <h3>My Books</h3>

                <p>
                    View your issued books
                </p>

            </div>

        </a>


        <a href="student_history.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>

            <div>

                <h3>Issue History</h3>

                <p>
                    Check your borrowing history
                </p>

            </div>

        </a>


        <a href="student_profile.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>

                <h3>My Profile</h3>

                <p>
                    View your profile details
                </p>

            </div>

        </a>


    </div>


    <!-- Recent Books -->

    <div class="books-container">


        <div class="books-header">

            <h2>
                Recent Books
            </h2>

            <a href="student_books.php">
                View All
            </a>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Book Title</th>

                        <th>Author</th>

                        <th>Category</th>

                        <th>Quantity</th>

                        <th>Available</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (mysqli_num_rows($books_result) > 0): ?>

                    <?php while ($book = mysqli_fetch_assoc($books_result)): ?>

                        <?php

                        $available = (int)$book['available_quantity'];

                        if ($available > 0) {

                            $status = "Available";
                            $status_class = "available";

                        } else {

                            $status = "Unavailable";
                            $status_class = "unavailable";

                        }

                        ?>

                        <tr>

                            <td>
                                <?= (int)$book['id']; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($book['title']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($book['author']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($book['category'] ?? 'N/A'); ?>
                            </td>

                            <td>
                                <?= (int)$book['quantity']; ?>
                            </td>

                            <td>
                                <?= $available; ?>
                            </td>

                            <td>

                                <span class="status <?= $status_class; ?>">

                                    <?= $status; ?>

                                </span>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="7"
                            class="empty-state">

                            No books found.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


</main>

</body>

</html>