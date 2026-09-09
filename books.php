


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="books.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php
    include 'admin_head.php'
    ?>
<div class="stats">

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-book"></i>
        </div>
     <div>
            <p>Total Books</p>
            <h2>1,250</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <p>Returned Books</p>
     <h2> 20</h2>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-person-chalkboard"></i>
        </div>
        <div>
            <p>Overdue Books</p>
            <h2>20</h2>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-book-open-reader"></i>
        </div>
        <div>
            <p>Issued Books</p>
            <h2>85</h2>
        </div>
    </div>
</div>

    <div class="schedule-section">

    <div class="section-header">
            <h2>Book Issue Schedule</h2>
            <p>View books provided to each faculty by day.</p>
    </div>

    <div class="schedule-table">

        <table>

            <thead>
                <tr>
                    <th>Day</th>
                    <th>Faculty</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Sunday</td>
                    <td>BCA</td>
                    <td>Database Management System</td>
                    <td>20</td>
                    <td>
                        <span class="available">Available</span>
                    </td>
                </tr>

                <tr>
                    <td>Monday</td>
                    <td>BBS</td>
                    <td>Financial Accounting</td>
                    <td>15</td>
                    <td>
                        <span class="available">Available</span>
                    </td>
                </tr>

                <tr>
                    <td>Tuesday</td>
                    <td>BSc CSIT</td>
                    <td>Programming in C</td>
                    <td>18</td>
                    <td>
                        <span class="available">Available</span>
                    </td>
                </tr>

                <tr>
                    <td>Wednesday</td>
                    <td>BCA</td>
                    <td>Web Technology</td>
                    <td>12</td>
                    <td>
                        <span class="available">Available</span>
                    </td>
                </tr>

                <tr>
                    <td>Thursday</td>
                    <td>BBA</td>
                    <td>Principles of Management</td>
                    <td>10</td>
                    <td>
                        <span class="available">Available</span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
