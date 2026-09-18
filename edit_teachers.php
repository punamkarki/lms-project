<?php
include 'database.php';

if (!isset($_GET['id'])) {
    die("Teacher ID is missing.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM user WHERE id = $id AND role = 'teacher'";
$result = mysqli_query($connection, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Teacher not found.");
}

$teacher = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $update_sql = "UPDATE user SET
                    name = '$name',
                    email = '$email',
                    phone = '$phone',
                    status = '$status'
                   WHERE id = $id AND role = 'teacher'";

    if (mysqli_query($connection, $update_sql)) {
        header("Location: teachers.php");
        exit();
    } else {
        echo "Error updating teacher: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }

        .edit-container {
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .edit-container h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .update-btn {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>

<body>

<div class="edit-container">

    <h1>Edit Teachers</h1>

    <form method="POST">

        <label>Name</label>
        <input type="text"
               name="name"
               value="<?php echo htmlspecialchars($teacher['name']); ?>"
               required>

        <label>Email</label>
        <input type="email"
               name="email"
               value="<?php echo htmlspecialchars($teacher['email']); ?>"
               required>

        <label>Phone</label>
        <input type="text"
               name="phone"
               value="<?php echo htmlspecialchars($teacher['phone']); ?>"
               required>

        <label>Status</label>

        <select name="status">

            <option value="pending"
                <?php if($teacher['status'] == 'pending') echo 'selected'; ?>>
                Pending
            </option>

            <option value="approved"
                <?php if($teacher['status'] == 'approved') echo 'selected'; ?>>
                Approved
            </option>

        </select>

        <button type="submit" name="update" class="update-btn">
            Update Teachers
        </button>

        <a href="teachers.php" class="back-btn">
            ← Back to Teachers
        </a>

    </form>

</div>

</body>
</html>