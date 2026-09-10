<?php
session_start();

include "database.php";

$sql = "SELECT id, title, description, created_at
        FROM notices
        ORDER BY created_at DESC";

$result = $connection->query($sql);

if (!$result) {
    die("Error loading notices: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notice Board</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            color: #172033;
        }

  
        .notice-page {
            margin-left: 250px;
            padding: 100px 45px 50px;
        }

        body.sidebar-collapsed .notice-page {
            margin-left: 80px;
        }

        .notice-banner {
            background: linear-gradient( 135deg, #0d3c38, #a8ebe0);

            border: 1px solid #d5ebe7;
            border-radius: 18px;

            padding: 30px 35px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;

            margin-bottom: 35px;
        }

        .banner-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .banner-icon {
            width: 65px;
            height: 65px;

            border-radius: 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            
            color: #060606;

            font-size: 27px;
        }

        .banner-text h1 {
            margin: 0 0 7px;
            font-size: 29px;
            color: #050505;
        }

        .banner-text p {
            margin: 0;
            color: #050506;
            font-size: 14px;
            line-height: 1.6;
        }



        .create-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 13px 20px;

            background: #126b63;
            color: white;

            border-radius: 10px;

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            white-space: nowrap;

            transition: 0.25s;
        }

        .create-btn:hover {
            background: #0e5b55;
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(18, 107, 99, 0.22);
        }

    

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 18px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 22px;
            color: #172033;
        }

        .notice-count {
            padding: 7px 12px;

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 20px;

            color: #64748b;

            font-size: 12px;
            font-weight: 600;
        }


        .notice-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }



        .notice-item {
            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 22px;

            display: flex;
            align-items: flex-start;

            gap: 18px;

            transition: 0.25s;

            position: relative;
        }

        .notice-item:hover {
            transform: translateY(-2px);

            border-color: #c9e1dd;

            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.07);
        }

        .notice-symbol {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            border-radius: 13px;

            background: #eef8f6;

            color: #126b63;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }

        .notice-content {
            flex: 1;
            min-width: 0;
        }

        .notice-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;
        }

        .notice-title {
            margin: 0;

            font-size: 17px;

            color: #172033;

            font-weight: 700;
        }

        .new-label {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            background: #e8f7f1;

            color: #16805a;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
        }

        .notice-description {
            margin: 8px 0 12px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.65;
        }

        .notice-footer {
            display: flex;
            align-items: center;

            gap: 7px;

            color: #94a3b8;

            font-size: 12px;
        }

        .notice-footer i {
            color: #126b63;
        }

    

        .notice-arrow {
            width: 35px;
            height: 35px;

            border-radius: 50%;

            background: #f8fafc;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #64748b;

            flex-shrink: 0;

            align-self: center;
        }

        .empty-notice {
            background: white;

            border: 1px dashed #cbd5e1;

            border-radius: 15px;

            padding: 65px 30px;

            text-align: center;

            color: #64748b;
        }

        .empty-notice i {
            font-size: 42px;

            color: #cbd5e1;

            margin-bottom: 15px;
        }

        .empty-notice h3 {
            margin: 0 0 7px;

            color: #334155;
        }

        .empty-notice p {
            margin: 0;

            font-size: 14px;
        }

        @media (max-width: 900px) {

            .notice-page {
                margin-left: 0;
                padding: 90px 25px 40px;
            }

            body.sidebar-collapsed .notice-page {
                margin-left: 0;
            }

            .notice-banner {
                flex-direction: column;
                align-items: flex-start;
            }

            .create-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 600px) {

            .notice-page {
                padding: 85px 15px 30px;
            }

            .notice-banner {
                padding: 22px;
            }

            .banner-left {
                align-items: flex-start;
            }

            .banner-icon {
                width: 52px;
                height: 52px;
                font-size: 21px;
            }

            .banner-text h1 {
                font-size: 23px;
            }

            .notice-item {
                padding: 17px;
            }

            .notice-symbol {
                width: 42px;
                height: 42px;
            }

            .notice-title-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            .notice-arrow {
                display: none;
            }

        }

    </style>
</head>


<body>

<?php include "admin_head.php"; ?>


<div class="notice-page">



    <div class="notice-banner">

        <div class="banner-left">

            <div class="banner-icon">
                <i class="fa-solid fa-bell"></i>
            </div>

            <div class="banner-text">

                <h1>Notice Board</h1>

                <p>
                    Stay informed about important announcements,
                    updates and library information.
                </p>

            </div>

        </div>


        <?php if (isset($_SESSION["role"]) && strtolower(trim($_SESSION["role"])) === "admin"): ?>

            <a href="create-notice.php" class="create-btn">

                <i class="fa-solid fa-plus"></i>

                Create Notice

            </a>

        <?php endif; ?>

    </div>



    <div class="section-header">

        <h2>Latest Announcements</h2>

        <div class="notice-count">

            <i class="fa-regular fa-bell"></i>

            <?= $result->num_rows ?> Notices

        </div>

    </div>

    <div class="notice-list">

        <?php if ($result->num_rows > 0): ?>

            <?php
            $first_notice = true;
            ?>

            <?php while ($notice = $result->fetch_assoc()): ?>

                <div class="notice-item">


                    <div class="notice-symbol">

                        <i class="fa-solid fa-bullhorn"></i>

                    </div>

                    <div class="notice-content">

                        <div class="notice-title-row">

                            <h3 class="notice-title">

                                <?= htmlspecialchars($notice["title"]) ?>

                            </h3>


                        </div>


                        <p class="notice-description">

                            <?= nl2br(
                                htmlspecialchars($notice["description"])
                            ) ?>

                        </p>


                        <div class="notice-footer">

                            <i class="fa-regular fa-calendar"></i>

                            Published on

                            <?= date(
                                "F d, Y",
                                strtotime($notice["created_at"])
                            ) ?>

                        </div>

                    </div>


                    <!-- ARROW -->

                    <div class="notice-arrow">

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>

                </div>


                <?php
                $first_notice = false;
                ?>

            <?php endwhile; ?>


        <?php else: ?>

            <div class="empty-notice">

                <i class="fa-regular fa-bell-slash"></i>

                <h3>No Notices Yet</h3>

                <p>
                    There are currently no announcements available.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>