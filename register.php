<?php
include 'components/connect.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);

    if ($select_user->rowCount() > 0) {
        $message[] = 'email or number is already taken!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(name,email,number,password) VALUES(?,?,?,?)");
            $insert_user->execute([$name, $email, $number, $cpass]);
            $confirm_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $confirm_user->execute([$email, $pass]);
            $row = $confirm_user->fetch(PDO::FETCH_ASSOC);
            if ($confirm_user->rowCount() > 0) {
                $_SESSION['user_id'] = $row['id'];
                header('location: home.php');
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Custom File link Css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section start -->
    <?php include 'components/user_header.php' ?>
    <!-- header section end -->

    <!-- register section start -->

    <section class="form-container">
        <form action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="50" required>
            <input type="text" name="email" placeholder="enter your email" class="box" maxlength="50" required>
            <input type="number" name="number" placeholder="enter your number" class="box" max="9999999999" min="0" maxlength="13" required>
            <input type="password" name="pass" placeholder="enter your password" class="box" maxlength="50" required oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" placeholder="confirm your password" class="box" maxlength="50" required oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="register now" name="submit" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </section>

    <!-- register section end -->





    <!-- footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section end -->

    <!-- Custom Js -->
    <script src="js/script.js"></script>
</body>

</html>