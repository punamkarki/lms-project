
<?php
session_start();

include "database.php";

if (
    !isset($_SESSION['role']) ||
    !in_array($_SESSION['role'], ['admin', 'librarian'])
) {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $quantity = (int)($_POST['quantity'] ?? 0);

    if (empty($title) || empty($author) || empty($category)) {

        $error = "Please fill in all required fields.";

    } elseif ($quantity <= 0) {

        $error = "Quantity must be greater than zero.";

    } else {
        $check_sql = "
            SELECT id
            FROM books
            WHERE title = ? AND author = ?
        ";

        $check_stmt = mysqli_prepare($connection, $check_sql);
        mysqli_stmt_bind_param(
            $check_stmt,
            "ss",
            $title,
            $author
        );

        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {

            $error = "This book already exists.";

        } else {
            $insert_sql = "
                INSERT INTO books
                (title, author, category, quantity, available_quantity)
                VALUES (?, ?, ?, ?, ?)
            ";

            $insert_stmt = mysqli_prepare(
                $connection,
                $insert_sql
            );

            $available_quantity = $quantity;

            mysqli_stmt_bind_param(
                $insert_stmt,
                "sssii",
                $title,
                $author,
                $category,
                $quantity,
                $available_quantity
            );

            if (mysqli_stmt_execute($insert_stmt)) {

                $success = "Book added successfully.";

               
                $title = "";
                $author = "";
                $category = "";
                $quantity = "";

            } else {

                $error = "Unable to add book. Please try again.";
            }

            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($check_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Book | Library Management System</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
* {
    box-sizing: border-box;
}

.add-book-page {
    margin-left: 250px;
    padding: 110px 42px 45px;
    min-height: 100vh;
    background: #f5f8f8;
}


.add-book-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 30px;
}

.page-label {
    color: #126b63;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.add-book-header h1 {
    margin: 7px 0;
    color: #172033;
    font-size: 30px;
    font-weight: 750;
}

.add-book-header p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 12px 17px;
    color: #126b63;
    background: #ffffff;
    border: 1px solid #dce7e5;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 650;
    transition: 0.3s;
}

.back-button:hover {
    background: #126b63;
    color: #ffffff;
}

.alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    margin-bottom: 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
}

.success-alert {
    color: #166534;
    background: #dcfce7;
    border: 1px solid #bbf7d0;
}

.error-alert {
    color: #b91c1c;
    background: #fee2e2;
    border: 1px solid #fecaca;
}

.form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 280px;
    align-items: start;
    gap: 25px;
}


.book-form-card {
    padding: 30px;
    background: #ffffff;
    border: 1px solid #e5eaf0;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
}

.form-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 23px;
    margin-bottom: 25px;
    border-bottom: 1px solid #edf1f5;
}

.form-heading-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 13px;
    color: #126b63;
    background: #e4f4ef;
    font-size: 20px;
}

.form-card-header h2 {
    margin: 0 0 5px;
    color: #172033;
    font-size: 20px;
}

.form-card-header p {
    margin: 0;
    color: #8490a3;
    font-size: 13px;
}

.book-form {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 23px 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.form-group label {
    color: #334155;
    font-size: 13px;
    font-weight: 700;
}

.form-group label span {
    color: #dc2626;
}

.input-box {
    display: flex;
    align-items: center;
    gap: 11px;
    height: 48px;
    padding: 0 14px;
    background: #fbfcfd;
    border: 1px solid #dce3ea;
    border-radius: 10px;
    transition: 0.25s;
}

.input-box i {
    color: #8490a3;
    font-size: 14px;
}

.input-box:focus-within {
    border-color: #126b63;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(18, 107, 99, 0.10);
}

.input-box input,
.input-box select {
    width: 100%;
    height: 100%;
    outline: none;
    border: none;
    color: #172033;
    background: transparent;
    font-size: 13px;
}

.input-box input::placeholder {
    color: #a1aab8;
}

.input-box select {
    cursor: pointer;
}

.form-group small {
    margin-top: -2px;
    color: #94a3b8;
    font-size: 11px;
}

.form-actions {
    grid-column: 1 / -1;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 25px;
    margin-top: 3px;
    border-top: 1px solid #edf1f5;
}

.cancel-button,
.submit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-width: 125px;
    padding: 13px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: 0.3s;
}

.cancel-button {
    color: #64748b;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
}

.cancel-button:hover {
    background: #e2e8f0;
}

.submit-button {
    color: #ffffff;
    background: #126b63;
    border: 1px solid #126b63;
}

.submit-button:hover {
    background: #0d514b;
    transform: translateY(-2px);
}

.form-info-card {
    padding: 25px;
    background: #ffffff;
    border: 1px solid #e5eaf0;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
}

.info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    margin-bottom: 18px;
    color: #126b63;
    background: #e4f4ef;
    border-radius: 12px;
    font-size: 20px;
}

.form-info-card h3 {
    margin: 0 0 17px;
    color: #172033;
    font-size: 17px;
}

.form-info-card ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.form-info-card li {
    position: relative;
    padding-left: 18px;
    margin-bottom: 15px;
    color: #64748b;
    font-size: 12px;
    line-height: 1.7;
}

.form-info-card li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #126b63;
    font-weight: 800;
}
@media (max-width: 1100px) {

    .form-layout {
        grid-template-columns: 1fr;
    }

    .form-info-card {
        display: none;
    }

}

@media (max-width: 850px) {

    .add-book-page {
        margin-left: 80px;
        padding: 105px 25px 35px;
    }

}

@media (max-width: 600px) {

    .add-book-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .add-book-header h1 {
        font-size: 25px;
    }

    .book-form-card {
        padding: 20px;
    }

    .book-form {
        grid-template-columns: 1fr;
    }

    .form-actions {
        grid-column: 1;
        flex-direction: column-reverse;
    }

    .cancel-button,
    .submit-button {
        width: 100%;
    }

}
</style>

</head>

<body>

<?php include "librarian_head.php"; ?>

<main class="add-book-page">

    <div class="add-book-header">

        <div>
            <span class="page-label">
                LIBRARY MANAGEMENT
            </span>

            <h1>Add New Book</h1>

            <p>
                Add a new book and manage its library information.
            </p>
        </div>

        <a href="librarian_dashboard.php" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>

    </div>

    <?php if (!empty($success)): ?>

        <div class="alert success-alert">
            <i class="fa-solid fa-circle-check"></i>
            <?= htmlspecialchars($success); ?>
        </div>

    <?php endif; ?>

    <?php if (!empty($error)): ?>

        <div class="alert error-alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>

    <div class="form-layout">

        <section class="book-form-card">

            <div class="form-card-header">

                <div class="form-heading-icon">
                    <i class="fa-solid fa-book"></i>
                </div>

                <div>
                    <h2>Book Information</h2>
                    <p>Enter the details of the new book.</p>
                </div>

            </div>

            <form method="POST"
                  action=""
                  class="book-form">

                <div class="form-group">

                    <label for="title">
                        Book Title <span>*</span>
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-book"></i>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Enter book title"
                            value="<?= htmlspecialchars($title ?? ''); ?>"
                            required
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label for="author">
                        Author <span>*</span>
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-user-pen"></i>

                        <input
                            type="text"
                            id="author"
                            name="author"
                            placeholder="Enter author name"
                            value="<?= htmlspecialchars($author ?? ''); ?>"
                            required
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label for="category">
                        Category <span>*</span>
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-layer-group"></i>

                        <select id="category"
                                name="category"
                                required>

                            <option value="">
                                Select category
                            </option>

                            <option value="BCA"
                                <?= (($category ?? '') == 'BCA') ? 'selected' : ''; ?>>
                                BCA
                            </option>

                            <option value="BIM"
                                <?= (($category ?? '') == 'BIM') ? 'selected' : ''; ?>>BIM
                                
                            </option>

                            <option value="BIT"
                                <?= (($category ?? '') == 'BIT') ? 'selected' : ''; ?>>
                                BIT
                            </option>

                            <option value="BBA"
                                <?= (($category ?? '') == 'BBA') ? 'selected' : ''; ?>>
                                BBA
                            </option>

                            <option value="BPA"
                                <?= (($category ?? '') == 'BPA') ? 'selected' : ''; ?>>
                                BPA
                            </option>

                            <option value="Other"
                                <?= (($category ?? '') == 'Other') ? 'selected' : ''; ?>>
                                Other
                            </option>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label for="quantity">
                        Total Quantity <span>*</span>
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-hashtag"></i>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            min="1"
                            placeholder="Enter total quantity"
                            value="<?= htmlspecialchars((string)($quantity ?? '')); ?>"
                            required
                        >

                    </div>

                    <small>
                        All newly added books will be available.
                    </small>

                </div>

                <div class="form-actions">

                    <a href="manage_books.php"
                       class="cancel-button">
                        Cancel
                    </a>

                    <button type="submit"
                            class="submit-button">

                        <i class="fa-solid fa-plus"></i>
                        Add Book

                    </button>

                </div>

            </form>

        </section>

        <aside class="form-info-card">

            <div class="info-icon">
                <i class="fa-solid fa-circle-info"></i>
            </div>

            <h3>Before Adding</h3>

            <ul>
                <li>Check that the book is not already registered.</li>
                <li>Enter the correct author name.</li>
                <li>Choose the appropriate category.</li>
                <li>Enter the total number of copies.</li>
            </ul>

        </aside>

    </div>

</main>

</body>
</html>