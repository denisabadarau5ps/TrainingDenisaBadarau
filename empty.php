<?php require_once 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= translate("Shopping Page") ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="product-container">
    <img class="product-image" src="images/emptycart.png" alt=<?= translate("Product Image") ?> width="600"
         height="400">
</div>
<div class="button-container">
    <div class="button-submit">
        <a href="index.php">
            <button>Go to index</button>
        </a>
    </div>
</div>
</body>
</html>
