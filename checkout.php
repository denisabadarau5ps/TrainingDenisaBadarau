<?php
require_once 'common.php';
require_once 'product.functions.php';
#order details
$name = sanitize($_POST['name']);
$contacts = sanitize($_POST['contact']);
$comments = sanitize($_POST['comments']);
$_SESSION['orderDate'] = date("Y.m.d");
$_SESSION['customerName'] =$name;
$_SESSION['customerContacts']=$contacts;

$to = strval(SHOP_MANAGER_EMAIL);
$subject = "Shopping page";

//get all products from cart
$data=getAllProductsFromCart($_SESSION['cart']);
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
        <img class="product-image" src="images/' . $product->id . '.jpg" alt=<?= translate("Product Image") ?> width="600" height="400">
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
mail($to, $subject, $message, $headers);

header('location: order.php');
exit;