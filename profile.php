<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- profile section start -->

    <section class="user-profile">
        <div class="box">
            <img src="images/user-icon.png" alt="">
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
        </div>
    </section>

    <!-- profile section end -->





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>