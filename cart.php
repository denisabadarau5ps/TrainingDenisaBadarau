<?php
require_once 'common.php';
require_once 'product.functions.php';

$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_from_cart'])) {
        foreach ($_SESSION["cart"] as $keys => $values) {
            if ($keys == $_GET["id"]) {
                if ($_SESSION["cart"][$keys] == 1) {
                    unset($_SESSION['cart'][$keys]);
                } else {
                    $_SESSION["cart"][$keys]--;
                }
            }
        }
    }
    if (isset($_POST['add_in_cart'])) {
        foreach ($_SESSION["cart"] as $keys => $values) {
            if ($keys == $_GET["id"]) {
                $_SESSION["cart"][$keys]++;
            }
        }
    }
    if (isset($_POST["checkout"])) {
        if (!empty($_POST['name'])) {
            $_SESSION['name'] = sanitize($_POST['name']);
        } else {
            $errors['name'] = 'Empty name';
        }
        $_SESSION['contacts'] = sanitize($_POST['contacts']);
        $_SESSION['comments'] = sanitize($_POST['comments']);
        if (!empty($_SESSION['cart']) && empty($errors)) {
            header('Location:checkout.php');
            die();
        }
    }
    if (empty($errors)){
        header('Location: cart.php');
        die();
    }
}
$data = !empty($_SESSION['cart']) ? getAllProductsFromCart($_SESSION['cart']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page", "en") ?></title>
</head>
<body>
    <?php foreach ($data as $product): ?>
        <form method="post" action="cart.php?id=<?= $product->id; ?>">
            <div class="product-container">
                <img class="product-image" src="images/<?= $product->id ?>.jpg"
                 alt=<?= translate("Product Image", "en") ?> width="600" height="400">
                <h3><?= $product->title ?></h3>
                <div class="product-desc">
                    <?= $product->description ?>
                    <br>
                    <?= getPrice($product->price, getQuantity($product->id, $_SESSION['cart'])) ?> $
                    <br>
                    Quantity: <?= getQuantity($product->id, $_SESSION['cart']) ?>
                </div>
                <input type="submit" name="add_in_cart" value=<?= translate("Add", "en") ?>>
                <input type="submit" name="remove_from_cart" value=<?= translate("Remove", "en") ?>>
            </div>
        </form>
    <?php endforeach; ?>
    <form method="post" action="cart.php">
        <div class="checkout-details-container">
            <input type="text" name="name" size="35" placeholder=<?= translate("Name", "en") ?>  value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
            <br>
            <?php if (key_exists('name', $errors)): ?>
                <p><?= $errors['name'] ?></p>
            <?php endif; ?>
            <br>
            <textarea id="contacts" name="contacts" cols="35"
                  placeholder=<?= translate("Contact details", "en") ?> ><?= isset($_POST['contacts']) ? $_POST['contacts'] : '' ?></textarea><br><br>
            <textarea id="comments" name="comments" rows="5" cols="35"
                  placeholder=<?= translate("Comments", "en") ?> ></textarea>
            <input type="submit" name="checkout" value=<?= translate("Checkout", "en") ?>>
        </div>
    </form>
    <div class="button-container">
        <div class="button-submit">
            <a href="index.php">
                <button><?= translate("Go to index", "en") ?></button>
            </a>
        </div>
    </div>
</body>
</html>
