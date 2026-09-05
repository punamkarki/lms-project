<?php
session_start();
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    if($name=="" || $email=="" || $phone=="" || $password=="" || $confirm_password=="")
        {
        echo "<script>
                alert('Please fill in all fields!');
              </script>";
        }
        elseif(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))
         {
           echo "<script>
            alert('Please enter a valid email address!');
          </script>";
         }
         elseif(!preg_match("/^[0-9]{10}$/", $phone))
         {
          echo "<script>
                 alert('Please enter a valid 10-digit phone number!');
                  </script>";
        }
        elseif (strlen($password) < 8)
       {
         echo "<script>
                alert('Password must be at least 8 characters long!');
              </script>";
        }

      elseif($password!=$confirm_password)
        {
       echo "<script>
                alert('Passwords do not match!');
              </script>";
        } 
     else{
        $check="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($connection,$check);
        if(mysqli_num_rows($result)==1){
            echo "<script>
            alert('Email already exists!');
          </script>";
        }
        else{
            $sql="INSERT INTO user(name,email,phone,password) VALUES('$name','$email','$phone','$password')";
            if(mysqli_query($connection,$sql)){
                echo"<scipt>
                alert('Registration successful! You can now log in.');
                </script>";
            }
            else{
                echo "<script>
                alert('registration failed! Please try again.');
                </script>";
            }  
        }
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create your LibraManage library account">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="register.css">
</head>

<body>

    <header class="register-header">
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

    <main class="register-container">
        <div class="card">

            <div class="icon">
                <i class="fa-solid fa-user-plus"></i>
            </div>

            <h1>Create Account</h1>

            <p class="description">
                Join Smart Library and start your reading journey.
            </p>

            <form action="register.php" method="POST">

                <div class="fg">
                    <label for="name">Full Name</label>

                    <div class="box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" autocomplete="name" required>
                    </div>
                </div>

                <div class="fg">
                    <label for="email">Email Address</label>

                    <div class="box">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="email" required>
                    </div>
                </div>

                <div class="fg">
                    <label for="phone">Phone Number</label>

                    <div class="box">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" autocomplete="tel" required>
                    </div>
                </div>

                <div class="fg">
                    <label for="password">Password</label>

                    <div class="box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Create a password" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="fg">
                    <label for="confirm-password">Confirm Password</label>

                    <div class="box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" autocomplete="new-password" required>
                    </div>
                </div>

                <label class="terms">
                    <input type="checkbox" required>
                    <span>I agree to <a href="#">Terms & Conditions</a></span>
                </label>

                <button type="submit" class="btn">
                    Create Account
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

            <div class="login-link">
                Already have an account?
                <a href="login.php">Sign In</a>
            </div>

        </div>
    </main>

    <script>
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");

        document.querySelector("form").addEventListener("submit", function (e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
    </script>

</body>
</html>