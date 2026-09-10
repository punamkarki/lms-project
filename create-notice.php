<?php
session_start();

include "database.php";
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: notice.php");
    exit();
}

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

    if ($title === "" || $description === "") {

        $error = "Please fill in all fields.";

    } else {

        $stmt = $connection->prepare(
            "INSERT INTO notices (title, description, created_at)
             VALUES (?, ?, NOW())"
        );

        $stmt->bind_param("ss", $title, $description);

        if ($stmt->execute()) {

            $message = "Notice created successfully.";

        } else {

            $error = "Error creating notice: " . $connection->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Notice</title>

    <!-- <link rel="stylesheet" href="admin_dashboard.css"> -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7faf9;
            font-family: Arial, sans-serif;
            color: #172033;
        }

        .create-notice-container {
            margin-left: 230px;
            padding: 105px 45px 45px;
        }

        .create-notice-header {
            margin-bottom: 25px;
             background: linear-gradient( 135deg, #0d3c38, #a8ebe0);
             border: 1px solid #d5ebe7;
            border-radius: 18px;

            padding: 30px 35px;
            height:130px;
           
            align-items: center;
            justify-content: space-between;
     

            
        }

        .create-notice-header h1 {
            margin: 0 0 7px;
            font-size: 27px;
            color: #040404;
       
            
        }
             .create-notice-header i {
               
              color: #020202;
             }

        .create-notice-header p {
              text-align:left;
            font-size: 17px;
            color: #0d0d0d;
        }

        .notice-form-card {
            max-width: 850px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            border: 1px solid #d8dee5;
            border-radius: 9px;
            padding: 12px 14px;
            outline: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #172033;
            background: #ffffff;
            transition: 0.2s;
        }

        .form-group input {
            height: 45px;
        }

        .form-group textarea {
            min-height: 160px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #126b63;
            box-shadow: 0 0 0 3px rgba(18, 107, 99, 0.08);
        }

        .form-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
        }

        .submit-btn {
            border: none;
            background: #126b63;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #0d5c56;
        }

        .cancel-btn {
            padding: 10px 18px;
            border: 1px solid #d8dee5;
            border-radius: 8px;
            color: #475569;
            background: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .cancel-btn:hover {
            background: #f8fafc;
        }

        .success-message {
            max-width: 850px;
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 8px;
            background: #e8f7f1;
            color: #16734b;
            border: 1px solid #bde8d3;
            font-size: 14px;
        }

        .error-message {
            max-width: 850px;
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 8px;
            background: #fff1f1;
            color: #c0392b;
            border: 1px solid #f2c5c5;
            font-size: 14px;
        }

        .form-icon {
            color: #126b63;
            margin-right: 7px;
        }

        @media (max-width: 700px) {

            .create-notice-container {
                margin-left: 0;
                padding: 90px 18px 30px;
            }

            .notice-form-card {
                padding: 20px;
            }

            .form-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .submit-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</head>

<body>

<?php include "admin_head.php"; ?>


<div class="create-notice-container">

    <div class="create-notice-header">

        <h1>
            <i class="fa-solid fa-bullhorn form-icon"></i>
            Create Notice
        </h1>

        <p>
            Create a new announcement for students and teachers.
        </p>

    </div>


    <?php if ($message !== ""): ?>

        <div class="success-message">
            <i class="fa-solid fa-circle-check"></i>
            <?= htmlspecialchars($message) ?>
        </div>

    <?php endif; ?>


    <?php if ($error !== ""): ?>

        <div class="error-message">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <div class="notice-form-card">

        <form method="POST" action="">

            <div class="form-group">

                <label for="title">
                    Notice Title
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Enter notice title"
                    maxlength="255"
                    required
                >

            </div>


            <div class="form-group">

                <label for="description">
                    Notice Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Write your notice here..."
                    required
                ></textarea>

            </div>


            <div class="form-buttons">

                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    Publish Notice
                </button>

                <a href="notice.php" class="cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>