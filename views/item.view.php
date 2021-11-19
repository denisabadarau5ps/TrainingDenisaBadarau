<img class="product-image" src="images/<?= $product->getId(); ?>.jpg" alt="Product Image" width="600" height="400">
<h3><?= $product->getTitle(); ?></h3>
<div class="product-desc">
    <?= $product->getDescriprion(); ?><br>
    <?= $product->getPrice(); ?> $
</div>
