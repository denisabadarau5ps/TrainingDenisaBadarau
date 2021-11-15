<link rel="stylesheet" href="styles.css">
<script>
    function addCart(id)
    {
        alert(id);
    }
</script>

<?php
require  'common.php';

$cart_array=array(3);
$cart=implode(',', $cart_array);
$sql = "SELECT *  FROM products WHERE id NOT IN ($cart)";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()):
        $id=$row["id"];
        $title=$row["title"];
        $description=$row["description"];
        $price= $row["price"];
       ?>
    <form>
        <div class="productContainer">
            <img class="productImage" src="images/1.png" alt="Product Image" width="600" height="400">
            <h3><?php echo $title ?></h3>
            <div class="productDesc">
                <?php echo $description ?>
                <br>
                <?php echo $price ?> $
            </div>
            <button type="button" onclick="addCart(<?php echo $id ?>)">Add</button>
        </div>
    </form>

      <?php endwhile;
} else {
    echo "0 results";
}

$conn->close();


