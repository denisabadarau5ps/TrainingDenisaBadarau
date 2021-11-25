<?php
include 'common.php';

$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        if (!empty($_POST['username'])) {
            $username = sanitize($_POST['username']);
        } else {
            $errors['username'] = 'Empty username field';
        }
        if (!empty($_POST['password'])) {
            $password = sanitize($_POST['password']);
        } else {
            $errors['password'] = 'Empty password field';
        }
        if (empty($errors) && $username == ADMIN_USERNAME && $password == ADMIN_PASSWORD) {
            $_SESSION['username'] = $username;
            header('Location: products.php');
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page", "en") ?></title>
</head>
<body>
    <div class="login-container">
        <h1><?= translate("Login", "en") ?></h1>
        <form action="login.php" method="post">
            <label for="username"><?= translate("Username: ", "en") ?></label>
            <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
            <br>
            <?php if (key_exists('username', $errors)): ?>
                <p class="errors"><?= $errors['username'] ?></p>
            <?php endif; ?>
            <br>
            <label for="password"><?= translate("Password: ", "en") ?></label>
            <input type="password" name="password">
            <br>
            <?php if (key_exists('password', $errors)): ?>
                <p class="errors"><?= $errors['password'] ?></p>
            <?php endif; ?>
            <br>
            <input type="submit" name="login" value=<?= translate("Login", "en") ?>>
        </form>
    </div>
</body>
</html>
