<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);
                if ($user['role'] == 'student' || $user['role'] == 'teacher') {

            if ($user['status'] == 'pending') {

                echo "<script>
                        alert('Your account is waiting for admin approval.');
                        window.location.href='login.php';
                      </script>";
                exit();

            }

            if ($user['status'] == 'rejected') {

                echo "<script>
                        alert('Your account has been rejected by admin.');
                        window.location.href='login.php';
                      </script>";
                exit();
            }
        }



        if ($user['role'] == 'admin') {

            $passwordCorrect = password_verify($password, $user['password']);

        } 
   
        else {

            $passwordCorrect = ($password == $user['password']);
        }

        if ($passwordCorrect) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {

                header("Location: admin_dashboard.php");
                exit();

            } elseif ($user['role'] == 'student') {

                header("Location: student_dashboard.php");
                exit();

            } elseif ($user['role'] == 'teacher') {

                header("Location: teacher_dashboard.php");
                exit();

            } 
        } else {

            echo "<script>
                    alert('Invalid email or password');
                  </script>";
        }

    } else {

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
                            <i class="fa-regular fa-eye" onclick="togglePassword('password')"></i>
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

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = passwordInput.nextElementSibling.querySelector('i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
        </script>

</body>
</html>