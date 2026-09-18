
<?php
session_start();
include 'database.php';

$total_sql = "SELECT SUM(quantity) AS total FROM books";
$total_result = mysqli_query($connection, $total_sql);
$total_books = mysqli_fetch_assoc($total_result)['total'];

$available_sql = "SELECT SUM(quantity) AS total FROM books";
$available_result = mysqli_query($connection, $available_sql);
$available_books = mysqli_fetch_assoc($available_result)['total'];

$issued_books = $total_books - $available_books;

// $overdue_books= Today > due_date;
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Error loading books: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books | Admin Dashboard</title>
    <link rel="stylesheet" href="books.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>

<?php include 'admin_head.php'; ?>

<main class="books-page">

    <div class="page-header">
        <div>
            <h1>Books Overview</h1>
            <p>View library book information and availability.</p>
        </div>
    </div>
    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total Books</h3>
            <h2><?= (int)$total_books; ?></h2>
        </div>

        <div class="stat-card">
            <h3>Available Books</h3>
            <h2><?= (int)$available_books; ?></h2>
        </div>

        <div class="stat-card">
            <h3>Issued Books</h3>
            <h2><?= (int)$issued_books; ?></h2>
        </div>
         <!-- <div class="stat-card">
            <h3>Overdue Books</h3>
            <h2><?= (int)$overdue_books; ?></h2>
        </div> -->

    </div>

 
    <section class="books-container">

        <div class="section-header">
            <h2>Book Records</h2>
           
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
                <?php if (mysqli_num_rows($result) > 0): ?>

                    <?php while ($book = mysqli_fetch_assoc($result)): ?>

                        <tr>
                            <td><?= (int)$book['id']; ?></td>

                            <td>
                                <?= htmlspecialchars($book['title']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($book['author']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($book['category'] ?? 'N/A'); ?>
                            </td>

                           

                            <td><?= (int)$book['quantity']; ?></td>

                            <td><?= (int)$book['available_quantity']; ?></td>

                            <td>
                                <?php if ($book['available_quantity'] > 0): ?>
                                    <span class="available">Available</span>
                                <?php else: ?>
                                    <span class="unavailable">Issued Out</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="empty-state">
                            No books found.
                        </td>
                    </tr>

                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>

</main>

</body>
</html>