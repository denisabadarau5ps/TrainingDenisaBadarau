<?php
session_start();

require  'common.php';
$conn=connect();
unset($_SESSION['cart']);
if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
        if(!in_array($_GET['id'],$_SESSION['cart'])){
            array_push($_SESSION['cart'],$_GET['id']);
        }
    }else{
        $_SESSION['cart']=$_GET['id'];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="views/css/styles.css">
</head>
<body>

<?php
if(!empty($_SESSION['cart'])){
    $product_id_array=$_SESSION['cart'];
    $cart=implode(",",$product_id_array);
    $sql = "SELECT *  FROM products WHERE id NOT IN ($cart)";
}else{
    $sql = "SELECT *  FROM products ";
}

$result = $conn->query($sql);

    while($row = $result->fetch()):
        $id=$row["id"];
        $title=$row["title"];
        $description=$row["description"];
        $price= $row["price"];
       ?>
    <form method="post" action="index.php?id=<?= $id; ?>">
      <div class="product-container">
            <img class="product-image" src="images/<?= $id?>.jpg" alt="Product Image" width="600" height="400">
            <h3><?php echo $title ?></h3>
            <div class="product-desc">
                <?php echo $description ?>
                <br>
                <?php echo $price ?> $
            </div>
            <input type="submit" name="add_to_cart" value="Add">
        </div>
    </form>
      <?php endwhile;
?>
<div class="button-container">
    <div class="button-submit">
          <a href="cart.php">
              <button >Go to cart</button>
          </a>
    </div>
</div>
<?php

$conn=null;
?>

</body>
</html>
