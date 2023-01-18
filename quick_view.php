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
    <title>chopping cart</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- quick view section start -->

    <section class="quick-view">
        <h1 class="title">quick view</h1>
        <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                    <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
                    <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                    <div class="name"><?= $fetch_products['name']; ?></div>
                    <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                        <input type="number" class="qty" name="qty" value="1" min="1" max="99" maxlength="2">
                    </div>
                    <button type="submit" name="add_to_cart" class="cart-btn">add to card</button>
                </form>
        <?php
            }
        } else {
            echo '<div class="empty">no products found!</div>';
        }
        ?>
    </section>

    <!-- quick view section end -->




    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>