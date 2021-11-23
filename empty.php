<?php require_once 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= translate("Shopping Page","en") ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="product-container">
    <img class="product-image" src="images/emptycart.png" alt=<?= translate("Product Image","en") ?> width="600"
         height="400">
</div>
<div class="button-container">
    <div class="button-submit">
        <a href="index.php">
            <button><?= translate("Go to index", "en") ?></button>
        </a>
    </div>
</div>
</body>
</html>
