<?php
require_once 'common.php';
require_once 'product.functions.php';
$conn=connect();
#order details
$name = sanitize($_POST['name']);
$contacts = sanitize($_POST['contact']);
$comments = sanitize($_POST['comments']);

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
    $sql = "INSERT INTO order_details(order_id, product_id, product_price) VALUES(?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$order_id);
    $stmt->bindParam(2,$product->id);
    $stmt->bindParam(3,$product->price);
    $stmt->execute();
}

//email for shop manager
$message = '
    <html>
    <head>
    <title>Shopping page</title>
      <link rel="stylesheet" href="styles.css">
    </head>
    <body>  
    <p>Name:' . $name . '</p>
    <p>Contacts:' . $contacts . '</p>
    <p>Comments:' . $comments . '</p>';

foreach($data as $product){
    $message.='
    <div class="product-container">
        <img class="product-image" src="images/' . $product->id . '.jpg" alt='. translate("Product Image","en") .' width="600" height="400">
        <h3>' . $product->title . '</h3>
        <div class="product-desc">
            <p>' . $product->description . '</p> <br>
            <p>' . $product->price . ' $ </p>
        </div>
    </div>';
}
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: Shopping shop <info@address.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$to = strval(SHOP_MANAGER_EMAIL);
$subject = "Shopping page";
mail($to, $subject, $message, $headers);

//checkout details for order view
$_SESSION['name']=$name;
$_SESSION['contacts']=$contacts;
$_SESSION['summed']=getSummedPrice($order_id);
header('location: order.php');
exit;