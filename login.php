<?php
include 'common.php';
if (isset($_POST['login'])) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if ($username == ADMIN_USERNAME) {
        if ($password == ADMIN_PASSWORD) {
            $_SESSION['username'] = $username;
            header('Location: products.php');
            exit;
        } else {
            echo '<script>alert("Wrong username or password!")</script>';
        }
    } else {
        echo '<script>alert("Wrong username or password!")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page") ?></title>
</head>
<body>
<div class="login-container">
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder=<?= translate("Username") ?> required><br><br>
        <input type="password" name="password" placeholder=<?= translate("Password") ?> required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>
