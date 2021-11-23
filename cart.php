<?php
require_once 'common.php';
require_once 'product.functions.php';
if (isset($_POST['remove_from_cart'])) {
    foreach ($_SESSION["cart"] as $keys => $values) {
        if ($values == $_GET["id"]) {
            unset($_SESSION["cart"][$keys]);
        }
    }
}
if (!empty($_SESSION['cart'])) {
    $data = getAllProductsFromCart($_SESSION['cart']);
} else {
    header('location: empty.php');
    exit;
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
<?php foreach ($data as $product): ?>
    <form method="post" action="cart.php?id=<?= $product->id; ?>">
        <div class="product-container">
            <img class="product-image" src="images/<?= $product->id ?>.jpg"
                 alt=<?= translate("Product Image", "en") ?> width="600" height="400">
            <h3><?= $product->title ?></h3>
            <div class="product-desc">
                <?= $product->description ?>
                <br>
                <?= $product->price ?> $
            </div>
            <input type="submit" name="remove_from_cart" value=<?= translate("Remove", "en") ?>>
        </div>
    </form>
<?php
endforeach;
$conn = null;
?>
<form method="post" action="checkout.php">
    <div class="checkout-details-container">
        <input type="text" name="name" size="35" placeholder=<?= translate("Name", "en") ?> required><br><br>
        <textarea id="contact" name="contact" cols="35"
                  placeholder=<?= translate("Contact details", "en") ?> required></textarea><br><br>
        <textarea id="comments" name="comments" rows="5" cols="35"
                  placeholder=<?= translate("Comments", "en") ?> required></textarea>
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
