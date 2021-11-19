<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Shopping Page</title>
</head>
<body>
<?php
//for each item that isn t in cart
?>
<form method="post" action="index.php?id=<?=  ?>">
    <div class="product-container">
       <?php
       include 'item.view.php';
       ?>
        <input type="submit" name="add_to_cart" value="Add">
    </div>
</form>

</body>
</html>