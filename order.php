<?php
require_once 'common.php';
require_once 'product.functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['index'])) {
        unset($_SESSION['cart']);
        unset($_SESSION['name']);
        unset($_SESSION['contacts']);
        unset($_SESSION['summed']);
        header('location:index.php');
        die();
    }
}
$name = $_SESSION['name'];
$contacts = $_SESSION['contacts'];
$data = getAllProductsFromCart($_SESSION['cart']);
$summed = $_SESSION['summed'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page", "en") ?></title>
</head>
<body>
    <div class="order-container">
        <h1><?= $name ?>, your order is: </h1>
        <?php foreach ($data as $product): ?>
            <div class="order-product-container">
                <img class="product-image" src="images/<?= $product->id ?>.jpg"
                 alt=<?= translate("Product Image", "en") ?>  width="600" height="400">
                <h4><?= $product->title ?></h4>
                <div class="product-desc">
                    Quantity: <?= getQuantity($product->id, $_SESSION['cart']) ?>
                    <br>
                    <?= getPrice($product->price, getQuantity($product->id, $_SESSION['cart'])) ?> $
                </div>
            </div>
        <?php endforeach; ?>
        <p>Contact details: <?= $contacts ?></p>
        <h3>TOTAL: <?= $summed ?>$</h3>
        <form action="order.php" method="post">
            <input type="submit" name="index" value=<?= translate("Go to index", "en") ?>>
        </form>
    </div>
</body>
</html>
