<?php
session_start();
include 'common.php';
$conn=connect();

if(!isset($_SESSION['username'])){
    header('location:login.php');
    exit;
}

if(isset($_POST['edit'])){
    $_SESSION['prodIdEdit']=$_GET['id'];
    header('location:product.php');
    exit;
}

if(isset($_POST['delete'])){
    $prodId=$_GET['id'];
    $sql="DELETE FROM products WHERE id=' $prodId '";
     if($conn->query($sql)){
         echo  '<script>alert("Deleted")</script>';
     }
}

if(isset($_GET['add'])){
    header('location:product.php');
    exit;
}

if(isset($_GET['logout'])){
    unset($_SESSION['username']);
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$sql="SELECT * FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()):
        $id=$row["id"];
        $title=$row["title"];
        $description=$row["description"];
        $price= $row["price"];
        ?>
        <form method="post" action="products.php?id=<?= $id; ?>">
            <div class="product-container">
                <img class="product-image" src="images/<?= $id?>.jpg" alt="Product Image" width="600" height="400">
                <h3><?php echo $title ?></h3>
                <div class="product-desc">
                    <?php echo $description ?>
                    <br>
                    <?php echo $price ?> $
                </div>
                <input type="submit" name="edit" value="Edit">
                <input type="submit" name="delete" value="Delete">
            </div>
        </form>

    <?php endwhile;
}
?>
<form action="products.php">
    <div class="button-group">
        <button name="add">Add</button>
        <button name="logout">Logout</button>
    </div>
</form>
