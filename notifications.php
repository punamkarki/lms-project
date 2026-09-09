

<?php
include 'database.php';
include 'admin_head.php';
 
$registration_sql = "SELECT id, name, role, 'registration' AS type
                     FROM user
                     WHERE role IN ('student', 'teacher')
                     AND status = 'pending'
                     ORDER BY id DESC";

$registration_result = mysqli_query($connection, $registration_sql);


// /* Get book notifications */
// /*
//    Change the table/column names below according to your database.
//    Example assumes:
//    books = book table
//    transactions = issue/return table
// */

// $book_sql = "
//     SELECT 
//         t.id,
//         b.title,
//         u.name,
//         t.status,
//         t.return_date,
//         'book' AS type
//     FROM transactions t
//     JOIN books b ON t.book_id = b.id
//     JOIN user u ON t.user_id = u.id
//     ORDER BY t.id DESC
// ";

// $book_result = mysqli_query($connection, $book_sql);


/* Store all notifications in one array */
$notifications = [];


/* Registration notifications */
if ($registration_result) {

    while ($row = mysqli_fetch_assoc($registration_result)) {

        $notifications[] = [
            'id' => $row['id'],
            'type' => 'registration',
            'name' => $row['name'],
            'role' => $row['role']
        ];
    }
}


/* Book notifications */
// if ($book_result) {

//     while ($row = mysqli_fetch_assoc($book_result)) {

//         $notifications[] = [
//             'id' => $row['id'],
//             'type' => 'book',
//             'title' => $row['title'],
//             'name' => $row['name'],
//             'status' => $row['status'],
//             'return_date' => $row['return_date']
//         ];
//     }
// }


// /* Latest notifications first */
// usort($notifications, function ($a, $b) {
//     return $b['id'] <=> $a['id'];
// });

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    <link rel="stylesheet"
          href="notification.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>


<div class="notification-container">


        <div class="notification-count">

            <i class="fa-solid fa-bell"></i>

            <span>
                <?php echo count($notifications); ?>
            </span>

            Notifications

        </div>

    </div>



    <!-- ALL NOTIFICATIONS -->

    <div class="notification-list">


        <?php if (count($notifications) > 0) { ?>


            <?php foreach ($notifications as $notification) { ?>

                <?php if ($notification['type'] == 'registration') { ?>

                    <div class="notification-item registration">

                        <div class="notification-icon">

                            <i class="fa-solid fa-user-plus"></i>

                        </div>


                        <div class="notification-content">

                            <div class="notification-title">

                                <strong>
                                    New Registration Request
                                </strong>

                                <span class="badge new">
                                    NEW
                                </span>

                            </div>


                            <p>

                                <strong>
                                    <?php
                                    echo htmlspecialchars(
                                        $notification['name']
                                    );
                                    ?>
                                </strong>

                                wants to register as

                                <strong>
                                    <?php
                                    echo ucfirst(
                                        htmlspecialchars(
                                            $notification['role']
                                        )
                                    );
                                    ?>
                                </strong>

                            </p>


                            <small>

                                <i class="fa-regular fa-clock"></i>

                                Registration request is waiting
                                for approval

                            </small>

                        </div>


                        <div class="notification-action">

                            <a
                                href="approve.php?id=<?php echo $notification['id']; ?>"
                                class="approve">

                                <i class="fa-solid fa-check"></i>

                                Approve

                            </a>


                            <a
                                href="reject.php?id=<?php echo $notification['id']; ?>"
                                class="reject">

                                <i class="fa-solid fa-xmark"></i>

                                Reject

                            </a>

                        </div>

                    </div>


                <!-- BOOK NOTIFICATION -->

                <?php } else { ?>


                    <div class="notification-item book">

                        <div class="notification-icon">

                            <?php

                            if (
                                strtolower($notification['status'])
                                == 'returned'
                            ) {

                                echo '<i class="fa-solid fa-arrow-rotate-left"></i>';

                            } else {

                                echo '<i class="fa-solid fa-book"></i>';

                            }

                            ?>

                        </div>


                        <div class="notification-content">

                            <div class="notification-title">

                                <strong>

                                    <?php

                                    if (
                                        strtolower(
                                            $notification['status']
                                        ) == 'returned'
                                    ) {

                                        echo "Book Returned";

                                    } else {

                                        echo "Book Activity";

                                    }

                                    ?>

                                </strong>


                                <span class="badge book-badge">

                                    <?php
                                    echo ucfirst(
                                        htmlspecialchars(
                                            $notification['status']
                                        )
                                    );
                                    ?>

                                </span>

                            </div>


                            <p>

                                <strong>
                                    <?php
                                    echo htmlspecialchars(
                                        $notification['title']
                                    );
                                    ?>
                                </strong>

                                —

                                <?php
                                echo htmlspecialchars(
                                    $notification['name']
                                );
                                ?>

                                <?php

                                if (
                                    strtolower(
                                        $notification['status']
                                    ) == 'returned'
                                ) {

                                    echo " returned this book.";

                                } else {

                                    echo " has an active book transaction.";

                                }

                                ?>

                            </p>


                            <small>

                                <i class="fa-regular fa-clock"></i>

                                Book notification

                            </small>

                        </div>


                        <div class="arrow">

                            <i class="fa-solid fa-chevron-right"></i>

                        </div>

                    </div>


                <?php } ?>


            <?php } ?>


        <?php } else { ?>


            <!-- EMPTY -->

            <div class="empty-state">

                <div class="empty-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <h2>All Caught Up!</h2>

                <p>
                    There are no new notifications.
                </p>

            </div>


        <?php } ?>


    </div>


</div>


</body>

</html>