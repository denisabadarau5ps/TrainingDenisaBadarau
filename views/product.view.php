<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Shopping Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="login-container">
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