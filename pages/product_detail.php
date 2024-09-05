<?php include('../includes/header.php'); ?>
<main>
    <?php
    include('../db/db.php');
    $product_id = $_GET['id']; // Get product ID from URL
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo "<div class='product-detail'>";
        echo "<img src='/local_store/assets/images/products/".$product['image']."' alt='".$product['name']."'>";
        echo "<h3>".$product['name']."</h3>";
        echo "<p>".$product['description']."</p>";
        echo "<p>Price: $".$product['price']."</p>";
        echo "<button onclick='addToCart(".$product['id'].")'>Add to Cart</button>";
        echo "</div>";
    } else {
        echo "<p>Product not found.</p>";
    }

    $conn->close();
    ?>
</main>
<?php include('../includes/footer.php'); ?>