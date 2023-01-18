<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'components/add_cart.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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

    <!-- home section start -->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>order online</span>
                        <h3>delicious pizza</h3>
                        <a href="menu.php" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="images/home-img-1.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>order online</span>
                        <h3>chezzy hamburger</h3>
                        <a href="menu.php" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="images/home-img-2.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>order online</span>
                        <h3>rosterd chikend</h3>
                        <a href="menu.php" class="btn">see menus</a>
                    </div>
                    <div class="image">
                        <img src="images/home-img-3.png" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- home section end -->

    <!-- home category section starts -->

    <section class="home-category">
        <h1 class="title">food category</h1>
        <div class="box-container">
            <a href="category.php?category=fast food" class="box">
                <img src="images/cat-1.png" alt="">
                <h3>fast food</h3>
            </a>

            <a href="category.php?category=main dish" class="box">
                <img src="images/cat-2.png" alt="">
                <h3>main dishes</h3>
            </a>

            <a href="category.php?category=drinks" class="box">
                <img src="images/cat-3.png" alt="">
                <h3>drinks</h3>
            </a>

            <a href="category.php?category=desserts" class="box">
                <img src="images/cat-4.png" alt="">
                <h3>desserts</h3>
            </a>
        </div>
    </section>
    <!-- home category section end -->

    <!-- home product section starts -->


    <section class="products">
        <h1 class="title">latest food</h1>
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                        <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                        <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
                        <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                            <input type="number" class="qty" name="qty" value="1" min="1" max="99" maxlength="2">
                        </div>
                    </form>
            <?php
                }
            } else {
                echo '<div class="empty">no products added yet!</div>';
            }
            ?>
        </div>
        <div class="more-btn">
            <a href="menu.php" class="btn">load more</a>
        </div>
    </section>


    <!-- home product section end -->






    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>

    <!-- swiper js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".home-slider", {
            effect: "flip",
            grabCursor: true,
            loop: true,
            pagination: {
                clickable: true,
                el: ".swiper-pagination",
            }
        });
    </script>


</body>

</html>