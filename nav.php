<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="dashboard.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
        <header class="headers">
     <div class="heads">
        <a href="dashboard.php" class="brands">
        <!-- <div class="brand-contents">
         <strong>Smart Library</strong>
         <span>Your place to read</span>
        </div> -->
     <nav class="mains">
            <a href="#" class="menus">Search</a>
            <a href="#" class="menus">Notification</a>
            <a href="#" class="menus">Profile</a>
            <a href="logout.php" class="menus">Logout</a>
     </nav>
     </div>
    </header>
    <div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-book-open"></i>
        <span>LIBRARY</span>
    </div>

    <ul class="menu">

        <li class="active">
            <a href="dashboard.php">
      <i class="fa-solid fa-bars"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="books.php">
                <i class="fa-solid fa-book"></i>
                <span>Books</span>
            </a>
        </li>

      
        <li>
            <a href="students.php">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Students<span>
            </a>
        </li>
        <li>
            <a href="teachers.php">
                
               <i class="fa-solid fa-person-chalkboard"></i>
                <span>Teachers<span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Issue Books</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Return Books</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-clock"></i>
                <span>Overdue Books</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-chart-line"></i>
                <span>Reports</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>

    <div class="sidebar-bottom">
        <a href="#">
            <i class="fa-solid fa-circle-question"></i>
            <span>Need Help?</span>
        </a>

    
    </div>

</div>
</body>
</html>