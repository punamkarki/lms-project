<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="library.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="head">

            <a href="index.php" class="brand">
                <div class="brand-content">
                    <strong>Smart Library</strong>
                    <span>Your place to read</span>
                </div>
            </a>

<nav class="main"> 

    <a href="index.php" class="menu <?php echo ($currentPage == 'index.php') ? 'current' : ''; ?>">
        <i class="fa-solid fa-house"></i>Home
    </a> 

    <a href="services.php" class="menu <?php echo ($currentPage == 'services.php') ? 'current' : ''; ?>">
        <i class="fa-solid fa-book"></i>Services</a> 

    <a href="categories.php" class="menu <?php echo ($currentPage == 'categories.php') ? 'current' : ''; ?>">
        <i class="fa-solid fa-layer-group"></i>Categories</a> 

    <a href="about.php" class="menu <?php echo ($currentPage == 'about.php') ? 'current' : ''; ?>">
        <i class="fa-solid fa-circle-info"></i>About</a> 

    <a href="contact.php" class="menu <?php echo ($currentPage == 'contact.php') ? 'current' : ''; ?>">
        <i class="fa-solid fa-envelope"></i>Contact</a> 
 </nav>
           
            <div class="auth">
                <a href="login.php" class="signin">Sign in</a>

                <a href="register.php" class="join">
                    Join Library
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            

        </div>
    </header>
</body>
</html>