<?php
require_once 'common.php';
require_once 'product.functions.php';

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['edit'])) {
        $_SESSION['prodIdEdit'] = $_GET['id'];
        header('Location:product.php');
        die();
    }
    if (isset($_POST['delete'])) {
        $prodId = $_GET['id'];
        $sql = "DELETE FROM products WHERE id=' $prodId '";
        if ($conn->query($sql)) {
            echo '<script>alert("Deleted")</script>';
        }
        header('Location:products.php');
        die();
    }
    if (isset($_POST['add'])) {
        header('Location:product.php');
        die();
    }
    if (isset($_POST['logout'])) {
        unset($_SESSION['username']);
        header("Location:index.php");
        die();
    }
}
//get all products from products table
$data = getAllProducts();
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
        <form method="post" action="products.php?id=<?= $product->id; ?>">
            <div class="product-container">
                <img class="product-image" src="images/<?= $product->id ?>.jpg"
                     alt=<?= translate("Product Image", "en") ?>  width="600" height="400">
                <h3><?= $product->title ?></h3>
                <div class="product-desc">
                    <?= $product->description ?><br>
                    <?= $product->price ?> $
                </div>
                <input type="submit" name="edit" value="<?= translate("Edit", "en") ?>">
                <input type="submit" name="delete" value="<?= translate("Delete", "en") ?>">
            </div>
        </form>
    <?php endforeach; ?>
    <form action="products.php" method="post">
        <div class="button-group">
            <button name="add"><?= translate("Add", "en") ?></button>
            <button name="logout"><?= translate("Logout", "en") ?></button>
        </div>
    </form>
</body>
</html>