<?php
session_start();

include "database.php";
if (!isset($_SESSION["role"]) || strtolower(trim($_SESSION["role"])) !== "admin") {
    header("Location:librarian-dashboard.php");
    exit();
}

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || $email === "" || $password === "") {

        $error = "Please fill in all required fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {


        $check = $connection->prepare(
            "SELECT id FROM user WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $error = "This email is already registered.";

        }

            $stmt = $connection->prepare(
                "INSERT INTO user
                (name, email, phone, password, role)
                VALUES (?, ?, ?, ?, 'librarian')"
            );

            $stmt->bind_param(
                "ssss",
                $name,
                $email,
                $phone,
                $password
            );

            if ($stmt->execute()) {

                $message = "Librarian added successfully.";

            } else {

                $error = "Error adding librarian: " . $connection->error;
            }

            $stmt->close();
        }

        $check->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Librarian</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f8f8;
            color: #172033;
        }

        .page {
            margin-left: 250px;
            padding: 100px 45px 50px;
        }

        body.sidebar-collapsed .page {
            margin-left: 80px;
        }

        /* HEADER */

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 7px;
            font-size: 27px;
        }

        .page-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        /* CARD */

        .form-card {
            max-width: 850px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
        }

        .form-title {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 25px;
            padding-bottom: 18px;
            border-bottom: 1px solid #edf1f3;
        }

        .form-title-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #e7f6f3;
            color: #126b63;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }

        .form-title h2 {
            margin: 0;
            font-size: 19px;
        }

        .form-title p {
            margin: 4px 0 0;
            font-size: 12px;
            color: #94a3b8;
        }

        /* FORM */

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;

            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .required {
            color: #dc2626;
        }

        .form-group input {
            width: 100%;
            height: 45px;

            border: 1px solid #d8dee5;
            border-radius: 9px;

            padding: 0 13px;

            outline: none;

            font-size: 14px;
            color: #172033;

            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #126b63;
            box-shadow: 0 0 0 3px rgba(18, 107, 99, 0.08);
        }

        .success {
            max-width: 850px;
            margin-bottom: 20px;

            padding: 12px 15px;

            background: #e9f8f2;
            border: 1px solid #bfe7d5;

            color: #14734d;

            border-radius: 9px;

            font-size: 14px;
        }

        .error {
            max-width: 850px;
            margin-bottom: 20px;

            padding: 12px 15px;

            background: #fff1f1;
            border: 1px solid #f1c5c5;

            color: #c0392b;

            border-radius: 9px;

            font-size: 14px;
        }

        .buttons {
            display: flex;
            gap: 12px;

            margin-top: 8px;
            padding-top: 20px;

            border-top: 1px solid #edf1f3;
        }

        .save-btn {
            border: none;

            padding: 12px 20px;

            border-radius: 9px;

            background: #126b63;
            color: white;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
        }

        .save-btn:hover {
            background: #0d5c56;
        }

        .cancel-btn {
            padding: 11px 19px;

            border: 1px solid #d8dee5;

            border-radius: 9px;

            background: white;
            color: #475569;

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;
        }

        .cancel-btn:hover {
            background: #f8fafc;
        }
        @media (max-width: 700px) {

            .page {
                margin-left: 0;
                padding: 90px 18px 30px;
            }

            body.sidebar-collapsed .page {
                margin-left: 0;
            }

            .form-card {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .buttons {
                flex-direction: column;
            }

            .save-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</head>

<body>

<?php include "admin_head.php"; ?>


<div class="page">

    <div class="page-header">

        <h1>
            <i class="fa-solid fa-user-plus"
               style="color:#126b63;"></i>

            Add Librarian
        </h1>

        <p>
            Create a new librarian account for your library system.
        </p>

    </div>


    <?php if ($message !== ""): ?>

        <div class="success">

            <i class="fa-solid fa-circle-check"></i>

            <?= htmlspecialchars($message) ?>

        </div>

    <?php endif; ?>


    <?php if ($error !== ""): ?>

        <div class="error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>


    <div class="form-card">

        <div class="form-title">

            <div class="form-title-icon">

                <i class="fa-solid fa-user-tie"></i>

            </div>

            <div>

                <h2>Librarian Information</h2>

                <p>
                    Enter the details of the new librarian.
                </p>

            </div>

        </div>


        <form method="POST">


            <div class="form-row">

                <div class="form-group">

                    <label for="name">
                        Full Name
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter full name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="email">
                        Email Address
                        <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter email address"
                        required
                    >

                </div>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="Enter phone number"
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                        <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                        minlength="6"
                        required
                    >

                </div>

            </div>


            <div class="buttons">

                <button type="submit" class="save-btn">

                    <i class="fa-solid fa-user-plus"></i>

                    Add Librarian

                </button>


                <a href="admin_dashboard.php"
                   class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>