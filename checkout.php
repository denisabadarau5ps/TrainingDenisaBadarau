<?php
require_once 'common.php';
require_once 'product.functions.php';

#order details
$name = $_SESSION['name'];
$contacts = $_SESSION['contacts'];
$comments = $_SESSION['comments'];

//add customer details in customers table
$sql = "INSERT INTO customers(name, contacts) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $contacts);
$stmt->execute();

//get customer id
$sql = "SELECT id FROM customers ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch();
$customer_id = $row['id'];

$_SESSION['orderDate'] = date("Y.m.d");

//add order in orders table
$sql = "INSERT INTO orders(customer_id, order_date) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $customer_id);
$stmt->bindParam(2, $_SESSION['orderDate']);
$stmt->execute();

//get order id
$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch();
$order_id = $row['id'];

//get all products from cart
$data=getAllProductsFromCart($_SESSION['cart']);

//add details for each product from order in order_details table
foreach ($data as $product) {
    $sql = "INSERT INTO order_details(order_id, product_id, product_price, quantity) VALUES(?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$order_id);
    $stmt->bindParam(2,$product->id);
    $stmt->bindParam(3,$product->price);
    $quantity=getQuantity($product->id, $_SESSION['cart']);
    $stmt->bindParam(4, $quantity);
    $stmt->execute();
}

//email for shop manager
ob_start()
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= translate("Shopping Page", "en") ?></title>
        <link rel="stylesheet" href="C:/xampp/htdocs/styles.css">
    </head>
        <body>
            <p>Name:<?= $name ?></p>
            <p>Contacts:<?= $contacts ?></p>
            <p>Comments:<?= $comments ?></p>
            <?php foreach($data as $product): ?>
                <div class="product-container">
                    <img class="product-image" src="C:/xampp/htdocs/images/<?= $product->id ?>.jpg"
                         alt=<?= translate("Product Image", "en") ?> width="600" height="400">
                    <h3><?= $product->title ?></h3>
                    <div class="product-desc">
                        <p><?= $product->description ?></p>
                        <p><?= $product->price ?> $ </p>
                        <p>Quantity: <?= getQuantity($product->id, $_SESSION['cart']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <h2> Total: <?= getSummedPrice($order_id) ?> $ </h2>
        </body>
</html>
<?php
$message = ob_get_clean();
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: Shopping Page <info@address.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$to = strval(SHOP_MANAGER_EMAIL);
$subject = "Shopping page";
mail($to, $subject, $message, $headers);

//checkout details for order view
$_SESSION['summed']=getSummedPrice($order_id);

//redirect to order view
header('Location: order.php');
die();