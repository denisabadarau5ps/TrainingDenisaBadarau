<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Shopping Page</title>
</head>
<body>
<?php
//for each item from cart
?>
<form method="post" action="cart.php?id=<?=  ?>">
    <div class="product-container">
        <?php
        include 'item.view.php';
        ?>
        <input type="submit" name="remove_from_cart" value="Remove">
    </div>
</form>

<form method="post" action="cart.php">
    <div class="checkout-details-container">
        <input type="text" name="name" size="35" placeholder="Name" required><br><br>
        <textarea id="contact" name="contact" cols="35" placeholder="Contact details" required></textarea><br><br>
        <textarea id="comments" name="comments" rows="5" cols="35" placeholder="Comments" required></textarea>
        <input type="submit" name="checkout" value="Checkout">
    </div>
</form>

<div class="button-container">
    <div class="button-submit">
        <a href="index.php">
            <button>Go to index</button>
        </a>
    </div>
</div>
</body>
</html>