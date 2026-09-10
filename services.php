 <?php
      include 'header.php';
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Services - Smart Library</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: inherit;
        }

        body {
            background: #f8faf9;
            color: #263b3a;
             font-family: inherit;
        }

        

        .services {
            padding: 55px 7%;
        }

        .services-container {
            max-width: 1150px;
            margin: auto;
        }

      
        .services-heading {
            text-align: center;
            margin-bottom: 42px;
        }

        .services-heading .top-title {
            color: #126b63;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .services-heading h1 {
            font-size: 38px;
            color: #243b3a;
            margin-bottom: 14px;
        }

        .services-heading p {
            color: #788582;
            font-size: 15px;
            line-height: 1.6;
            max-width: 580px;
            margin: auto;
        }

        .heading-line {
            width: 45px;
            height: 3px;
            background: #126b63;
            border-radius: 5px;
            margin: 0 auto 17px;
        }

      

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        

        .service-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 28px;

            border: 1px solid #e8eeee;

            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(30, 70, 65, 0.09);
        }



        .icon {
            width: 58px;
            height: 58px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;

            margin-bottom: 22px;
        }


        .book-icon {
            background: #e5f3f1;
            color: #126b63;
        }

        .student-icon {
            background: #e9edff;
            color: #5968d8;
        }

        .search-icon {
            background: #fff2dc;
            color: #df9428;
        }

        .record-icon {
            background: #f0e8ff;
            color: #8055c9;
        }

        .user-icon {
            background: #ffe9ee;
            color: #d65b79;
        }

        .report-icon {
            background: #e5f2fb;
            color: #3480aa;
        }


        .service-card h3 {
            font-size: 19px;
            color: #263b3a;
            margin-bottom: 10px;
        }

        .service-card p {
            color: #788582;
            font-size: 14px;
            line-height: 1.65;
        }

    

        .small-line {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #126b63;
            margin-top: 20px;
        }

       
        .service-note {
            margin-top: 30px;
            background: #edf6f4;
            border-radius: 12px;

            padding: 18px 25px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;

            color: #126b63;
            font-size: 14px;
        }

        .service-note i {
            font-size: 17px;
        }

       

        @media (max-width: 900px) {

            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .services {
                padding: 40px 5%;
            }

            .services-heading h1 {
                font-size: 30px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .service-note {
                text-align: center;
            }

        }

    </style>
</head>

<body>


   

    <section class="services">

        <div class="services-container">


       

            <div class="services-heading">

                <div class="top-title">
                    OUR SERVICES
                </div>

                <h1>
                    Everything You Need
                </h1>

                
                <p>
                    Manage your library easily with simple tools
                    designed for books, students and records.
                </p>

            </div>


            <div class="service-grid">


                <div class="service-card">

                    <div class="icon book-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <h3>
                        Book Management
                    </h3>

                    <p>
                        Add, update, remove and manage books
                        efficiently in one place.
                    </p>

                    <div class="small-line"></div>

                </div>


                <!-- Student -->

                <div class="service-card">

                    <div class="icon student-icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <h3>
                        Student Management
                    </h3>

                    <p>
                        Manage student information and keep
                        library membership records organized.
                    </p>

                    <div class="small-line"></div>

                </div>
                <div class="service-card">

                    <div class="icon search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <h3>
                        Quick Search
                    </h3>

                    <p>
                        Find books and student information
                        quickly whenever you need it.
                    </p>

                    <div class="small-line"></div>

                </div>

                <div class="service-card">

                    <div class="icon record-icon">
                        <i class="fa-solid fa-database"></i>
                    </div>

                    <h3>
                        Record Management
                    </h3>

                    <p>
                        Store and maintain important library
                        records in an organized database.
                    </p>

                    <div class="small-line"></div>

                </div>


                <div class="service-card">

                    <div class="icon user-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3>
                        User Management
                    </h3>

                    <p>
                        Manage library users and their
                        information with ease.
                    </p>

                    <div class="small-line"></div>

                </div>
                <div class="service-card">

                    <div class="icon report-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>

                    <h3>
                        Library Reports
                    </h3>

                    <p>
                        View useful library information and
                        keep track of important activities.
                    </p>

                    <div class="small-line"></div>

                </div>


            </div>

            <div class="service-note">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    A simple way to keep your library organized.
                </span>

            </div>


        </div>

    </section>


</body>
</html>