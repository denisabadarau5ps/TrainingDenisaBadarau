<?php
require_once 'common.php';
require_once 'product.functions.php';
$name = $_SESSION['name'];
unset($_SESSION['name']);
$contacts = $_SESSION['contacts'];
unset($_SESSION['contacts']);
$data = getAllProductsFromCart($_SESSION['cart']);
unset($_SESSION['cart']);
$summed = $_SESSION['summed'];
unset($_SESSION['summed']);
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
                <?= $product->price ?> $
            </div>
        </div>
    <?php endforeach; ?>
    <p>Contact details: <?= $contacts ?></p>
    <h3>TOTAL: <?= $summed ?>$</h3>
    <a href="index.php">
        <button><?= translate("Go to index", "en") ?></button>
    </a>
</div>
</body>
</html>
