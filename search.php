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
    <title>search page</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- search box section start -->
    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search_box" placeholder="search here...." required maxlength="100" class="box">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form>
    </section>
    <!-- search box section end -->

    <section class="products" style="padding-top: 0; min-height:100vh;">
        <div class="box-container">
            <?php
            if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
                $searchBox = $_POST['search_box'];

                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$searchBox}%'");
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
            }
            ?>
        </div>
    </section>





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>