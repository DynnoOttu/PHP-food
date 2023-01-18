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
    $address = $_POST['flat'] . ', ' . $_POST['building'] . ', ' . $_POST['area'] . ', ' . $_POST['town'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE id = ?");
    $update_address->execute([$address, $user_id]);
    $message[] = 'user updated!';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update address</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- update address section start -->

    <section class="form-container">
        <form method="POST" action="">
            <h3>your address</h3>
            <input type="text" name="flat" maxlength="50" required placeholder="flat no." class="box">
            <input type="text" name="building" maxlength="50" required placeholder="building." class="box">
            <input type="text" name="area" maxlength="50" required placeholder="area name" class="box">
            <input type="text" name="town" maxlength="50" required placeholder="town name" class="box">
            <input type="text" name="city" maxlength="50" required placeholder="city name" class="box">
            <input type="text" name="state" maxlength="50" required placeholder="state name" class="box">
            <input type="text" name="country" maxlength="50" required placeholder="country" class="box">
            <input type="number" name="pin_code" required placeholder="enter your pin code" maxlength="6" min="0" max="999999" class="box">
            <input type="submit" value="save address" name="submit" class="btn">
        </form>
    </section>

    <!-- update address section end -->





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>