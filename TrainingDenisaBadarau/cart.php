<?php
session_start();

require  'common.php';
require 'config.php';

if(isset($_POST['remove_from_cart'])){
    foreach($_SESSION["cart"] as $keys => $values)
    {
        if($values["id"] == $_GET["id"])
        {
            unset($_SESSION["cart"][$keys]);
        }
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php

if(!empty($_SESSION['cart'])){
    $product_id_array=array_column($_SESSION['cart'],"id");
    $cart=implode(",",$product_id_array);
    $sql="SELECT * FROM products WHERE id IN($cart)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()):
            $id=$row["id"];
            $title=$row["title"];
            $description=$row["description"];
            $price= $row["price"];
            ?>
            <form method="post" action="cart.php?id=<?= $id; ?>">
                <div class="product-container">
                    <img class="product-image" src="images/<?= $id?>.jpg" alt="Product Image" width="600" height="400">
                    <h3><?php echo $title ?></h3>
                    <div class="product-desc">
                        <?php echo $description ?>
                        <br>
                        <?php echo $price ?> $
                    </div>
                    <input type="submit" name="remove_from_cart" value="Remove">
                </div>
            </form>

        <?php endwhile;
    }
}else{
    ?>
<div class="product-container">
    <img class="product-image" src="images/emptycart.png" alt="Product Image" width="600" height="400">
</div>
<?php
}
?>

<form method="post" action= action="cart.php?">
    <div class="checkout-details-container">
        <input type="text" id="name" size="35" value="Name" required><br><br>
        <textarea id="contact" name="contact" cols="35" required>Contact details</textarea>
        <textarea id="comments" name="comments" rows="5" cols="35">Comments</textarea>
        <button>Checkout</button>
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
