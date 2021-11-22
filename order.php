<?php
require_once 'common.php';
require_once 'product.functions.php';
$conn = connect();
$name=$_SESSION['name'];
unset($_SESSION['name']);
$contacts=$_SESSION['contacts'];
unset($_SESSION['contacts']);
$data=getAllProductsFromCart($_SESSION['cart']);
unset($_SESSION['cart']);
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
   <h1><?= $name ?>, your order is: </h1>
    <?php foreach ($data as $product): ?>
        <div class="product-container">
            <img class="product-image" src="images/<?= $product->id ?>.jpg"
                     alt=<?= translate("Product Image") ?>  width="600" height="400">
            <h3><?= $product->title ?></h3>
            <div class="product-desc">
                <?= $product->price ?> $
            </div>
        </div>
    <?php endforeach; ?>
    <p>Contacts details: <?= $contacts?></p>
</div>
</body>
</html>
