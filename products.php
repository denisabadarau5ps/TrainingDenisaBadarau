<?php
require_once 'common.php';
require_once 'product.functions.php';

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
if (isset($_POST['edit'])) {
    $_SESSION['prodIdEdit'] = $_GET['id'];
    header('location:product.php');
    unset($_POST['edit']);
    exit;
}
if (isset($_POST['delete'])) {
    $prodId = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=' $prodId '";
    if ($conn->query($sql)) {
        echo '<script>alert("Deleted")</script>';
    }
    unset($_SESSION['delete']);
}
if (isset($_GET['add'])) {
    header('location:product.php');
    unset($_SESSION['add']);
    exit;
}
if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    header("Location:index.php");
    exit;
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
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="delete" value="Delete">
        </div>
    </form>
<?php endforeach; ?>
<form action="products.php">
    <div class="button-group">
        <button name="add">Add</button>
        <button name="logout">Logout</button>
    </div>
</form>
</body>
</html>