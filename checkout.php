<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_products = filter_var($total_products, FILTER_SANITIZE_STRING);
    $total_price = $_POST['total_price'];
    $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
        if ($address == '') {
            $message[] = 'place enter your address';
        } else {
            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");

            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ? ");
            $delete_cart->execute([$user_id]);

            $message[] = 'order placed successfully';
        }
    } else {
        $message[] = 'your card is empty';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- checkout section start -->
    <section class="checkout">
        <form action="" method="post">
            <h1 class="title">order summary</h1>

            <div class="cart-items">
                <h3>cart items</h3>
                <?php
                $grand_total = 0;
                $cart_items[] = '';
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $cart_items[] = $fetch_cart['name'] . '  (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') -';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                ?>
                        <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
                <?php
                    }
                } else {
                    echo '<p class="empty">your cart is empty</p>';
                }
                ?>
                <p class="grand-total">
                    <span class="name">grand total :</span><span class="price">$<?= $grand_total; ?></span>
                </p>

                <a href="cart.php" class="btn">view cart</a>
            </div>
            <input type="hidden" name="total_products" value="<?= $total_products ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
            <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile['email']; ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile['number']; ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile['address']; ?>">


            <div class="user-info">
                <h3>user info</h3>
                <p><i class="fas fa-user"></i> <span><?= $fetch_profile['name']; ?></span></p>
                <p><i class="fas fa-envelope"></i> <span><?= $fetch_profile['email']; ?></span></p>
                <p><i class="fas fa-phone"></i> <span><?= $fetch_profile['number']; ?></span></p>
                <a href="update_profile.php" class="btn" style="margin-bottom: 1rem;">update info</a>
                <p><i class="fas fa-map-marker-alt"></i> <span><?php if ($fetch_profile['address'] == '') {
                                                                    echo
                                                                    'Place enter your address';
                                                                } else {
                                                                    echo
                                                                    $fetch_profile['address'];
                                                                } ?></span></p>
                <a href="update_address.php" class="btn">update address</a>
                <select name="method" id="" class="select-box" required>
                    <option value="" disabled selected>select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit cart">credit cart</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
                <input type="submit" value="place order" name="submit" class="btn <?php if ($fetch_profile['address'] == '') {
                                                                                        echo 'disabled';
                                                                                    } ?>" style="background-color: var(--red); color: var(--white); width: 100%;">
            </div>
        </form>

    </section>
    <!-- checkout section end -->





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>