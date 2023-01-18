<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <div class="heading">
        <h3>about us</h3>
        <p>about / <a href="home.php">home</a></p>
    </div>

    <!-- about section start -->
    <section class="about">
        <div class="row">
            <div class="image">
                <img src="images/about-img.svg" alt="">
            </div>
            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos ab pariatur explicabo quibusdam ad, voluptas nam cumque quis corrupti sed id repellendus minus dolorum vitae doloribus minima. Dolorum iste, unde enim alias perferendis expedita. Accusamus consectetur sint ab porro impedit maxime quo iusto, deserunt consequuntur sit ipsa adipisci obcaecati commodi?</p>
                <a href="menu.php" class="btn">our menu</a>
            </div>
        </div>
    </section>
    <!-- about section end -->

    <section class="steps">
        <h1 class="title">3 simple steps</h1>
        <div class="box-container">
            <div class="box">
                <img src="images/step-1.png" alt="">
                <h3>select foods</h3>
            </div>
            <div class="box">
                <img src="images/step-2.png" alt="">
                <h3>fast delivery</h3>
            </div>
            <div class="box">
                <img src="images/step-3.png" alt="">
                <h3>enjoy foods</h3>
            </div>
        </div>
    </section>

    <!-- riview section start -->

    <section class="reviews">
        <h1 class="title">custemor's reviews</h1>
        <div class="swiper reviews-sliders">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <img src="images/pic-1.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-2.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-3.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-4.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-5.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-6.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam aut nobis laborum, eos numquam recusandae reprehenderit veritatis libero rerum et expedita omnis doloribus perferendis iure!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jhon deo</h3>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- riview section end -->





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- Custom Js -->
    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".reviews-sliders", {
            grabCursor: true,
            loop: true,
            spaceBetween: 20,
            pagination: {
                clickable: true,
                el: ".swiper-pagination",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>