<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="views/css/styles.css">
</head>
<body>
<?php
//foreach products from produts table
?>
<form method="post" action="products.php?id=<?= $id; ?>">
    <div class="product-container">
       <?php
       include 'item.view.phpr'
       ?>
        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="delete" value="Delete">
    </div>
</form>

<form action="products.php">
    <div class="button-group">
        <button name="add">Add</button>
        <button name="logout">Logout</button>
    </div>
</form>

