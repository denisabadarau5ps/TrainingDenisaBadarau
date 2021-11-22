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


