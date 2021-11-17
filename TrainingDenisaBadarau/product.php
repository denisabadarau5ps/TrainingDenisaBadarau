<?php
session_start();
include 'common.php';
$conn=connect();

if(!isset($_SESSION['username'])){
    header('location:login.php');
    exit;
}

if(isset($_POST['save'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];

    if(isset($_SESSION['prodIdEdit'])){
        #update an item
        $prodIdEdit=$_SESSION['prodIdEdit'];
        $sql="UPDATE products SET title='$title', description='$description', price='$price' WHERE id='$prodIdEdit'";

        #update the image
        $fileNewName= $prodIdEdit;
        if ($conn->query($sql)) {
            echo  '<script>alert("Updated")</script>';
            unset($_SESSION['prodIdEdit']);
        }
    }else {
        #add an item
        $sql = "INSERT INTO products(title, description, price) VALUES('$title','$description','$price')";
        if ($conn->query($sql)) {
            echo '<script>alert("Added")</script>';
            $sql="SELECT id FROM products ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);
            $row=$result->fetch_assoc();
            #update the image
            $fileNewName = $row['id'];
        }
    }
    #update the image
    $targetDir = "C:/xampp/htdocs/TrainingDenisaBadarau/images/";
    $file = $_FILES['fileToUpload']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['fileToUpload']['tmp_name'];
    $path_filename_ext = $targetDir.$fileNewName.".".$ext;
    move_uploaded_file($temp_name,$path_filename_ext);
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
    <div class="loginContainer">
       <form action="product.php" method="post" enctype="multipart/form-data">
           <input type="text" name="title" placeholder="Title" required><br><br>
           <textarea name="description" placeholder="Description" required></textarea><br><br>
           <input type="number" name="price" placeholder="Price" required><br><br>
           <input type="file" name="fileToUpload" id="fileToUpload" style="margin-left: 20%;" required><br><br>
           <input type="submit" name="save" value="Save"> <br><br>
       </form>
        <a href="products.php">
            <button>Products</button>
        </a>

    </div>
</body>
</html>