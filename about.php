<?php
include "header.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: inherit;
        }

        body {
            background: #f4f8ff;
            color: #126b63;
            font-family:inherit;
        }
        .about-section {
            padding: 40px 5%;
        }

        .about-container {
            max-width: 1250px;
            margin: auto;
        }

       
        .about-main {
            background: #ffffff;
            border-radius: 16px;
            padding: 10px;
            display: grid;
            grid-template-columns: 1.3fr 0.8fr;
            gap: 35px;
            box-shadow: 0 5px 20px rgba(50, 90, 130, 0.08);
        }

        .about-text {
            padding: 10px;
        }

        .about-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            background: #e4f0ff;
            color: #126b63;

            padding: 8px 16px;
            border-radius: 30px;

            font-size: 17px;
            font-weight: 600;
        }

        .about-label i {
            font-size: 16px;
        }

        .about-text h1 {
            font-size: 43px;
            color: black;
            margin: 18px 0 18px;
            line-height: 1.15;
        }

        .about-text p {
            font-size: 17px;
            line-height: 1.7;
            color: #454547;
            margin-bottom: 18px;
            max-width: 750px;
        }

      
        .purpose-box {
            background: #eaf4ff;
            border-radius: 15px;

            padding: 40px 30px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;

            position: relative;
            overflow: hidden;
        }

        .purpose-box::before {
            content: "";
            width: 130px;
            height: 130px;

        

            position: absolute;
            top: -65px;
            right: -55px;

            border-radius: 50%;
        }

        .purpose-box::after {
            content: "";
            width: 110px;
            height: 110px;


            position: absolute;
            bottom: -65px;
            left: -55px;

            border-radius: 50%;
        }

        .purpose-icon {
            width: 90px;
            height: 90px;

            background: #126b63;
            color: white;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;

            margin-bottom: 20px;

           

            position: relative;
            z-index: 2;
        }

        .purpose-box h2 {
            font-size: 34px;
            color: #126b63;
            margin-bottom: 15px;

            position: relative;
            z-index: 2;
        }

        .purpose-line {
            width: 70px;
            height: 4px;
            background: #126b63;;
            border-radius: 10px;

            margin-bottom: 25px;

            position: relative;
            z-index: 2;
        }

        .purpose-box p {
            font-size: 17px;
            line-height: 1.7;
            color: #466487;

            max-width: 400px;

            position: relative;
            z-index: 2;
        }



        .features {
          
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
             display: flex;
             flex-direction:row;
            margin-top: 28px;
        }

        .feature-card {
            background: #ffffff;

            border-radius: 15px;

            padding: 30px 35px;

            box-shadow: 0 5px 20px rgba(50, 90, 130, 0.07);

            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(50, 90, 130, 0.12);
        }

   

        .feature-icon {
            width: 70px;
            height: 70px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;

            margin-bottom: 22px;
        }

        .book-icon {
            background: #dcecff;
            color:#126b63;;
        }

        .student-icon {
            background: #dcf8e7;
            color: #126b63;;
        }

        .record-icon {
            background: #eee3ff;
            color: #126b63;;
        }

        .feature-card h3 {
            font-size: 23px;
            color: #173d6b;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 17px;
            line-height: 1.6;
            color: #466487;
            margin-bottom: 20px;
        }

    
        

        .footer {
            text-align: center;
            padding: 25px;
            margin-top: 30px;

            color: #466487;
            font-size: 14px;
        }

        .footer::before {
            content: "";
            display: inline-block;

            width: 140px;
            height: 1px;

            background:#126b63; ;

            vertical-align: middle;
            margin-right: 25px;
        }

        .footer::after {
            content: "";
            display: inline-block;

            width: 140px;
            height: 1px;

            background: #126b63;

            vertical-align: middle;
            margin-left: 25px;
        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {

            .about-main {
                grid-template-columns: 1fr;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .about-text h1 {
                font-size: 35px;
            }

        }

        @media (max-width: 600px) {

            .about-section {
                padding: 25px 4%;
            }

            .about-main {
                padding: 25px;
            }

            .about-text h1 {
                font-size: 30px;
            }

            .about-text p {
                font-size: 15px;
            }

            .purpose-box h2 {
                font-size: 28px;
            }

            .feature-card {
                padding: 25px;
            }

            .footer::before,
            .footer::after {
                display: none;
            }

        }

    </style>
</head>

<body>

    

   <section class="about-section">

        <div class="about-container">


          
            <div class="about-main">


                <div class="about-text">

                    <div class="about-label">
                        <i class="fa-solid fa-circle-info"></i>
                        About Us
                    </div>

                    <h1>
                        Library Management System
                    </h1>

                    <div class="heading-line"></div>

                    <p>
                        The Library Management System is a web-based
                        application designed to make library activities
                        easier, faster, and more organized.
                    </p>

                    <p>
                        It helps administrators manage books, students,
                        and library records efficiently. The system
                        reduces manual work and keeps important
                        information stored in one place.
                    </p>

                    <p>
                        The system provides a simple and user-friendly
                        platform for managing library resources and
                        maintaining accurate records.
                    </p>

                </div>


                <!-- RIGHT SIDE -->

                <div class="purpose-box">

                    <div class="purpose-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>

                    <h2>
                        Our Purpose
                    </h2>

                    <div class="purpose-line"></div>

                    <p>
                        To simplify library management by providing
                        an organized digital system for books,
                        students, and library records.
                    </p>

                </div>

            </div>


            <div class="features">

                <div class="feature-card">

                    <div class="feature-icon book-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <h3>
                        Book Management
                    </h3>

                    <p>
                        Add, update, delete and search books
                        easily through the system.
                    </p>

                   

                </div>

                <div class="feature-card">

                    <div class="feature-icon student-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>

                    <h3>
                        Student Management
                    </h3>

                    <p>
                        Store and manage student information
                        in an organized way.
                    </p>

                   

                </div>


    

                <div class="feature-card">

                    <div class="feature-icon record-icon">
                        <i class="fa-solid fa-database"></i>
                    </div>

                    <h3>
                        Digital Records
                    </h3>

                    <p>
                        Maintain library records digitally
                        and access information easily.
                    </p>

                   

                </div>


            </div>

        </div>

    </section>


   

    <footer class="footer">

        © 2026 Library Management System. All rights reserved.

    </footer>


</body>
</html>