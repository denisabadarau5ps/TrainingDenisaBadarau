<?php
session_start();

require 'common.php';
require 'config.php';
$conn=connect();

if (isset($_POST['remove_from_cart'])) {
    foreach ($_SESSION["cart"] as $keys => $values) {
        if ($values["id"] == $_GET["id"]) {
            unset($_SESSION["cart"][$keys]);
        }
    }
}

if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        echo '<script>alert("Checkout!")</script>';
        $name =testInput($_POST['name']);
        $contacts = testInput($_POST['contact']);
        $comments = testInput($_POST['comments']);

        $to = strval($shopManagerEmail);
        $subject = "Shopping cart";
        $message = '
    <html>
    <head>
    <title>Shopping cart</title>
    </head>
    <body>';
        $product_id_array = array_column($_SESSION['cart'], "id");
        $cart = implode(",", $product_id_array);
        $sql = "SELECT * FROM products WHERE id IN($cart)";
        $result = $conn->query($sql);
        $message .= '    
    <p>Name:' . $name . '</p>
    <p>Contacts:' . $contacts . '</p>
    <p>Comments:' . $comments . '</p>
    ';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()):
                $id = $row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $price = $row["price"];

                $message .= '
                <div class="product-container">
                    <img class="product-image" src="images/' . $id . '.jpg" alt="Product Image" width="600" height="400">
                    <h3>' . $title . '</h3>
                    <div class="product-desc">
                        ' . $description . '
                        <br>
                      ' . $price . ' $
                    </div>
                </div>';
            endwhile;
        }
        unset($_SESSION['cart']);
        $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Shopping shop <info@address.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        mail($to,$subject,$message,$headers);

    } else {
        echo '<script>alert("Empty cart!")</script>';
        unset($_POST['checkout']);
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

if (!empty($_SESSION['cart'])) {
    $product_id_array = array_column($_SESSION['cart'], "id");
    $cart = implode(",", $product_id_array);
    $sql = "SELECT * FROM products WHERE id IN($cart)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()):
            $id = $row["id"];
            $title = $row["title"];
            $description = $row["description"];
            $price = $row["price"];
            ?>
            <form method="post" action="cart.php?id=<?= $id; ?>">
                <div class="product-container">
                    <img class="product-image" src="images/<?= $id ?>.jpg" alt="Product Image" width="600" height="400">
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
} else {
    ?>
    <div class="product-container">
        <img class="product-image" src="images/emptycart.png" alt="Product Image" width="600" height="400">
    </div>
    <?php
}
?>

<form method="post" action="cart.php">
    <div class="checkout-details-container">
        <input type="text" name="name" size="35" placeholder="Name" required><br><br>
        <textarea id="contact" name="contact" cols="35" placeholder="Contact details" required></textarea><br><br>
        <textarea id="comments" name="comments" rows="5" cols="35" placeholder="Comments" required></textarea>
        <input type="submit" name="checkout" value="Checkout" >
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
