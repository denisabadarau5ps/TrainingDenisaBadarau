<?php
require_once 'common.php';
if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        if (!in_array($_GET['id'], $_SESSION['cart'])) {
            array_push($_SESSION['cart'], $_GET['id']);
        }
    } else {
        $_SESSION['cart'] = array();
        array_push($_SESSION['cart'], $_GET['id']);
    }
}

if (!empty($_SESSION['cart'])) {
    $cart = implode(",", $_SESSION['cart']);
    $sql = "SELECT * FROM products WHERE id NOT IN($cart)";
} else {
    $sql = "SELECT * FROM products";
}
$data = $conn->query($sql)->fetchAll(PDO::FETCH_CLASS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Shopping Page</title>
</head>
<body>
    <?php foreach ($data as $product): ?>
        <form method="post" action="index.php?id=<?= $product->id ?>">
            <div class="product-container">
                <img class="product-image" src="images/<?= $product->id ?>.jpg" alt="Product Image" width="600"
                 height="400">
                <h3><?= $product->title; ?></h3>
                <div class="product-desc">
                    <?= $product->description; ?><br>
                    <?= $product->price; ?> $
                </div>
                <input type="submit" name="add_to_cart" value="Add">
            </div>
        </form>
    <?php
    endforeach;
    $conn = null;
    ?>
    <div class="button-container">
        <div class="button-submit">
            <a href="cart.php">
                <button>Go to cart</button>
            </a>
        </div>
    </div>
</body>
</html>








