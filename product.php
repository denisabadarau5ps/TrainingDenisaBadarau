<?php
include 'common.php';
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
$errors=[];
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['save'])) {
        if (!empty($_POST['title'])){
            $title = sanitize($_POST['title']);
        } else {
            $errors['title'] = 'Empty title field';
        }

        if (!empty($_POST['description'])) {
            $description = sanitize($_POST['description']);
        } else {
            $errors['description'] = 'Empty description field';
        }

        if (!empty($_POST['price'])) {
            $description = sanitize($_POST['price']);
        } else {
            $errors['price'] = 'Empty price field';
        }

        if (!is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            $errors['fileToUpload'] = 'Empty field';
        }

        if (empty($errors)){
            if (isset($_SESSION['prodIdEdit'])) {
                #update an item
                $prodIdEdit = $_SESSION['prodIdEdit'];
                $sql = "UPDATE products SET title=?, description=?, price=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $description);
                $stmt->bindParam(3, $price);
                $stmt->bindParam(4, $prodIdEdit);
                $stmt->execute();

                //update the image
                deleteImage($prodIdEdit);
                addImage($prodIdEdit);

                unset($_SESSION['prodIdEdit']);
            } else {
                #add an item
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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title><?= translate("Shopping Page", "en") ?></title>
</head>
<body>
    <div class="login-container">
        <form action="product.php" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder=<?= translate("Title", "en") ?> value="<?= isset($_POST['title']) ? $_POST['title'] : '' ?>" >
            <br>
            <?php if (key_exists('title', $errors)): ?>
                <p class="errors"><?= $errors['title']?></p>
            <?php endif; ?>
            <br>
            <textarea name="description" placeholder=<?= translate("Description", "en") ?> ><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
            <br>
            <?php if (key_exists('description', $errors)): ?>
                <p class="errors"><?= $errors['description']?></p>
            <?php endif; ?>
            <br>
            <input type="number" name="price" placeholder=<?= translate("Price", "en") ?> value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>" >
            <br>
            <?php if (key_exists('price', $errors)): ?>
                <p class="errors"><?= $errors['price']?></p>
            <?php endif; ?>
            <br>
            <input type="file" name="fileToUpload" id="fileToUpload" style="margin-left: 20%;" >
            <br>
            <?php if (key_exists('fileToUpload', $errors)): ?>
                <p class="errors"><?= $errors['fileToUpload']?></p>
            <?php endif; ?>
            <br>
            <input type="submit" name="save" value="<?= translate("Save", "en") ?>"> <br><br>
        </form>
        <a href="products.php">
            <button><?= translate("Products", "en") ?></button>
        </a>
    </div>
</body>
</html>