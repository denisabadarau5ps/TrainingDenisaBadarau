<?php
include 'common.php';
$conn = connect();

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    if (isset($_SESSION['prodIdEdit'])) {
        #update an item
        echo '<script>alert("Updated")</script>';
        $prodIdEdit = $_SESSION['prodIdEdit'];
        $sql = "UPDATE products SET title=?, description=?, price=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $prodIdEdit);
        $stmt->bindParam(4, $prodIdEdit);
        $stmt->execute();
        //update the image
        addImage($prodIdEdit);
        unset($_SESSION['prodIdEdit']);
    } else {
        #add an item
        echo '<script>alert("Added")</script>';
        $conn = connect();
        $sql = "INSERT INTO products (title, description, price) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $price);
        $stmt->execute();
        #add the image in folder
        $sql = "SELECT id FROM products ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch();

        #update the image
        addImage($row['id']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page") ?></title>
</head>
<body>
<div class="login-container">
    <form action="product.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder=<?= translate("Title") ?> required><br><br>
        <textarea name="description" placeholder=<?= translate("Description") ?> required></textarea><br><br>
        <input type="number" name="price" placeholder=<?= translate("Price") ?> required><br><br>
        <input type="file" name="fileToUpload" id="fileToUpload" style="margin-left: 20%;" required><br><br>
        <input type="submit" name="save" value="Save"> <br><br>
    </form>
    <a href="../products.php">
        <button>Products</button>
    </a>

</div>
</body>
</html>