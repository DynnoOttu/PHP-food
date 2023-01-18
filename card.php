<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cart quantity update!';
}

if (isset($_POST['delete_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart->execute([$cart_id]);
    $message[] = 'cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$user_id]);
    $message[] = 'deleted all from cart!';
}


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

    <div class="heading">
        <h3>shopping cart</h3>
        <p>cart / <a href="home.php">home</a></p>
    </div>

    <!-- cart section start -->

    <section class="products">
        <h1 class="title">your cart</h1>
        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {

            ?>
                    <form action="" method="POST" class="box">
                        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                        <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                        <button type="submit" class="fas fa-times" name="delete_cart" onclick="return confirm('delete this items form cart?');"></button>
                        <img src="uploaded_img/<?= $fetch_cart['image']; ?>" class="image" alt="">
                        <div class="name"><?= $fetch_cart['name']; ?></div>
                        <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div>
                            <input type="number" class="qty" name="qty" value="<?= $fetch_cart['quantity']; ?>" min="1" max="99" maxlength="2">
                            <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        </div>
                        <div class="sub-total">
                            sub total: <span>$<?= $subTotal = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
                        </div>
                    </form>
            <?php
                    $grand_total += $subTotal;
                }
            } else {
                echo '<p class=empty>your cart is empty</P>';
            }
            ?>
        </div>

        <div class="cart-total">
            <p class="grand-total">grand total : <span>$<?= $grand_total; ?></span></p>
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proced to checkout</a>
        </div>

        <div class="more-btn">
            <form action="" method="post">
                <button type="submit" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">delete all</button>
            </form>
        </div>

    </section>

    <!-- cart section end -->




    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>