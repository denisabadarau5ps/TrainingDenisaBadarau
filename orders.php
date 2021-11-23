<?php
require_once 'common.php';
require_once 'product.functions.php';
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
//get all orders
$sql = "SELECT o.id AS id, c.name AS name, o.order_date AS ord_date FROM orders o JOIN customers c ON o.customer_id=c.id";
$orders = $conn->query($sql)->fetchAll(PDO::FETCH_CLASS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page", "en") ?></title>
</head>
<body>
<table>
    <tr>
        <th>Order number</th>
        <th>Order customer</th>
        <th>Created date</th>
        <th>Summed price</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->name ?></td>
            <td><?= $order->ord_date ?></td>
            <td><?= getSummedPrice($order->id) ?>$</td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
