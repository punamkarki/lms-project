<?php
session_start();
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email=$_POST['email'];
   $password=$_POST['password'];
   $sql="SELECT * FROM user WHERE email='$email' AND password='$password'";
   $result=mysqli_query($connection,$sql);
if(mysqli_num_rows($result)==1){
    $_SESSION['email']=$email;
    header("Location: dashboard.php");
}
else{
    echo "<script>
    alert('Invalid email or password');
    </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <header class="login-header">
 <a href="index.php" class="logo">
     
         <div class="logo-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div>
                <strong>LibraryManage</strong>
                <span>Smart Library</span>
            </div>
  </a>
        <a href="index.php" class="back">
            <i class="fa-solid fa-arrow-left"></i>
             Back to Home 
        </a>
    </header>

    <main class="login-container">
        <div class="card">

            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <h1>Welcome Back</h1>

            <p class="description">
                Sign in to continue to your library account.
            </p>

            <form method="POST" action="login.php">
                <div class="fg">
                    <label for="email">Email Address</label>

                    <div class="box">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="fg">
                    <div class="label">
                        <label for="password">Password</label>
                        <a href="#">Forgot password?</a>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>

                        <button type="button" id="showPassword">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <label class="remember">
                    <input type="checkbox">
                    <span>Remember me</span>
                </label>

                <button type="submit" class="b">
                 Sign In
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

            <div class="register">
                Don't have an account?
                <a href="register.php">Create an account</a>
            </div>

        </div>
    </main>

    

</body>
</html>