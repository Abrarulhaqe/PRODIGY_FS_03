<?php include('../includes/header.php'); ?>
<main>
    <h2>Products</h2>
    <?php
    include('../db/db.php');
    
    // SQL query to select all products from the database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through each product and display it
        while ($product = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='/local_store/assets/images/products/" . $product['image'] . "' alt='" . $product['name'] . "'>";
            echo "<h3>" . $product['name'] . "</h3>";
            echo "<p>" . $product['description'] . "</p>";
            echo "<p>Price: " . $product['price'] . "</p>";
            // Add to Cart button with JavaScript function call
            echo "<button onclick='addToCart(" . $product['id'] . ")'>Add to Cart</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No products available.</p>";
    }

    $conn->close();
    ?>
</main>
<?php include('../includes/footer.php'); ?>