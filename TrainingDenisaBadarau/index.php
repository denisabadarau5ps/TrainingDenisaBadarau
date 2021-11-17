<?php
session_start();

require  'common.php';
$conn=connect();

if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
        $product_id_array=array_column($_SESSION['cart'],"id");
        if(!in_array($_GET['id'],$product_id_array)){
            $session_array=array('id'=>$_GET['id']);
            $_SESSION['cart'][]=$session_array;
        }
    }else{
        $session_array=array('id'=>$_GET['id']);
        $_SESSION['cart'][]=$session_array;
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
    $sql = "SELECT *  FROM products WHERE id NOT IN ($cart)";
}else{
    $sql = "SELECT *  FROM products ";
}

$result = $conn->query($sql);

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()):
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
}
?>
<div class="button-container">
    <div class="button-submit">
          <a href="cart.php">
              <button >Go to cart</button>
          </a>
    </div>
</div>
<?php

$conn->close();
?>

</body>
</html>
