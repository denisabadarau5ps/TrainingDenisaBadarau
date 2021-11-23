<?php
require_once 'common.php';
//get all products from products table
function getAllProducts()
{
    $conn = connect();
    $sql = "SELECT * FROM products";
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_CLASS);
    return $data;
}

//get all products that are not in cart
function getAllProductsNotInCart($cart)
{
    $conn = connect();
    $cart = implode(",", $cart);
    $sql = "SELECT * FROM products WHERE id NOT IN($cart)";
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_CLASS);
    return $data;
}

//get all products from cart
function getAllProductsFromCart($cart)
{
    $conn = connect();
    $cart = implode(",", $cart);
    $sql = "SELECT * FROM products WHERE id IN($cart)";
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_CLASS);
    return $data;
}

//get summed price of the attached products from an order
function getSummedPrice($orderId)
{
    $conn=connect();
    $sql="SELECT SUM(product_price) as sum FROM order_details WHERE order_id=?";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$orderId);
    $stmt->execute();
    $result=$stmt->fetch();
    $summed=$result['sum'];
    return $summed;
}

