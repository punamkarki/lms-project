 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smart Library - Find, explore and manage books easily">
    <title>Document</title>

    <link rel="stylesheet" href="library.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
<?php
include "header.php"
?>
    <main>

        <section class="hero">

            <div class="heros">

                <div class="text">

                    <div class="p">
                        <span></span>
                        WELCOME TO SMART LIBRARY
                    </div>

                    <h1>
                        Find a book.
                        <span>Start reading.</span>
                    </h1>

                    <p class="des">
                        Looking for something interesting to read?
                        Search our collection, find your favourite books
                        and discover something new every day.
                    </p>

                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text" placeholder="Search for a book">

                        <button type="button">
                            Search
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="buttons">

                        <a href="books.html" class="btn1">
                            <i class="fa-solid fa-book"></i>
                            Browse Books
                        </a>

                        <a href="about.html" class="btn2">
                            About Library
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>

                    </div>

                    <div class="members">

                        <div class="faces">
                            <span>P</span>
                            <span>M</span>
                            <span>S</span>
                            <span>H</span>
                            <span class="more">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </div>

                        <div class="member-text">
                            <strong>2,500+ readers</strong>
                            <small>Readers already using our library</small>
                        </div>

                    </div>

                </div>

                <div class="area">

                    <div class="book">

                        <div class="book-left">
                            <span>READ</span>
                            <i class="fa-solid fa-book-open"></i>
                            <strong>DISCOVER</strong>
                        </div>

                        <div class="book-right">
                            <span>LEARN</span>
                            <i class="fa-solid fa-lightbulb"></i>
                            <strong>GROW</strong>
                        </div>

                    </div>

                    <div class="card">

                        <i class="fa-solid fa-quote-left"></i>

                        <p>
                            A good book can change the way
                            you see the world.
                        </p>

                    </div>

                </div>

            </div>

            <div class="numbers">

                <div class="nc">
                    <div class="ni">
                        <i class="fa-solid fa-book"></i>
                    </div>

                    <div>
                        <strong>10K+</strong>
                        <span>Books</span>
                    </div>
                </div>

                <div class="nc">
                    <div class="ni">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>

                    <div>
                        <strong>1,200+</strong>
                        <span>Authors</span>
                    </div>
                </div>

                <div class="nc">
                    <div class="ni">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <div>
                        <strong>50+</strong>
                        <span>Categories</span>
                    </div>
                </div>

                <div class="nc">
                    <div class="ni">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <div>
                        <strong>24/7</strong>
                        <span>Access</span>
                    </div>
                </div>

            </div>

        </section>

    </main>



</body>

</html>