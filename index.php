<?php
require_once 'common.php';
require_once 'product.functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['cart']) && !array_key_exists($_GET['id'], $_SESSION['cart'])) {
        $_SESSION['cart'] += [$_GET['id'] => $_POST['quantity']];
    } else {
        $_SESSION['cart'] = [];
        $_SESSION['cart'] = [$_GET['id'] => $_POST['quantity']];
    }
    header('Location: index.php');
    die();
}
$data = !empty($_SESSION['cart']) ? getAllProductsNotInCart($_SESSION['cart']) : getAllProducts();
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
        <form method="post" action="index.php?id=<?= $product->id ?>">
            <div class="product-container">
                <img class="product-image" src="images/<?= $product->id ?>.jpg" alt=<?= translate("Product Image", "en") ?> width="600" height="400">
                <h3><?= $product->title; ?></h3>
                <div class="product-desc">
                    <?= $product->description; ?><br>
                    <?= $product->price; ?> $
                </div>
                <input type="number" id="quantity" name="quantity" min="1" max="10"
                   value="1">
                <input type="submit" name="add_to_cart" value=<?= translate("Add", "en") ?>>
            </div>
        </form>
    <?php endforeach; ?>
    <div class="button-container">
        <div class="button-submit">
            <a href="cart.php">
                <button><?= translate("Go to cart", "en") ?></button>
            </a>
        </div>
    </div>
</body>
</html>
