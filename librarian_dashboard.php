
<?php
session_start();

include "database.php";
include 'librarian_head.php';

$total_sql = "SELECT COUNT(*) AS total FROM books";
$total_result = mysqli_query($connection, $total_sql);
$total_titles = mysqli_fetch_assoc($total_result)['total'] ?? 0;

$copies_sql = "SELECT COALESCE(SUM(quantity), 0) AS total FROM books";
$copies_result = mysqli_query($connection, $copies_sql);
$total_copies = mysqli_fetch_assoc($copies_result)['total'] ?? 0;

$available_sql = "SELECT COALESCE(SUM(available_quantity), 0) AS total FROM books";
$available_result = mysqli_query($connection, $available_sql);
$available_copies = mysqli_fetch_assoc($available_result)['total'] ?? 0;


$issued_copies = $total_copies - $available_copies;

$overdue_sql = "
    SELECT COUNT(*) AS total
    FROM books
    WHERE due_date IS NOT NULL
    AND due_date < CURDATE()
    AND return_date IS NULL
";

$overdue_result = mysqli_query($connection, $overdue_sql);
$overdue_books = mysqli_fetch_assoc($overdue_result)['total'] ?? 0;

$books_sql = "
    SELECT *
    FROM books
    ORDER BY id ASC
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

    <title>Librarian Dashboard</title>

    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="librarian_dashboard.css">

</head>

<body>

<main class="librarian-page">


    <div class="page-header">

        <div>

            <h1>
                Welcome Again!
            </h1>

            <p>
                Manage books, issue books and track returns.
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
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <div>

                <h3>Total Books</h3>

                <h2>
                    <?= (int)$total_copies; ?>
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

                <h3>Issued Books</h3>

                <h2>
                    <?= (int)$issued_copies; ?>
                </h2>

            </div>

        </div>


    </div>


    <div class="section-title">

        <h2>Quick Actions</h2>

    </div>


    <div class="quick-actions">


        <a href="add_book.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-plus"></i>
            </div>

            <div>

                <h3>Add Book</h3>

                <p>
                    Add a new book to the library
                </p>

            </div>

        </a>


        <a href="manage_books.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <div>

                <h3>Manage Books</h3>

                <p>
                    Edit and manage book records
                </p>

            </div>

        </a>


        <a href="issue_book.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

            <div>

                <h3>Issue Book</h3>

                <p>
                    Issue a book to a member
                </p>

            </div>

        </a>


        <a href="return_book.php"
           class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-arrow-left"></i>
            </div>

            <div>

                <h3>Return Book</h3>

                <p>
                    Record returned books
                </p>

            </div>

        </a>


    </div>

    <div class="books-container">


        <div class="books-header">

            <h2>
                Recent Books
            </h2>

            <a href="manage_books.php">
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

                        if (!empty($book['return_date'])) {

                            $status = "Returned";
                            $status_class = "returned";

                        } elseif (
                            !empty($book['due_date']) &&
                            $book['due_date'] < date('Y-m-d') &&
                            empty($book['return_date'])
                        ) {

                            $status = "Overdue";
                            $status_class = "overdue";

                        } elseif (!empty($book['issue_date'])) {

                            $status = "Issued";
                            $status_class = "issued";

                        } else {

                            $status = "Available";
                            $status_class = "available";

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
                                <?= (int)$book['available_quantity']; ?>
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