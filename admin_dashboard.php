<?php
include 'database.php';
?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="admin_dashboard.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
        <header class="headers">
     <div class="heads">
      <div class="dashboard">
       
            <p>  <i class="fa-solid fa-bars"></i> Dashboard</p>
        </div>
    <nav class="mains">

    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search...">
    </div>

    <div class="menus">
        <i class="fa-solid fa-bell"></i>
    </div>

    <div class="menus">
        <i class="fa-regular fa-circle-user"></i>
    </div>

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
            <a href="admin_dashboard.php">
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
                <span>Students</span>
            </a>
        </li>
        <li>
            <a href="teachers.php">
                
               <i class="fa-solid fa-person-chalkboard"></i>
                <span>Teachers</span>
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
   <div class="main-content">

    <div class="welcome">
        <h1>Welcome, Admin!</h1>
        <p>Manage your library efficiently from your dashboard.</p>
    </div>

</div>
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
            <p>Students</p>
            <h2>540</h2>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-person-chalkboard"></i>
        </div>
        <div>
            <p>Teachers</p>
            <h2>35</h2>
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
<table class="table">
    <thead>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Role</td>
        <td>Status</td>
    </tr>
    </thead>
    </table>
 

</body>
</html>
